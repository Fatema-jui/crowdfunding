<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Donation;
use App\Models\User;
use App\Models\Crisis;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        $crisis = Crisis::where('id', $request->crisis_id)->first();

        if (!$crisis) {
            return back()->with('error', 'Crisis not found.');
        }

        $due = $crisis->target_amount - $crisis->raised_amount;

        if ($due <= 0) {
            return back()->with('error', 'Target amount already reached.');
        }

        if ($request->amount > $due) {
            return back()->with('error', 'Maximum donation amount is ' . $due . ' BDT.');
        }

        $donarInfo = User::where('id', auth()->user()->id)->first();

        $uniqueTranId = 'TRX-3940348838-' . uniqid() . '-' . $request->crisis_id;

        $post_data = array();
        $post_data['total_amount'] = $request->amount;
        $post_data['currency']     = "BDT";
        $post_data['tran_id']      = $uniqueTranId;

        $post_data['cus_name']     = $donarInfo->name;
        $post_data['cus_email']    = $donarInfo->email;
        $post_data['cus_add1']     = 'Dhaka';
        $post_data['cus_add2']     = "";
        $post_data['cus_city']     = "";
        $post_data['cus_state']    = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country']  = "Bangladesh";
        $post_data['cus_phone']    = '8801XXXXXXXXX';
        $post_data['cus_fax']      = "";

        $post_data['ship_name']     = "Store Test";
        $post_data['ship_add1']     = "Dhaka";
        $post_data['ship_add2']     = "Dhaka";
        $post_data['ship_city']     = "Dhaka";
        $post_data['ship_state']    = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone']    = "";
        $post_data['ship_country']  = "Bangladesh";

        $post_data['shipping_method']  = "NO";
        $post_data['product_name']     = "Donation";
        $post_data['product_category'] = "Crowdfunding";
        $post_data['product_profile']  = "non-physical-goods";

        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        Donation::create([
            'crisis_id'      => $request->crisis_id,
            'donor_id'       => $donarInfo->id,
            'amount'         => $request->amount,
            'payment_method' => 'online',
            'donation_date'  => today(),
            'transaction_id' => $uniqueTranId,
            'status'         => 'pending'
        ]);

        $sslc = new SslCommerzNotification();
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    public function success(Request $request)
    {
        $tran_id  = $request->input('tran_id');
        $amount   = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        $donation = Donation::where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'amount', 'crisis_id', 'donor_id')
            ->first();

        if (!$donation) {
            return redirect()->route('crisis.list')
                ->with('error', 'Transaction not found.');
        }

        if ($donation->status == 'pending') {

            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {

                Donation::where('transaction_id', $tran_id)
                    ->update(['status' => 'completed']);

                Crisis::where('id', $donation->crisis_id)
                    ->increment('raised_amount', $donation->amount);

                $donor = User::find($donation->donor_id);
                if ($donor) {
                    Auth::login($donor);
                }

                session(['tran_id' => $tran_id]);
                return redirect()->route('payment.success');
            }

            return redirect()->route('crisis.list')
                ->with('error', 'Payment validation failed.');

        } elseif ($donation->status == 'completed') {
            return redirect()->route('payment.success');
        } else {
            return redirect()->route('crisis.list')
                ->with('error', 'Invalid transaction.');
        }
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $donation = Donation::where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'amount')
            ->first();

        if (!$donation) {
            return redirect()->route('crisis.list')
                ->with('error', 'Transaction not found.');
        }

        if ($donation->status == 'pending') {
            Donation::where('transaction_id', $tran_id)
                ->update(['status' => 'failed']);

            return redirect()->route('crisis.list')
                ->with('error', 'Payment failed. Please try again.');

        } elseif ($donation->status == 'completed') {
            return redirect()->route('payment.success');
        } else {
            return redirect()->route('crisis.list')
                ->with('error', 'Invalid transaction.');
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $donation = Donation::where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'amount')
            ->first();

        if (!$donation) {
            return redirect()->route('crisis.list')
                ->with('error', 'Transaction not found.');
        }

        if ($donation->status == 'pending') {
            Donation::where('transaction_id', $tran_id)
                ->update(['status' => 'cancelled']);

            return redirect()->route('crisis.list')
                ->with('error', 'Payment cancelled.');

        } elseif ($donation->status == 'completed') {
            return redirect()->route('payment.success');
        } else {
            return redirect()->route('crisis.list')
                ->with('error', 'Invalid transaction.');
        }
    }

    public function ipn(Request $request)
    {
        if ($request->input('tran_id')) {

            $tran_id = $request->input('tran_id');

            $donation = Donation::where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'amount')
                ->first();

            if (!$donation) {
                echo "Invalid Transaction";
                return;
            }

            if ($donation->status == 'pending') {

                $sslc       = new SslCommerzNotification();
                $validation = $sslc->orderValidate(
                    $request->all(), $tran_id, $donation->amount, 'BDT'
                );

                if ($validation == true) {
                    Donation::where('transaction_id', $tran_id)
                        ->update(['status' => 'completed']);

                    echo "Transaction is successfully Completed";
                } else {
                    echo "Validation Failed";
                }

            } elseif ($donation->status == 'completed') {
                echo "Transaction is already successfully Completed";
            } else {
                echo "Invalid Transaction";
            }

        } else {
            echo "Invalid Data";
        }
    }
}