<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserStudent;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\ProjectFile;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    // Force users to login before accessing any page
    function __construct(){
        $this->middleware('auth');
    }

     /**
     * Store a newly created student project application.
     */
    public function store(Request $request)
    {

        // Grabbing the logged in users id (PK)
        $userId = Auth::id();

        // Check if the user is a student and has GPA filled in
        $userStudent = UserStudent::where('user_id', $userId)->first();
        if (!$userStudent || is_null($userStudent->gpa)) {
            return back()->withErrors(['user_id' => 'Please fill in your student profile details before applying.']);
        }
    
        // Check if user already has 3 applications
        $applicationsCount = Application::where('user_id', $userId)->count();
        if ($applicationsCount >= 3) {
            return back()->withErrors(['user_id' => 'You can only have 3 applications.']);
        }
    
        // Validate request
        $request->validate([
            'justification' => 'required|string|min:3|max:255',
        ]);
    
        // Save new Application
        $application = new Application();
        $application->justification = $request->justification;
        $application->project_id = $request->project_id;
        $application->user_id = $userId;
        $application->save();
    
        return back();
    }
    
    /**
     * Remove the specified student project application from storage.
     */
    public function destroy($id)
    {
        $application = Application::find($id);

        // Ensure the application exists and belongs to the authenticated user
        if (!$application || $application->user_id !== Auth::user()->id) {
            return back()->withErrors(['user_id' => 'You do not have access to perform this action.']);
        }

        $application->delete();

        // Redirect back with success message
        return back()->with('message', 'Application successfully deleted.');
    }
}
