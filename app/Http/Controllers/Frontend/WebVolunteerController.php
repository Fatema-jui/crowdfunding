<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
                'password' => 'required|string|min:6|confirmed',
                'NID' => 'nullable|string|max:20',
                'birth_date' => 'nullable|date',
                'phone' => 'required|string|max:20',
                'message' => 'nullable|string',
            ]);
    
             Volunteer::create([
            'volunteer_name'=> $request->volunteer_name,
            'email'   => $request->email,
            'password' => bcrypt($request->password),
            'phone'   => $request->phone,
            'address' => $request->address,
            'age'     => $request->age,
            'NID'     => $request->NID,
            'birth_date' => $request->birth_date,
            'gender'  => $request->gender,
            'message' => $request->message,
        ]);
    
            return redirect()->route('webvolunteer.login')->with('success', 'Your volunteer application has been submitted successfully!');
        }


    public function volunteerLogin(){

        return view ('frontend.pages.volunteer.volunteer-login');
        
    }    

    public function volunteerLoginSubmit(Request $request)
    {
        $request->validate([

            'email'    => 'required|email',
            'password' => 'required',

        ]);

       $volunteer = Volunteer::where('email', $request->email)->first();

        if (!$volunteer || !Hash::check($request->password, $volunteer->password)) {

          return back()->withErrors(['email' => 'Email or Password is incorrect']);
        }

      
    // store to session
    session([

        'volunteer_id'   => $volunteer->id,
        'volunteer_name' => $volunteer->volunteer_name,
        'volunteer_email'=> $volunteer->email,
    ]);

      return redirect()->route('website')->with('success', 'Welcome, ' . $volunteer->volunteer_name . '!');

    }

    public function volunteerLogout(Request $request)
    {
      $request->session()->forget(['volunteer_id', 'volunteer_name', 'volunteer_email']);

      return redirect()->route('website')->with('success', 'Logged out successfully!');
    }


    public function volunteerProfile(){
        
       $volunteer = Volunteer::find(session('volunteer_id'));
       return view('frontend.pages.volunteer.volunteer-profile', compact('volunteer'));
    }

    public function volunteerProfileUpdate(Request $request){
    
    $request->validate([
        'volunteer_name' => 'required|string|max:255',
        'phone'          => 'required|string|max:20',
    ]);

    $volunteer = Volunteer::find(session('volunteer_id'));
    $volunteer->volunteer_name = $request->volunteer_name;
    $volunteer->phone          = $request->phone;
    $volunteer->address        = $request->address;
    $volunteer->age            = $request->age;
    $volunteer->gender         = $request->gender;
    $volunteer->NID            = $request->NID;
    $volunteer->birth_date     = $request->birth_date;

    if ($request->filled('password')) {
        $request->validate([
            'password' => 'min:6|confirmed',
        ]);
        $volunteer->password = bcrypt($request->password);
    }

    $volunteer->save();

    return redirect()->route('webvolunteer.profile')->with('success', 'Profile updated successfully!');
}


    public function volunteerApplication(){

      $volunteer = Volunteer::find(session('volunteer_id'));
      return view('frontend.pages.volunteer.volunteer-application', compact('volunteer'));
    
      }

    public function volunteerTasks(){

      $volunteer = Volunteer::with('crises')->find(session('volunteer_id'));
        //dd($volunteer->id, $volunteer->crises); 

      return view('frontend.pages.volunteer.volunteer-task', compact('volunteer'));
    }

    public function taskComplete(Request $request, $crisis_id){

    $volunteer = Volunteer::find(session('volunteer_id'));
    
    $volunteer->crises()->updateExistingPivot($crisis_id, [
        'status' => 'completed'
    ]);

    return redirect()->route('webvolunteer.tasks')->with('success', 'Assign Task  as completed!');
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
