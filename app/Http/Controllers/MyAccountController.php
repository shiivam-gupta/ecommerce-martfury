<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Mail\RegistrationEmail;
use Illuminate\Http\Request;
use App\Models\OrderDetailsModels;
use App\Models\WishlistModels;
use App\Models\OrderModels;
use App\Models\Product;
use App\Models\Reviews;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\NewsLetter;
use App\Models\Brand;
use App\Models\Category;
use App\User;
use DateTime;
use URL;
use Redirect;
use Session;

class MyAccountController extends Controller
{
    public function index()
    {
    	$data['country'] = Country::get();
        Session::put('url.intended',URL::previous());
    	return view('frontend.my-account')->with($data);
    }

    public function attemptlogin(Request $request){

    	$request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

    	$user = User::where('email', $request->email)->first();
    	if($user){
    		if($user->status == ACTIVE){
		    	if($user->hasRole('Customer')){
			    	$credentials = $request->only('email', 'password');
			    	
			        if (Auth::guard()->attempt($credentials, $request->filled('remember'))) {
			            // return redirect()->route('index');
                        return Redirect::to(Session::get('url.intended'));
			        } else {
			        	return redirect()->route('account.login')->with('failure','You entered wrong Password.');
			        }
		    	} else {
		    		return redirect()->route('account.login')->with('failure','Unauthorized Access.');
		    	}
    		} else {
    			return redirect()->route('account.login')->with('failure','Your Account is inactive. Please contact Administrator.');
    		}
    	} else {
	    	return redirect()->route('account.login')->with('failure','You entered Invalid Credentials.');
	    }

    } 

    public function attemptRegister(Request $request){

    	$validator = Validator::make($request->all(),[

            'fullname' => 'required|min:2|max:60',
            'phone_code' => 'required',
            'phone_no' => 'required|integer|min:1000000000|max:9999999999',
            'country_id' => 'required',
            'state_id' => 'required',
            'address' => 'required|min:2|max:200',
            'r_email' => 'required|unique:users,email',
            'pincode' => 'required|min:5|max:6',
            'r_password' => 'required|string|min:8|max:16',
        ],
        [
        	'country_id.required' => 'Please select Country',
        	'state_id.required' => 'Please select State',
        	'phone_no.max' => 'Phone No. cannot be more than 10 digits.',
        	'phone_no.min' => 'Phone No. cannot be less than 10 digits.',
        	'r_email.required' => 'Email Field Is required.',
        	'r_email.unique' => 'The email has already been taken.',
        	'r_password.required' => 'Password Field Is required.',
        	'r_password.max' => 'Password cannot be more than 16 character.',
        	'r_password.min' => 'Password cannot be less than 8 character.',

    	]);

        if ($validator->fails()) {
            return redirect(route('account.register'))
                        ->withErrors($validator)
                        ->withInput();
        }
        $input = $request->all();
        $input['email'] = $request->r_email;
        $input['password'] = bcrypt($request->r_password);
        $id = '';
        $user = User::UpdateOrCreate(['id' => $id],$input);
        $user->assignRole('Customer');

        $data = ([
            'name' => $request->fullname,
            'email' => $request->r_email,
            'phone' => $request->phone_code.' '.$request->phone_no,
        ]);
        \Mail::to($request->r_email)->send(new RegistrationEmail($data));

        return redirect(route('account.login'))->with('success', 'User has been Registered successfully.');
    }

    public function forgotPassword(){

    	return view('frontend.forgot-password');
    }

    public function myProfile()
    {
        $data['usersDetails'] = User::where('id',Auth::id())->first();
        // $data['orderDetails'] = OrderDetailsModels::where('user_id',Auth::id())->get();
        $data['country'] = Country::get();
        $data['state'] = State::get();
        $data['city'] = City::get();
    	return view('frontend.my-profile')->with($data);
    }

    public function MyProfileUpdate(Request $request){
        $validator = Validator::make($request->all(),[

            'fullname' => 'required|min:2|max:60',
            'phone_code' => 'required',
            'phone_no' => 'required|integer|min:1000000000|max:9999999999',
            'country_id' => 'required',
            'state_id' => 'required',
            'address' => 'required|min:2|max:200',
            // 'r_email' => 'required|unique:users,email',
            'pincode' => 'required|min:5|max:6',
        ],
        [
            'country_id.required' => 'Please select Country',
            'state_id.required' => 'Please select State',
            'phone_no.max' => 'Phone No. cannot be more than 10 digits.',
            'phone_no.min' => 'Phone No. cannot be less than 10 digits.',
            'r_email.required' => 'Email Field Is required.',
            'r_email.unique' => 'The email has already been taken.',

        ]);

        if ($validator->fails()) {
            return redirect(route('my-profile'))
                        ->withErrors($validator)
                        ->withInput();
        }
        $input = $request->all();
        $input['email'] = $request->r_email;
        $id = Auth::id();
        $user = User::UpdateOrCreate(['id' => $id],$input);

        return redirect(route('my-profile'))->with('success', 'Your profile has been updated successfully.');
    }

    public function getState(Request $request){

        $data['state'] = State::where('country_id',$request->country_id)->get();
        $html = '';
        foreach ($data['state'] as $key => $value) {
            $html .= '<option value="'.$value->id.'" ';
            if($value->id == $request->state_id){
                $html .= 'selected'; 
            }
            $html .='>'.$value->name.'</option>';
        }

        echo json_encode(['html' => $html,'code' => 200]);

    }

    public function getCity(Request $request){
        $data['city'] = City::where('state_id',$request->state_id)->get();
        $html = '';
        foreach ($data['city'] as $key => $value) {
            $html .= '<option value="'.$value->id.'" ';
            if($value->id == $request->city_id){
                $html .= 'selected'; 
            }
            $html .='>'.$value->name.'</option>';
        }

        echo json_encode(['html' => $html,'code' => 200]);
    }

    public function myOrders()
    {
        $orderDetails = OrderModels::with('userDetails','ordersDetails')->where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
        return view('frontend.my-orders',compact('orderDetails'));
    }

    public function myOrdersDetails($transaction_id)
    {
        $orders = OrderModels::with('userDetails','ordersDetails')->where('transaction_id',$transaction_id)->where('user_id', Auth::id())->first();
        if($orders)
        {
            return view('frontend.my-orders-details',compact('orders'));
        }
        return redirect()->back()->with('error', 'Order not found..');
    }

    public function myReviews()
    {
        $reviewsDetails = Reviews::where('user_id',Auth::id())->get();
        return view('frontend.my-reviews',compact('reviewsDetails'));
    }

    public function myresetPass()
    {
        $usersDetails = User::where('id',Auth::id())->first();
        return view('frontend.my-resetpass',compact('usersDetails'));
    }

    public function myresetPassUpdate(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'password' => 'required|confirmed|string|min:8|max:16',
            'password_confirmation' => 'required|min:8|max:16'
        ],
        [
            'password.required' => 'Password Field Is required.',
            'password.max' => 'Password cannot be more than 16 character.',
            'password.min' => 'Password cannot be less than 8 character.',
            'password.confirmed' => 'Confirm password does not match.',
            'password_confirmation.required' => 'Confirm password field is required.',

        ]);
        if ($validator->fails()) {
            return redirect(route('my-resetpass'))
                        ->withErrors($validator)
                        ->withInput();
        }
        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        $user = User::UpdateOrCreate(['id' => Auth::id()],$input);
    
        return redirect(route('my-resetpass'))->with('success', 'Your password has been changed successfully.');
    }

    public function myWishlist($id)
    {
        $wish = WishlistModels::where('user_id',Auth::id())->where('product_id',$id)->first();
        if ($wish) {
            $wishDelete = WishlistModels::find($wish->id);
            $wishDelete->delete($id);
           // return response()->json(['status' => 402, "message" => "failure"]);
            return redirect()->back()->with('success', 'You have removed a product in wishlist.');
        }else{
            $input['product_id'] = $id;
            $input['user_id'] = Auth::id();
            $user = WishlistModels::updateOrCreate([
                'product_id'   => $id,
            ],$input);
             // return response()->json(['status' => 200, "message" => "success"]);
            return redirect()->back()->with('success', 'You have added a product in wishlist.');
        }
    }

    public function myWishlistProduct()
    {
        $wishList = WishlistModels::with('wishlistProduct')->where('user_id',Auth::id())->get();
        $brandName = Brand::all();
        $getAllCat = Category::where('status',1)->get();
        return view('frontend.my-wishlist-product',compact('wishList','brandName','getAllCat'));
    }

    public function newsLetter(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'news_email' => 'required|email|unique:newsletter',
        ]);
        
        if ($validator->fails())
        {
            return response()->json(['status' => 402,'errors'=>$validator->errors()->all()]);
        }

        $ip = $_SERVER['REMOTE_ADDR'];
        $news = New NewsLetter;
        $news->news_email = $request->news_email;
        $news->ip_address = $ip;
        $news->save();
        return response()->json(['status' => 200, "message" => "success"]);

    }

    public function myReviewsSave(Request $request)
    {
        // dd($request->all());
        $checkReview = Reviews::where('user_id',Auth::id())->where('product_id',$request->product_id)->first();

        if($checkReview) {
            return redirect()->back()->with('error','you have already given your review rate.');
        }else{

            $OrderDetails = OrderDetailsModels::where('user_id',Auth::id())->where('product_id',$request->product_id)->first(); 
            
            if ($OrderDetails == '') {
                return redirect()->back()->with('error','You have not placed this order.');
            }

            $request->validate([
                'review_rate' => 'required',
                'comment' => 'required',
            ]);

            $review = New Reviews;
            $review->user_id = Auth::id();
            $review->product_id = $request->product_id;
            $review->order_id = $OrderDetails->order_id;
            $review->review_rate = $request->review_rate;
            $review->comment = $request->comment;
            $review->save();

            if($review->save())
            {
                $reviewCount = Reviews::where('product_id',$request->product_id)->count();
                $reviewRate = Reviews::where('product_id',$request->product_id)->sum('review_rate');
                $finalReview =  $reviewRate / $reviewCount;
                $updateProduct = Product::where('id',$request->product_id)->update(['review_rate'=>$finalReview,'total_review'=>$reviewCount]);
            }

            return redirect()->back()->with('success','Review save successfully.');
        }
        
    }

    public function Logout(){

    	Auth::logout();
        return redirect(route('account.login'));
    }
}
