<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Providers;

class Callback extends Controller
{

    public static function cb(Request $request)
    {
        // dd($request);
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $attributes = array(
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature,
        );

       $data= $api->utility->verifyPaymentSignature($attributes);
        $payment = $api->payment->fetch($request->razorpay_payment_id);
        //save this to database
        $amountPaid=$payment->amount;

$user_email=$request->user_email;
// dd($payment);
        // dd($payment);

$serviceEmail=session()->get("serviceEmail");
// dd($serviceEmail);
        $user_details = DB::table('users')->where('email', $user_email)->get('id');

        $user_id=$user_details[0]->id;
        // dd($user_details[0]->id);
          $user = User::find($user_id);

            $service_data = DB::table('providers')->where('email', $serviceEmail)->get();
        
        $service_provider_id = $service_data[0]->{'id'};


   $user->services()->attach($service_provider_id , ['status' => 'pending','amount'=>$payment->amount, 'currency'=>$payment->currency, 'order_id'=> $payment->order_id]);
        
        return redirect('/profile');

    }
}
