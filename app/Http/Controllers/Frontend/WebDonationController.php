<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Crisis;
use App\Models\Donor;

class WebDonationController extends Controller
{
   
    public function donateStore(Request $request){
        // Validation
        $request->validate([
            'crisis_id'      => 'required|exists:crises,id',
            'amount'         => 'required|numeric|min:1',
            'payment_method' => 'required|in:bKash,Nagad,Card',
        ],
        [
            'amount.required' => 'Amount is required',
            'amount.min'      => 'Minimum 1 taka',
        ]);

        $user = auth()->user();

        $donor = Donor::firstOrCreate(
            ['email' => $user->email],
            [
                'name'          => $user->name,
                'phone'         => $user->phone ?? null,
                'donor_type'    => 'user',
                'donation_date' => now(),
            ]
        );

        // Donation save
        $donation = Donation::create([
            'donor_id'        => $donor->id,
            'crisis_id'      => $request->crisis_id,
            'amount'         => $request->amount,
            'payment_method' => $request->payment_method,
            'status'         => 'completed',
        ]);

        // No raised column exists on crises table; progress is calculated from donations sum.
        return redirect()
               ->route('donate.success')
               ->with('donation', $donation->load('crisis'));
    }

    public function donateSuccess(){
        // Session এ donation না থাকলে home এ পাঠাও
        if (!session('donation')) {
            return redirect('/');
        }

        $donation = session('donation');
        return view('frontend.pages.payment.success', compact('donation'));
    }
}

