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
     $request->validate([

            'volunteer_name' => 'required|string|max:255',
            'email'=>'required|email|max:255',
            'password'=>'required|string|min:6|confirmed',
            'NID'=>'nullable|string|max:20',
            'birth_date'=>'nullable|date',
            'phone' =>'required|string|max:20',
            'message' =>'nullable|string',
        ]);

    Volunteer::create([
        'volunteer_name'=>$request->volunteer_name,
        'email'=>$request->email,
        'password'=>bcrypt($request->password),
        'phone'=>$request->phone,
        'address'=>$request->address,
        'age'=>$request->age,
        'NID'=>$request->NID,
        'birth_date'=>$request->birth_date,
        'gender'=>$request->gender,
        'message'=>$request->message,
        'status'=>$request->status 
       ]);

     return redirect()->route('volunteer');

    }  

    
    public function approve( int $id){
        $volunteer = Volunteer::findOrFail($id);
        $volunteer->status = 'approved';
        $volunteer->save();
    
        return redirect()->back()->with('success', 'Volunteer approved successfully.');
    }
    
    public function reject(int $id){
        $volunteer = Volunteer::findOrFail($id);
        $volunteer->status = 'rejected';
        $volunteer->save();

        return redirect()->back()->with('success', 'Volunteer rejected successfully.'); 
    
    }

}