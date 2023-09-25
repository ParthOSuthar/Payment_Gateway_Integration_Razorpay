<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Payment;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Razorpay\Api\Api;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECERET'));
        $plans = $api->plan->all();
        return view('Products.index')->with(['products'=>$products,'plans'=>$plans]);
    }

    public function store(Request $request) {
        $input = $request->all();
        $api = new Api (env('RAZORPAY_KEY'), env('RAZORPAY_SECERET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
                $payment = Payment::create([
                    'r_payment_id' => $response['id'],
                    'method' => $response['method'],
                    'currency' => $response['currency'],
                    'user_email' => $response['email'],
                    'amount' => $response['amount']/100,
                    'json_response' => json_encode((array)$response)
                ]);
            } catch(Exception $e) {
                return $e->getMessage();
                Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }
        Session::put('success',('Payment Successful'));
        return redirect()->route('orderconfirm.page');
    }

    public function orderconfirm(){
        $paymentdetails = Payment::latest()->take(1)->get();
        return view('Products.orderconfirm')->with('paymentdetails',$paymentdetails);
    }

    public function subscription(Request $request){
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECERET'));
        $sub  = $api->subscription->create(array('plan_id' => $request->plan_id, 'total_count' => 12));
        Subscription::create([
            'subscription_id' => $sub->id,
            'plan_id' => $request->plan_id,
            'subscription_start_date' => Carbon::now(),
            'subscription_end_date' => Carbon::now()->addMonth(),
        ]);
        return view('Subscription.payment')->with('subs',$sub);
    }

    public function subscriptionconfirm(){
        return view('Subscription.thankyou');
    }
}
