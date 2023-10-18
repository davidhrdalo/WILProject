<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserPartner;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\ProjectFile;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;


class ProjectController extends Controller
{
    // Force users to login before accessing any page
    function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a list of projects
     * Can be accessed by any user
     */
    public function index() {
        $projects = Project::with('user')
            // Group by year and trimester in reverse chronological order
            ->orderBy('year', 'desc')
            ->orderBy('offering', 'desc')
            ->get()
            ->groupBy(['year', 'offering']);

        return view('projects.project-list')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new project
     * Can only be accessed by approved partners
     */
    public function create()
    {
        if(Auth::user()->partner && Auth::user()->partner->approved == 'yes') {
            return view('projects.project-create');
        } else {
            // Redirect to the partner index if user is not an approved partner
            return redirect()->route('partner.index')->with('error', 'You do not have access to view this page.');
        }
    }

    /**
     * Store a newly created project
     * Can only be accessed by approved partners
     */
    public function store(Request $request)
    {
        if (!(Auth::user()->partner && Auth::user()->partner->approved == 'yes')) {
            // Redirect to the partner index if user is not an approved partner
            return redirect()->route('partner.index')->with('error', 'You do not have access to perform this action.');
        }
        
        $userId = Auth::id(); // Get the ID of the currently authenticated user
        
        $request->validate([
            'title' => [
                'required',
                'string',
                'min:5',
                'max:255',
                // Custom rule to check that the title is unique for each year and trimester
                // Requesting the year and trimester to check that the title doesn't already exist in there
                Rule::unique('projects')->where(function ($query) use ($request) {
                    return $query->where('year', $request->year)
                                    ->where('offering', $request->offering);
                }),
            ],  
            // Rule to ensure desc is at least 3 words
            'description' => 'required|string|regex:/^(\b\w+\b\s*){3,}/',
            'partner_name' => 'required|string|min:5',
            'email' => 'required|string|email|min:3',
            'team_size' => 'required|integer|between:3,6',
            'offering' => 'required|integer|between:1,3',
            'year' => 'required|integer|between:2023,2025',
            'images' => 'nullable|array',
            'images.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'files' => 'nullable|array',
            'files.*' => 'mimes:pdf|max:2048',
        ]);

        $project = new Project();

        $project->title = $request->title;
        $project->user_id = $userId; // Assign the user_id from $userId
        $project->description = $request->description;
        $project->partner_name = $request->partner_name;
        $project->email = $request->email;
        $project->team_size = $request->team_size;
        $project->offering = $request->offering;
        $project->year = $request->year;
        $project->save();

        // Handling multiple images
        // Images are stored on the project_image table
        if($request->hasFile('images')){
            foreach($request->file('images') as $image){
                $imagePath = $image->store('project_images', 'public');
                $projectImage = new ProjectImage();
                $projectImage->project_id = $project->id;
                $projectImage->image = $imagePath;
                $projectImage->save();
            }
        }
        
        // Handling multiple files
        // Files are stored on the project_file table
        if($request->hasFile('files')){
            foreach($request->file('files') as $file){
                $filePath = $file->store('project_files', 'public');
                $projectFile = new ProjectFile();
                $projectFile->project_id = $project->id;
                $projectFile->file = $filePath;
                $projectFile->save();
            }
        }
        
        return redirect("project/$project->id");
    }
    

    /**
     * Display project details page
     * Can be accessed by any user
     */
    public function show($id)
    {
        $project = Project::with(['user', 'application'])->find($id);

        // Ensure the project exists
        if (!$project) {
            // Redirect with an error message
            return redirect()->route('partner.index')->with('error', 'This project does not exists.');
        }
        
        return view('projects.project-detail')->with('project', $project);
    }

    /**
     * Show the form for editing a project
     * Can only be accessed by the partner owner
     */
    public function edit($id)
    {
        $project = Project::with('user', 'images', 'files')->find($id);

        // Ensure the project exists and belongs to the authenticated user
        if (!$project || $project->user_id !== Auth::user()->id) {
            // Redirect with an error message
            return redirect()->route('partner.index')->with('error', 'You do not have the right to edit this project.');
        }

        return view('projects.project-edit')->with('project', $project);
    }


    /**
     * Update the project
     * Can only be accessed by the project owner
     */
    public function update($id, Request $request)
    {
        $project = Project::find($id);
    
        // Ensure the project exists and belongs to the authenticated user
        if (!$project || $project->user_id !== Auth::user()->id) {
            // Redirect with an error message
            return redirect()->route('partner.index')->with('error', 'You do not have the right to edit this project.');
        }

        $request->validate([
            'title' => [
                'required',
                'string',
                'min:5',
                'max:255',
            ], 
            // Rule to ensure desc is at least 3 words
            'description' => 'required|string|regex:/^(\b\w+\b\s*){3,}/',
            'partner_name' => 'required|string|min:5',
            'email' => 'required|string|email|min:3',
            'team_size' => 'required|integer|between:3,6',
            'offering' => 'required|integer|between:1,3',
            'year' => 'required|integer|between:2023,2025',
            'images' => 'nullable|array',
            'images.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'files' => 'nullable|array',
            'files.*' => 'mimes:pdf|max:2048',
        ]);
    
        $project->title = $request->title;
        $project->description = $request->description;
        $project->partner_name = $request->partner_name;
        $project->email = $request->email;
        $project->team_size = $request->team_size;
        $project->offering = $request->offering;
        $project->year = $request->year;
        $project->save();
    
        // Handling multiple images
        if($request->hasFile('images')){
            foreach($request->file('images') as $image){
                $imagePath = $image->store('project_images', 'public');
                $projectImage = new ProjectImage();
                $projectImage->project_id = $project->id;
                $projectImage->image = $imagePath;
                $projectImage->save();
            }
        }
        
        // Handling multiple files
        if($request->hasFile('files')){
            foreach($request->file('files') as $file){
                $filePath = $file->store('project_files', 'public');
                $projectFile = new ProjectFile();
                $projectFile->project_id = $project->id;
                $projectFile->file = $filePath;
                $projectFile->save();
            }
        }
    
        return redirect("project/$project->id");
    }

    /**
     * Remove the project
     * Can only be removed by the project owner
     */
    public function destroy($id)
    {
        $project = Project::find($id);

        // Ensure the project exists and belongs to the authenticated user
        if (!$project || $project->user_id !== Auth::user()->id) {
            // Redirect with an error message
            return redirect()->route('partner.index')->with('error', 'You do not have the right to delete this project.');
        }
        
        // Ensure the project does not have any applications
        if ($project->application->count() > 0) {
            // Redirect with an error message
            return redirect("project/$project->id")->with('error', 'Project with applications cannot be deleted');
        }        
        $project->delete();

        // Redirect back to the partner details after successful deletion
        return redirect('partner/' . Auth::user()->id)->with('status', 'Project Deleted Successfully');
    }

}
