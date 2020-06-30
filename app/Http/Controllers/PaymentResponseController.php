<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Softon\Indipay\Facades\Indipay;  
use Auth;
use App\User;
use App\Models\OrderModels;
use App\Models\OrderDetailsModels;
use Session;

class PaymentResponseController extends Controller
{
    public function paymentResponse(Request $request)
    {
        $response = Indipay::response($request);
        $response = Indipay::gateway($request->payby)->response($request);
        $getTransNumber = explode('-', $response['productinfo']);
        $updateStatus = OrderModels::where('transaction_id', $getTransNumber[1])
        ->orderBy('id','DESC')
        ->first();
        if($updateStatus)
        {
        	$updateStatus->transaction_id = $response['txnid'];
	        $updateStatus->payment_status = $response['status'];
	        $updateStatus->save();
        }
        if($response['status']=='success')
        {
        	return redirect()->route('payment-success');
        }
        return redirect()->route('payment-failed');
    }

    public function success()
    {
    	return view('frontend.payment-success');
    }

    public function failed()
    {
    	return view('frontend.payment-failed');
    } 
}
