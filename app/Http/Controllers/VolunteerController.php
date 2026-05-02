<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Volunteer;

class VolunteerController extends Controller
{
    public function volunteerindex(){
        $volunteers=Volunteer::all();
        return view ('volunteer.volunteer' , compact('volunteers'));
    }


    public function volunteerform(){
        return view ('volunteer.volunteerform');
    }

    public function volunteersubmit(Request $request){
       Volunteer::create([
        'volunteer_name'=>$request->volunteer_name,
        'email'=>$request->email,
        'phone'=>$request->phone,
        'address'=>$request->address,
        'age'=>$request->age,
        'gender'=>$request->gender,
        'message'=>$request->message,
        'status'=>$request->status 
       ]);

     return redirect()->route('volunteer');

    }  

    
    public function approve($id){
        $volunteer = Volunteer::findOrFail($id);
        $volunteer->status = 'approved';
        $volunteer->save();
    
        return redirect()->back()->with('success', 'Volunteer approved successfully.');
    }
    
    public function reject($id){
        $volunteer = Volunteer::findOrFail($id);
        $volunteer->status = 'rejected';
        $volunteer->save();

        return redirect()->back()->with('success', 'Volunteer rejected successfully.'); 
    
    }

}