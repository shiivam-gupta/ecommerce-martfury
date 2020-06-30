<?php

namespace App\Http\Controllers\BackEnd\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CouponModels;
use App\Models\CouponlistModels;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    public function coupon()
    {
    	$couponList = CouponlistModels::orderBy('id','desc')->get();
		return view('backend.pages.coupon.coupon',compact('couponList'));
    	//return view('backend.pages.coupon.coupon');
    }

    public function addCoupon()
	{
		return view('backend.pages.coupon.coupon');	
	}

	public function editCoupon($id)
	{
		$data = CouponlistModels::where('id', $id)->first();
		return View('backend.pages.coupon.coupon',compact('data'));
	}

    public function couponSave(Request $request)
    {
    	if($request->id != '')
		{  
			$this->validate($request, [
				'coupon_code'  => 'required|unique:coupon_list,coupon_code,'.$request->id,   
			]);

		} else {
	    	$this->validate($request, [  
				'title'   		=> 'required|min:2|max:60',    
				'coupon_number'   => 'required|integer',    
				'type'   => 'required',    
				'percentage_amount'   => 'required|numeric',    
				'coupon_option'   => 'required',    
			]);
		}

		if($request->id != ''){
			$couponlist = CouponlistModels::find($request->id);
		 	$couponlist->coupon_code = $request->coupon_code;
		 	$couponlist->save();
		 	return redirect(route('admin.coupon'))->with('success', 'Coupon Updated successfully.');
		} else {

		    $coupon = new CouponModels;
		 	$coupon->title = $request->title;
		 	$coupon->coupon_number = $request->coupon_number;
		 	$coupon->type = $request->type;
		 	$coupon->percentage_amount = $request->percentage_amount;
		 	$coupon->coupon_option = $request->coupon_option;
		 	$coupon->save();

		 	if ($coupon->save()) {
		 		$number = range(1,$coupon->coupon_number);
		 		foreach ($number as $value) {
		 			$couponlist = new CouponlistModels;
				 	$couponlist->coupon_code_id = $coupon->id;
				 	$couponlist->coupon_code = 'CO'.substr(uniqid('', true), -6);
				 	$couponlist->save();
		 		}
		 	}

		 	return redirect(route('admin.coupon'))->with('success', 'Coupon Created successfully.');
		}

    }

    public function deleteCoupon($id)
	{
		$delCategory = CouponlistModels::where('id', $id)->delete();
		return redirect()->route('admin.coupon')->with('delete','Coupon deleted successfully');
	}

}
