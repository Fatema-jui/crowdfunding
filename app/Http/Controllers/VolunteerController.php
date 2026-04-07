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
        'skill'=>$request->skill,
        'availability'=>$request->availability,
        'experience'=>$request->experience,
        'status'=>$request->status 
       ]);

     return redirect()->route('volunteer');

    }  

    public function volunteerview($id){
        $volunteer=Volunteer::find($id);
        return view ('volunteer.volunteerview',compact('volunteer'));

    }

    public function volunteerdelete($id){
        $volunteer=Volunteer::find($id);
        $volunteer->delete();
        return redirect()->back();
    }
    
    
}
