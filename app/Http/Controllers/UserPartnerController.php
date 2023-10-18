<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserPartner;
use App\Models\UserStudent;
use App\Models\Project;

class UserPartnerController extends Controller
{
    // Force users to login before accessing any page
    function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a list of partners
     * Can be accessed by any user
     */
    public function index()
    {
        $partners = User::where('type', 'Partner')->paginate(5);
        return view('users.partner-index')->with('partners', $partners);
    }

    /**
     * Create approved attribute in the user_partner table
     * Can only be processed by a teacher
     */
    public function store(Request $request)
    {   
        // Checking the form is submitted by a teacher
        if (!(Auth::user()->type == "Teacher")) {
            return redirect()->route('partner.index')->with('error', 'You do not have access to perform this action.');
        }

        // Requesting user_id from the form
        $userId = $request->user_id;

        // Checking the user doesn't already exist
        if(UserPartner::where('user_id', $userId)->exists()) {
            return redirect()->back()->with('error', 'A UserPartner already exists for this user.');
        }
        
        $request->validate([ 
            'approved' => 'required',
            'user_id' => 'required',
        ]);
    
        $partner = new UserPartner();
        $partner->user_id = $request->user_id;
        $partner->approved = $request->approved;
        $partner->save();
    
        return redirect()->back()->with('message', 'Approval Updated Successfully');
    }
 
    
    /**
     * Display the partner detail page
     * Can be accessed by any user
     */
    public function show($id)
    {
        $partner = User::find($id);
        $user_partner = UserPartner::where('user_id', $id)->first();
        
        // If partner doesnt exist or user isnt a partner redirect
        if(!$partner || $partner->type !== 'Partner') {
            return redirect()->route('partner.index')->with('error', 'This user is not a partner.');
        }
        
        $projects = Project::where('user_id', $id)->get();

        return view('users.partner-show')->with('partner', $partner)->with('projects', $projects)->with('user_partner', $user_partner);
    }
    
    /**
     * Update the approved attribute on the user_partner table
     * Can only be accessed by a teacher
     */
    public function update(Request $request, $id)
    {
        // Checking the form is submitted by a teacher
        if (!(Auth::user()->type == "Teacher")) {
            return redirect()->route('partner.index')->with('error', 'You do not have access to perform this action.');
        }

        $request->validate([
            'approved' => 'required|in:yes,no',
        ]);
    
        // Checking that the user partner exists
        $partner = UserPartner::where('user_id', $id)->first();
        if(!$partner) {
            return redirect()->back()->with('error', 'UserPartner does not exist.');
        }
        $partner->approved = $request->approved;
        $partner->save();
    
        return redirect()->back()->with('message', 'Approval Updated Successfully');
    }
}
