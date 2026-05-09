<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Crisis;
use App\Models\Volunteer;
class WebVolunteerController extends Controller
{
    public function volunteerForm(){

        return view ('frontend.pages.volunteer.volunteer-form');
    }

    public function volunteerSubmit(Request $request){
        //dd($request->all());

            $request->validate([
                'volunteer_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'message' => 'nullable|string',
            ]);
    
             Volunteer::create([
            'volunteer_name'=> $request->volunteer_name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'address' => $request->address,
            'age'     => $request->age,
            'gender'  => $request->gender,
            'message' => $request->message,
        ]);
    
            return redirect()->route('website')->with('success', 'Your volunteer application has been submitted successfully!');
        }

    public function volunteerList(){

    $volunteers = Volunteer::where('status', 'approved')->latest()->get();
    
    $totalApproved = Volunteer::where('status', 'approved')->count();
    $activeAreas = Volunteer::where('status', 'approved')
                    ->whereNotNull('address')
                    ->distinct('address')
                    ->count('address');

    return view('frontend.pages.volunteer.volunteerlist', 
        compact('volunteers', 'totalApproved', 'activeAreas'));
    }

}
