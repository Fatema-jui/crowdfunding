<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Donation;

class DonorProfileController extends Controller
{
    public function donorProfile(){
        $user= Auth::user();

        return view ('frontend.pages.donor-profile.donor-profile', compact('user'));
    }

   public function donorProfileUpdate(Request $request)
   {
    $request->validate([
        'name'  => 'required|string|max:255',
        'phone' => 'required|string|max:20',
    ]);

       $user = User::find(Auth::id());
       $user->name  = $request->name;
       $user->phone = $request->phone;

    if ($request->filled('password')) {
        $request->validate([
            'password' => 'min:6|confirmed',
        ]);
        $user->password = Hash::make($request->password);
    }

    $user->save();

      return redirect()->route('donor.profile')->with('success', 'Profile updated successfully!');
    }

    public function donorDonationsList()
    {
        $user = Auth::user();
        $donations = Donation::with('crisis')->where('donor_id', $user->id)->get();

        return view('frontend.pages.donor-profile.my-donation', compact('donations'));
    }
}
