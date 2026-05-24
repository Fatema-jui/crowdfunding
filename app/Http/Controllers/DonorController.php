<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donor;
use App\Models\User;

class DonorController extends Controller
{

    public function donorindex(Request $request)
    {
        $donors = User::where('role', 'donor')
            ->whereHas('donations')
            ->get();

        $total = User::where('role', 'donor')
            ->whereHas('donations')
            ->count();
        return view('donor.donor', compact('donors', 'total'));
    }

    public function donorform()
    {
        return view ('donor.donorform');
    }

    public function donorsubmit(Request $request)
    {
    User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>bcrypt($request->password),
        'phone'=>$request->phone,
        'role'=>'donor',
    
    ]);
       return redirect()->route('donor');
  }

    public function donorview($id)
    {
    $donor = User::findOrFail($id); 
    return view('donor.donorview', compact('donor'));
    }

   public function donoredit($id)
    {
    $donor = User::findOrFail($id); 
    return view('donor.donoredit', compact('donor'));
    }
   
   
   public function donordelete($id)
    {
    User::findOrFail($id)->delete();
    return redirect()->back();
    }

}
