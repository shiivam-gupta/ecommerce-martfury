<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Softon\Indipay\Facades\Indipay;  
use Auth;
use App\User;
use App\Models\OrderModels;
use App\Models\OrderDetailsModels;
use App\Models\CouponlistModels;
use Session;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
    	if(isset($request->different_address) && $request->different_address)
		{
            $this->validate($request, [
	            'payby' 			=> 'required',
                'first_name_other' 	=> 'required',
                'last_name_other' 	=> 'required',
                'email_other' 		=> 'required',
                'phone_other' 		=> 'required',
                'country_other' 	=> 'required',
                'state_other' 		=> 'required',
                'city_other' 		=> 'required',
                'address_other' 	=> 'required'
	        ]);
		}
    	\DB::beginTransaction();
        try {
        	$orderInfo = $this->createOrder($request->all());
        	if ($request->payby == 'cod') {
	    		//dd('cod');
	    	} else if($request->payby == 'payumoney') {
	    		$parameters = [
	                'firstname' 		=> $orderInfo['order']['first_name'],
	                'lastname' 			=> $orderInfo['order']['last_name'],
	                'curl' 				=> '',
	                'address1' 			=> $orderInfo['order']['address'],
	                'address2' 			=> '',
	                'city' 				=> $orderInfo['order']['city'],
	                'state' 			=> $orderInfo['order']['state'],
	                'country' 			=> $orderInfo['order']['country'],
	                'zipcode' 			=> '',
	                'udf1' 				=> '',
	                'udf2' 				=> '',
	                'udf3' 				=> '',
	                'udf4' 				=> '',
	                'udf5' 				=> '',
	                'pg' 				=> '',
	                'email' 			=> $orderInfo['order']['email'],
	                'phone' 			=> $orderInfo['order']['phone'],
	                'productinfo' 		=> 'SYLIS-'.$orderInfo['order']['transaction_id'],
	                'service_provider' 	=> 'payu_paisa',
	                'amount' 			=> $orderInfo['total_amount'],
	            ];
	    		$order = Indipay::gateway('PayUMoney')->prepare($parameters);
	    		\DB::commit();
	    	} else if($request->payby == 'razorpay'){
	    		dd('razorpay');
	    	}
	    	return Indipay::process($order);
            return redirect()->back()->with('success', 'Order placed successfully');
        } catch (\Exception $exception) {
            \DB::rollback();
            return redirect()->back()->with('error', $exception->getMessage());
        } catch (\Throwable $exception) {
            \DB::rollback();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    } 

    private function createOrder($request)
    {
    	$transaction_number = mt_rand(1000000000, 9999999999);
    	$totalAmount = 0;
		foreach(session('cart') as $key => $item)
		{
			$totalAmount+= $item['quantity'] * $item['productprice'];
		}

    	$subtotal 		= $request['subtotal'];
		$total_discount = $request['total_discount'];
		$total_tax 		= $request['total_tax'];
		$calculateTotalAmount = $totalAmount + $request['total_tax'];
    	$order = new OrderModels;
    	$order->user_id = Auth::id();
    	if(isset($request->different_address) && $request->different_address)
		{
			$order->first_name 	= $request['first_name_other'];
			$order->last_name 	= $request['last_name_other'];
			$order->email 		= $request['email_other'];
			$order->phone 		= $request['phone_other'];
			$order->country 	= $request['country_other'];
			$order->state 		= $request['state_other'];
			$order->city 		= $request['city_other'];
			$order->address 	= $request['address_other'];
		}
		else
		{
			$order->first_name 	= $request['first_name'];
			$order->last_name 	= $request['last_name'];
			$order->email 		= $request['email'];
			$order->phone 		= $request['phone'];
			$order->country 	= $request['country'];
			$order->state 		= $request['state'];
			$order->city 		= $request['city'];
			$order->address 	= $request['address'];
		}
		$order->payby 			= $request['payby'];
		$order->currency_id 	= $request['currency_id'];
		$order->transaction_id 	= ($order->payby=='cod') ? 'COD-': ''.$transaction_number;
		$order->additional_note = $request['additional_note'];
		if($request['coupon_code'])
		{
			$checkCoupon = CouponlistModels::where('coupon_code', $request['coupon_code'])->first();
			if($checkCoupon)
			{
				$order->coupon_code 	= $request['coupon_code'];
				$checkDiscount = $checkCoupon->getCouponCode;
				if($checkDiscount->type==1)
				{
					//Percentage
					$total_discount = round((($calculateTotalAmount * $checkDiscount->percentage_amount)/100), 2);
				}
				else
				{
					//Fixed 
					$total_discount = $checkDiscount->percentage_amount;
				}

				$updateCouponStatus = CouponlistModels::find($checkCoupon->id);
				$usedBy[] = $updateCouponStatus->used_by;
				$newUsers[] = array_push($usedBy,auth()->id());
				$updateCouponStatus->is_used = ($checkDiscount->coupon_option==1) ? 1 : 0;
				$updateCouponStatus->used_by = $newUsers;
				$updateCouponStatus->save();
			}
		}
		$order->subtotal 		= $subtotal;
		$order->total_discount 	= $total_discount;
		$order->total_tax 		= $total_tax;
		$order->total 			= $calculateTotalAmount - $total_discount;
		$order->save();
		if($order)
		{
			foreach(session('cart') as $key => $item)
			{
				$orderDetail = new OrderDetailsModels;
				$orderDetail->user_id = auth()->id();
				$orderDetail->order_id = $order->id;
				$orderDetail->product_id = $key;
				$orderDetail->quantity = $item['quantity'];
				$orderDetail->product_price = $item['productprice'];
				$orderDetail->total_amount = $item['quantity'] * $item['productprice'];
				$orderDetail->save();
			}
		}
		$return = [
			'total_amount' 	=> $order->total,
			'order'			=> $order
		];
		return $return;
    }

    public function applyCoupon(Request $request)
    {
    	$checkCoupon = CouponlistModels::select('coupon_list.id as id','coupon_code', 'is_used', 'used_by', 'type', 'percentage_amount', 'coupon_option')
    	->join('coupon_code', function ($join) {
            $join->on('coupon_list.coupon_code_id', '=', 'coupon_code.id');
        })
        ->where('coupon_code', $request->coupon_code)
        ->where('is_used', '0')
        ->first();
		if($checkCoupon)
		{
			if(!empty($checkCoupon->used_by))
			{
				if(($checkCoupon->coupon_option == 0) && (in_array(auth()->id(), $checkCoupon->used_by)))
				{
					return false;
				}
			}

			$totalAmount = 0;
			foreach(session('cart') as $key => $item)
			{
				$totalAmount+= $item['quantity'] * $item['productprice'];
			}

			$total_tax 		= $request->total_tax;
			$calculateTotalAmount = $totalAmount + $total_tax;
			if($checkCoupon->type=='1')
			{
				//Percentage
				$total_discount = round((($calculateTotalAmount * $checkCoupon->percentage_amount)/100), 2);
			}
			else
			{
				//Fixed 
				$total_discount = $checkCoupon->percentage_amount;
			}

			$return = [
				'status' 			=> 'applied',
				'total_discount' 	=> $total_discount,
				'totalAmount' 		=> $calculateTotalAmount - $total_discount,
				'message' 		=> 'Discount coupon applied and you got '.env('PRICE_SYMBOL', 'Rs ').$total_discount.' off.',
			];
			return $return;
		}
		return false;
    }
}
