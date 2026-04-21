<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donor;

class DonorController extends Controller
{

 public function donorindex(Request $request)
 {
     $donors = Donor::query()
         ->when($request->search, fn($q) =>
             $q->where('name', 'like', "%{$request->search}%")
               ->orWhere('donor_id', 'like', "%{$request->search}%")
         )
       
         
         ->latest('donation_date')
         ->paginate(10);

     $total = Donor::count();

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
  $donor = Donor::findOrFail($id);
  return view('donor.donorview', compact('donor'));
 }

 public function donordelete($id)
 {
  Donor::findOrFail($id)->delete();
  return redirect()->back();
 }

}
