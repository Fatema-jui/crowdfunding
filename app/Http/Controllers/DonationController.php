<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Donar;

class DonationController extends Controller
{
    public function donationindex(){
        return view ('donation.donation');
    }

    public function donationform(){
        $categories=Category::all();
        $donars=Donar::all();
        return view ('donation.donationform',compact('categories','donars'));
    }

    public function donationsubmit(Request $request){
        Donation::create([
            'category_id'=>$request->category_id,
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
