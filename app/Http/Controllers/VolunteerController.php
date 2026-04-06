<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Volunteer;

class VolunteerController extends Controller
{
    public function volunteerindex(){
        return view ('volunteer.volunteer');
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
        'skill'=>$request->skill,
        'availability'=>$request->availability,
        'experience'=>$request->experience,
        'status'=>$request->status 
       ]);

     return redirect()->route('volunteer');

    }  
    
    
}
