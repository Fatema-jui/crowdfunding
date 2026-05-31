<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function success(){

        $tran_id  = session('tran_id');
        $donation = Donation::latest()->first();

        return view ('frontend.pages.payment.success',compact('donation'));

    }
}
