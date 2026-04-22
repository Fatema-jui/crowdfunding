<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Donation;
use App\Models\User;

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

        // Create a unique tran_id (duplicates if crisis_id is given)
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

        // শিপমেন্ট তথ্য
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

        // অপশনাল প্যারামিটার
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        // পেমেন্টের আগে Donation রেকর্ড তৈরি করুন (pending স্ট্যাটাসে)
        Donation::create([
            'crisis_id'      => $request->crisis_id,
            'donor_id'       => $donarInfo->id,
            'amount'         => $request->amount,
            'payment_method' => 'online',
            'donation_date'  => today(),
            'transaction_id' => $uniqueTranId,  // ইউনিক tran_id
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

        // Donation::table() ভুল ছিল — সঠিক হলো Donation::where()
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
            ->select('transaction_id', 'status', 'amount')
            ->first();

        // রেকর্ড না পেলে crisis list এ ফেরত
        if (!$order_details) {
            return redirect()->route('crisis.list')
                ->with('error', 'ট্রানজেকশন পাওয়া যায়নি।');
        }

        if ($order_details->status == 'pending') {
            $validation = $sslc->orderValidate(
                $request->all(), $tran_id, $amount, $currency
            );

            if ($validation) {
                Donation::where('transaction_id', $tran_id)
                    ->update(['status' => 'completed']);

                // session এ tran_id রাখুন — payment.success রুটে পাবেন
                session(['tran_id' => $tran_id]);

                return redirect()->route('payment.success');
            }

            // ভ্যালিডেশন ব্যর্থ হলে
            return redirect()->route('crisis.list')
                ->with('error', 'পেমেন্ট যাচাই করা সম্ভব হয়নি।');

        } elseif ($order_details->status == 'completed') {
            return redirect()->route('payment.success');
        } else {
            return redirect()->route('crisis.list')
                ->with('error', 'অবৈধ ট্রানজেকশন।');
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
                ->with('error', 'ট্রানজেকশন পাওয়া যায়নি।');
        }

        if ($order_details->status == 'pending') {
            Donation::where('transaction_id', $tran_id)
                ->update(['status' => 'failed']);

            return redirect()->route('crisis.list')
                ->with('error', 'পেমেন্ট ব্যর্থ হয়েছে। আবার চেষ্টা করুন।');

        } elseif ($order_details->status == 'completed') {
            return redirect()->route('payment.success');
        } else {
            return redirect()->route('crisis.list')
                ->with('error', 'অবৈধ ট্রানজেকশন।');
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
                ->with('error', 'ট্রানজেকশন পাওয়া যায়নি।');
        }

        if ($order_details->status == 'pending') {
            Donation::where('transaction_id', $tran_id)
                ->update(['status' => 'cancelled']);

            return redirect()->route('crisis.list')
                ->with('error', 'পেমেন্ট বাতিল করা হয়েছে।');

        } elseif ($order_details->status == 'completed') {
            return redirect()->route('payment.success');
        } else {
            return redirect()->route('crisis.list')
                ->with('error', 'অবৈধ ট্রানজেকশন।');
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