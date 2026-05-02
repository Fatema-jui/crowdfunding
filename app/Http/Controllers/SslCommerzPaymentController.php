<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Donation;
use App\Models\User;
use App\Models\Crisis; // Added

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
        $donarInfo = User::where('id', auth()->user()->id)->first();

        // Create a unique tran_id
        $uniqueTranId = 'TRX-3940348838-' . uniqid() . '-' . $request->crisis_id;

        $post_data = array();
        $post_data['total_amount'] = $request->amount;
        $post_data['currency']     = "BDT";
        $post_data['tran_id']      = $uniqueTranId;

        // Customer information
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

        // Shipment information
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

        // Optional parameters
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        // Create donation record before payment (pending status)
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

    public function payViaAjax(Request $request)
    {
        $post_data = array();
        $post_data['total_amount'] = '10';
        $post_data['currency']     = "BDT";
        $post_data['tran_id']      = uniqid();

        $post_data['cus_name']     = 'Customer Name';
        $post_data['cus_email']    = 'customer@mail.com';
        $post_data['cus_add1']     = 'Customer Address';
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

        Donation::updateOrInsert(
            ['transaction_id' => $post_data['tran_id']],
            [
                'amount'         => $post_data['total_amount'],
                'status'         => 'pending',
                'transaction_id' => $post_data['tran_id'],
            ]
        );

        $sslc = new SslCommerzNotification();
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

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

        $order_details = Donation::where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'amount', 'crisis_id') //  crisis_id added
            ->first();

        if (!$order_details) {
            return redirect()->route('crisis.list')
                ->with('error', 'Transaction not found.');
        }

        if ($order_details->status == 'pending') {
            $validation = $sslc->orderValidate(
                $request->all(), $tran_id, $amount, $currency
            );

            if ($validation) {
                Donation::where('transaction_id', $tran_id)
                    ->update(['status' => 'completed']);

                // Update raised_amount in crisis table
                Crisis::where('id', $order_details->crisis_id)
                    ->increment('raised_amount', $order_details->amount);

                session(['tran_id' => $tran_id]);
                return redirect()->route('payment.success');
            }

            return redirect()->route('crisis.list')
                ->with('error', 'Payment validation failed.');

        } elseif ($order_details->status == 'completed') {
            return redirect()->route('payment.success');
        } else {
            return redirect()->route('crisis.list')
                ->with('error', 'Invalid transaction.');
        }
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = Donation::where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'amount')
            ->first();

        if (!$order_details) {
            return redirect()->route('crisis.list')
                ->with('error', 'Transaction not found.');
        }

        if ($order_details->status == 'pending') {
            Donation::where('transaction_id', $tran_id)
                ->update(['status' => 'failed']);

            return redirect()->route('crisis.list')
                ->with('error', 'Payment failed. Please try again.');

        } elseif ($order_details->status == 'completed') {
            return redirect()->route('payment.success');
        } else {
            return redirect()->route('crisis.list')
                ->with('error', 'Invalid transaction.');
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = Donation::where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'amount')
            ->first();

        if (!$order_details) {
            return redirect()->route('crisis.list')
                ->with('error', 'Transaction not found.');
        }

        if ($order_details->status == 'pending') {
            Donation::where('transaction_id', $tran_id)
                ->update(['status' => 'cancelled']);

            return redirect()->route('crisis.list')
                ->with('error', 'Payment has been cancelled.');

        } elseif ($order_details->status == 'completed') {
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

            $order_details = Donation::where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'amount')
                ->first();

            if (!$order_details) {
                echo "Invalid Transaction";
                return;
            }

            if ($order_details->status == 'pending') {
                $sslc       = new SslCommerzNotification();
                $validation = $sslc->orderValidate(
                    $request->all(), $tran_id,
                    $order_details->amount, 'BDT'
                );

                if ($validation == true) {
                    Donation::where('transaction_id', $tran_id)
                        ->update(['status' => 'completed']);

                    echo "Transaction is successfully Completed";
                } else {
                    echo "Validation Failed";
                }

            } elseif ($order_details->status == 'completed') {
                echo "Transaction is already successfully Completed";
            } else {
                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }
}