<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crisis;
use App\Models\Donar;
use App\Models\Donation;

class DonationController extends Controller
{
    public function donationindex(){
        $donations=Donation::all();
        return view ('donation.donation',compact('donations'));
    }

    public function donationform(){
        $crises=Crisis::all();
        $donars=Donar::all();
        return view ('donation.donationform',compact('crises','donars'));
    }

    public function donationsubmit(Request $request){
        Donation::create([
            'crisis_id'=>$request->crisis_id,
            'donar_id'=>$request->donar_id,
            'donation_amount'=>$request->donation_amount,
            'payment_method'=>$request->payment_method,
            'donation_date'=>$request->donation_date,
            'transaction_id'=>$request->transaction_id,
            'status'=>$request->status

        ]);
        return redirect()->route('donation');
    }
}
