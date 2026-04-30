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
            ->latest()
            ->get();

        $total = User::where('role', 'donor')->count();

        return view('donor.donor', compact('donors', 'total'));
    }

    public function donorform()
    {
    return view ('donor.donorform');
    }

    public function donorsubmit(Request $request)
    {
    Donor::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'phone'=>$request->phone,
        'address'=>$request->address,
        'donor_type'=>$request->donor_type,
        'donation_date'=>$request->donation_date,
        'total_donation'=>$request->total_donation,
        'status'=>'pending'
    ]);
    return redirect()->route('donor');
  }

    public function donorview($id)
    {
    $donor = User::findOrFail($id); 
    return view('donor.donorview', compact('donor'));
   }

   public function donordelete($id)
   {
    User::findOrFail($id)->delete();
    return redirect()->back();
   }

}
