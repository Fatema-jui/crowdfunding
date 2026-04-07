<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donor;

class DonorController extends Controller
{

 public function donorindex(){
    $donors=Donor::all();
    return view ('donor.donor',compact('donors'));
 }

 public function donorform(){
    return view ('donor.donorform');
 }


 public function donorsubmit(Request $request){
   //dd($request->all());
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

 public function donorview($id){
   $donor=Donor::find($id);
   return view ('donor.donorview' , compact('donor'));
 }

 public function donordelete($id){
   $donor=Donor::find($id);
   $donor->delete();
   return redirect()->back();
 }

}
