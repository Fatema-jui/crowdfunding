<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crisis;
use App\Models\Donor;
use App\Models\Donation;
use App\Models\User;


class DonationController extends Controller
{
    public function donationindex(){
        
        $donations=Donation::with(['donor', 'crisis'])->get();
        return view ('donation.donation',compact('donations'));
    }

    public function donationform(){
        $crises=Crisis::all();
        $users=User::all();
        return view ('donation.donationform',compact('crises','users'));
    }

    public function donationsubmit(Request $request){

     $request->validate([
        'crisis_id'      => 'required',
        'user_id'        => 'required',
        'amount'         => 'required|numeric|min:1',
        'payment_method' => 'required',
        'donation_date'  => 'required|date',
        'transaction_id' => 'required|unique:donations,transaction_id',
        'status'         => 'required',
    ]);
    
        Donation::create([
            'crisis_id'=>$request->crisis_id,
            'donor_id'=>$request->user_id,
            'amount'=>$request->amount,
            'payment_method'=>$request->payment_method,
            'donation_date'=>$request->donation_date,
            'transaction_id'=>$request->transaction_id,
            'status'=>$request->status

        ]);
        return redirect()->route('donation');
    }

    public function donationview( int $id){  
        
    $donation = Donation::with(['donor', 'crisis'])->findorFail($id);
    return view('donation.donationview', compact('donation'));
    }
    

    public function donationdelete( int $id){
        $donation=Donation::findorFail($id);
        $donation->delete();
        return redirect()->route('donation');
    }
 

}
