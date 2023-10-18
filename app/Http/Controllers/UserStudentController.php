<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserStudent;
use App\Models\UserPartner;
use App\Models\Project;

class UserStudentController extends Controller
{
    // Force users to login before accessing any page
    function __construct(){
        $this->middleware('auth');
    }

    /**
     * Custom function to auto assign students to projects
     * Function connects to a form stored on the projects list page
     */
    public function autoAssign(Request $request)
    {
        // Redirect to the partner index if user is not a teacher
        if (!(Auth::user()->type == "Teacher")) {
            return redirect()->route('partner.index')->with('error', 'You do not have access to perform this action.');
        }

        // Hidden feild on the form
        $year = $request->input('year');
        // Hidden feild on the form
        $offering = $request->input('offering');
    
        // Filtering projects by year and trimester that have applications
        $projects = Project::where('year', $year)->where('offering', $offering)->with('application')->get();
    
        foreach ($projects as $project) {
            // Count how many students are already assigned to this project
            $assignedStudentsCount = UserStudent::where('project_id', $project->id)->count();
    
            // Determine how many more students can be assigned
            $slotsAvailable = $project->team_size - $assignedStudentsCount;
    
            // Filter out applications of students who are already assigned to a project
            $applications = $project->application->filter(function ($application) {
                return is_null($application->user->student->project_id);
            });

            // Looping through applications
            foreach ($applications as $application) {
                if ($slotsAvailable > 0) {
                    // Saving project id to user_student
                    $application->user->student->project_id = $project->id;
                    $application->user->student->save();
    
                    // Counting down slots avalible after each loop
                    $slotsAvailable--;
                } else {
                    break; // Stop if no more slots are available for this project
                }
            }
        }
    
        return redirect()->back()->with('message', 'Students assigned successfully!');
    }
     
    
    /**
     * Display a list of students
     * Can only be accessed by the Teacher
     */
    public function index()
    {
        // Check if the user is authenticated and is of type Teacher
        if (Auth::check() && Auth::user()->type == 'Teacher') {
            $students = User::where('type', 'Student')->paginate(5);
            return view('users.student-index')->with('students', $students);
        } else {
            // Redirect to the partner index if the user is not a Teacher
            return redirect()->route('partner.index')->with('error', 'You do not have access to view this page.');
        }
    }

    /**
     * Show the form for creating a user_student details
     * Can only be accessed by a student
     */
    public function create()
    {
        // Check if the user is authenticated and is of type 'Student'
        if (Auth::check() && Auth::user()->type == 'Student') {
            return view('users.student-create');
        } else {
            // Redirect to the partner index if the user is not a Student
            return redirect()->route('partner.index')->with('error', 'You do not have access to view this page.');
        }
    }

    /**
     * Store a new user_student
     * Can only be accessed by a student
     */
    public function store(Request $request)
    {
        if (!(Auth::user()->type == "Student")) {
            // Redirect to the partner index if the user is not a Student
            return redirect()->route('partner.index')->with('error', 'You do not have access to perform this action.');
        }

        $userId = Auth::id(); // Get the ID of the currently authenticated user
        
        // Check if a UserStudent already exists with this user_id
        if(UserStudent::where('user_id', $userId)->exists()) {
            return redirect()->back()->with('error', 'A UserStudent already exists for this user.');
        }
        
        $request->validate([ 
            // regex to ensure that there are no more than 2 decimal places
            'gpa' => 'required|numeric|between:0,7|regex:/^(\d(\.\d{1,2})?)$/',
            'software_developer' => 'required|integer|between:0,5',
            'project_manager' => 'required|integer|between:0,5',
            'business_analyst' => 'required|integer|between:0,5',
            'tester' => 'required|integer|between:0,5',
            'client_liaison' => 'required|integer|between:0,5',
        ]);

        // Validation to ensure at least one role has been set to 1
        if (
            $request->input('software_developer') < 1 &&
            $request->input('project_manager') < 1 &&
            $request->input('business_analyst') < 1 &&
            $request->input('tester') < 1 &&
            $request->input('client_liaison') < 1
        ) {
            return redirect()->back()->with('error', 'At least one role must be set to 1 or higher.')->withInput();
        }
    
        $student = new UserStudent();
        $student->gpa = $request->gpa;
        $student->user_id = $userId;
        $student->software_developer = $request->software_developer;
        $student->project_manager = $request->project_manager;
        $student->business_analyst = $request->business_analyst;
        $student->tester = $request->tester;
        $student->client_liaison = $request->client_liaison;
        $student->save();
    
        return redirect("student/" . auth()->id());
    }

    /**
     * Display the student details page
     * Can be accessed by a teacher or student if they are the owner
     */
    public function show($id)
    {
        $student = User::find($id);

        if (!$student) {
            return redirect()->route('partner.index')->with('error', 'This user does not exist.');
        }

        // Check if the found user is a student.
        if($student->type !== 'Student') {
            return redirect()->route('partner.index')->with('error', 'This user is not a student.');
        }

        // Check if the authenticated user is a teacher or a student that matches the auth user id
        if (Auth::check() && (Auth::user()->type == 'Teacher' || Auth::id() == $student->id)) {
            return view('users.student-show')->with('student', $student);
        } else {
            return redirect()->route('partner.index')->with('error', 'You do not have access to view this page.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
            $userStudent = UserStudent::find($id);
            if(!$userStudent){
                return redirect()->back()->with('error', 'User Student not found.');
            }
        
            // Ensure the authenticated user is a teacher, or the owner student
            if (Auth::check() && Auth::id() == $userStudent->user_id) {
                return view('users.student-edit')->with('userStudent',  $userStudent);
            } else {
                return redirect()->route('partner.index')->with('error', 'You do not have access to view this page.');
            }
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $userStudent = UserStudent::find($id);
        if(!$userStudent){
            return redirect()->back()->with(['user_id' => 'User Student not found.']);
        }
    
        // Ensure the authenticated user is a teacher, or the owner student
        if (!(Auth::check() &&  Auth::id() == $userStudent->user_id)) {
            return redirect()->route('partner.index')->with('error', 'You do not have access to update this page.');
        }
    
        $request->validate([
            // regex to ensure that there are no more than 2 decimal places
            'gpa' => 'required|numeric|between:0,7|regex:/^(\d(\.\d{1,2})?)$/',
            'software_developer' => 'required|integer|between:0,5',
            'project_manager' => 'required|integer|between:0,5',
            'business_analyst' => 'required|integer|between:0,5',
            'tester' => 'required|integer|between:0,5',
            'client_liaison' => 'required|integer|between:0,5',
        ]);

        // Validation to ensure at least one role has been set to 1
        if (
            $request->input('software_developer') < 1 &&
            $request->input('project_manager') < 1 &&
            $request->input('business_analyst') < 1 &&
            $request->input('tester') < 1 &&
            $request->input('client_liaison') < 1
        ) {
            return redirect()->back()->with('error', 'At least one role must be set to 1 or higher.');
        }
    
        $userStudent->gpa = $request->gpa;
        $userStudent->software_developer = $request->software_developer;
        $userStudent->project_manager = $request->project_manager;
        $userStudent->business_analyst = $request->business_analyst;
        $userStudent->tester = $request->tester;
        $userStudent->client_liaison = $request->client_liaison;
        $userStudent->save();
    
        return redirect("student/" . auth()->id());
    }
    
    /**
     * Remove the specified resource from storage.
     */
    /*public function destroy(string $id){}*/
}
