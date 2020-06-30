<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\BelowBannerContent;
use App\Models\Banner;
use App\Models\Reviews;
use App\Models\OrderModels;
use Session;
use Auth;
use App\User;
use App\Models\OrderDetailsModels;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class ProductController extends Controller
{
    public function index($slug='')
    {
        $data['product'] = $product = Product::where('slug',$slug)->where('status',1)->first();
        $data['similarCatProd'] = Product::where('category_id',$product->category_id)->limit(10)->get();
        $data['similarBrandProd'] = Product::where('brand_id',$product->brand_id)->limit(3)->get();
        $data['fiveStar'] = Reviews::where('review_rate',5)->where('product_id',$product->id)->count();
        $data['fourStar'] = Reviews::where('review_rate',4)->where('product_id',$product->id)->count();
        $data['threeStar'] = Reviews::where('review_rate',3)->where('product_id',$product->id)->count();
        $data['twoStar'] = Reviews::where('review_rate',2)->where('product_id',$product->id)->count();
        $data['oneStar'] = Reviews::where('review_rate',1)->where('product_id',$product->id)->count();
        $data['reviewData'] = Reviews::where('product_id',$product->id)->count();
        $data['reviewRate'] = Reviews::where('product_id',$product->id)->first();
        $data['totalReview'] = Reviews::where('product_id',$product->id)->get();
        $data['OrderDetails'] = OrderDetailsModels::where('user_id',Auth::id())->where('product_id',$product->id)->first();
        $data['checkReview'] = Reviews::where('user_id',Auth::id())->where('product_id',$product->id)->first();
        return view('frontend.product-detail')->with($data);
    }

    public function searchProduct(Request $request){
        $data['searchtext'] = $request->searchCategory;
        $data['searchtext'] = $request->searchtext;
        return view('frontend.product-list')->with($data);
    }

    public function getProducts(Request $request){

        $products = Product::with('getProductImages')->where('status',1);
        if($request->type == ''){
            $products = $products->orderby('id','asc');
        } elseif($request->type == 'new_arrival'){
            $products = $products->orderby('id','desc');
        }
        $data['products'] = $products = $products->limit(12)->get();

        return view('frontend.get-product')->with($data);
    }

    public function myProductView(Request $request,$id)
    {
        $product = Product::with('getProductImages','getCategory','getBrand','getReviews')->where('id',$id)->where('status',1)->first();
        $reviewData = Reviews::where('product_id',$product->id)->count();
        $reviewRate = Reviews::where('product_id',$product->id)->first();
        return view('frontend.quick-view', compact('product', 'reviewData', 'reviewRate'));
    }

    public function addToCart(Request $request,$id)
    {
        $product = Product::with('getProductImages')->find($id);

        if(!$product) {
            abort(404);
        }
 
        $cart = session()->get('cart');
        // dd($cart);
        if(!$cart) {
            $cart = [
                    $id => [
                        "productname" => $product->product_title,
                        "slug" => $product->slug,
                        "quantity" => $request->allQuantity,
                        "productprice" => $product->discounted_price,
                        "actualProductprice" => $product->actual_price,
                        "actualQuantity" => $product->quantity,
                        "description" => $product->description,
                        "productpic" => $product->getProductImages[0]->product_image,
                    ]
            ];
            session()->put('cart', $cart);
            if($request->buy_now=='Buy Now')
            {
                return redirect()->route('checkout')->with('success', 'Product added to cart successfully!');
            }
            return redirect()->route('shopping-cart')->with('success', 'Product added to cart successfully!');
        }

        if(isset($cart[$id])) {
            
            // $cart[$id]['quantity']++;
            $cart = session()->get('cart');
            $totalQuantity = $cart[$id]["quantity"] + $request->allQuantity;
            $cart[$id]['quantity'] = $totalQuantity;
 
            session()->put('cart', $cart);

            return redirect()->route('shopping-cart')->with('success', 'Product added to cart again successfully!');
 
        }
        
        $cart[$id] = [
            "productname" => $product->product_title,
            "slug" => $product->slug,
            "quantity" => $request->allQuantity,
            "productprice" => $product->discounted_price,
            "actualProductprice" => $product->actual_price,
            "actualQuantity" => $product->quantity,
            "description" => $product->description,
            "productpic" => $product->getProductImages[0]->product_image,
        ];
 
        session()->put('cart', $cart);
        
        return redirect()->route('shopping-cart')->with('success', 'New product added to cart successfully!');
    }

    public function shoppingCart()
    {
        $cart = session('cart');
        // dd($cart);
        // session::flush();
        $order = OrderModels::where('user_id',Auth::id())->first();
        return view('frontend.shopping-cart',compact('cart','order'));
    }

    public function myCart($id)
    {
        if($id) {
            $cart = session()->get('cart');
            if(isset($cart[$id])) {
 
                unset($cart[$id]);
 
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function myCartUpdate(Request $request)
    {
        if(count($request->cartProduct) > 0)
        {
            foreach($request->cartProduct as $key => $value) 
            {
                $cart = session()->get('cart');
                $cart[$key]["quantity"] = $value['quantity'];
                session()->put('cart', $cart);                            
            }

            return redirect()->back()->with('success', 'Cart updated successfully');
        }
    }

    public function addressUpdate(Request $request)
    {
        $update = OrderModels::where('user_id',Auth::id())->update(['shipping_address'=>$request->shipping_address]);
        return redirect()->back()->with('success', 'Address Updated successfully!');
    }

    public function compareItem()
    {
        return view('frontend.compare-item');
    }

    public function compareItemRemove($id)
    {
        if($id) {
            $cart = session()->get('compare');
            if(isset($cart[$id])) {

                unset($cart[$id]);

                session()->put('compare', $cart);
            }
            return redirect()->back()->with('success', 'Product removed successfully');
        }
    }

    public function checkout()
    {
        $isCart = false;
        foreach((array) session('cart') as $check)
        {
            $isCart = true;
            break;
        }
        if(!$isCart)
        {
            return redirect()->route('shopping-cart')->with('error','Cart is empty');
        }
        $order = OrderModels::where('user_id',Auth::id())->first();
        $userDetails = User::with('getState','getCity','getCountry')->where('id',Auth::id())->first();
        $name = explode(" ", $userDetails->fullname);
        $firstName = @$name[0];
        $lastName = @$name[1];
        $country = Country::get();
        // $state = State::get();
        // $city = City::get();
        $usersDetails = User::where('id',Auth::id())->first();
        return view('frontend.checkout',compact('order','userDetails','firstName','lastName','country'));
    }

    public function addToCompare(Request $request,$id)
    {
        $product = Product::with('getProductImages')->find($id);

        if(!$product) {
            abort(404);
        }
 
        $compare = session()->get('compare');
        
        if(!$compare) {
            $compare = [
                    $id => [
                        "productname" => $product->product_title,
                        "quantity" => $request->allQuantity,
                        "productprice" => $product->discounted_price,
                        "actualProductprice" => $product->actual_price,
                        "actualQuantity" => $product->quantity,
                        "description" => $product->description,
                        "productpic" => $product->getProductImages[0]->product_image,
                    ]
            ];
            session()->put('compare', $compare);
            return redirect()->back()->with('success', 'Product added to compare list successfully!');
        }

        if(isset($compare[$id])) {

            $compare = session()->get('compare');
            session()->put('compare', $compare);

            return redirect()->back()->with('success', 'You have already added this product in compare list');
        }
        
        $compare[$id] = [
            "productname" => $product->product_title,
            "quantity" => $request->allQuantity,
            "productprice" => $product->discounted_price,
            "actualProductprice" => $product->actual_price,
            "actualQuantity" => $product->quantity,
            "description" => $product->description,
            "productpic" => $product->getProductImages[0]->product_image,
        ];

        session()->put('compare', $compare);
        
        return redirect()->back()->with('success', 'Product added to compare list successfully!');
    }

    public function getState(Request $request)
    {
        $data['state'] = State::where('country_id',$request->country_other)->get();
        $html = '';
        foreach ($data['state'] as $key => $value) {
            $html .= '<option value="'.$value->id.'" ';
            if($value->id == $request->state_other){
                $html .= 'selected'; 
            }
            $html .='>'.$value->name.'</option>';
        }

        echo json_encode(['html' => $html,'code' => 200]);

    }

    public function getCity(Request $request)
    {
        $data['city'] = City::where('state_id',$request->state_other)->get();
        // dd($data['city']);
        $html = '';
        foreach ($data['city'] as $key => $value) {
            $html .= '<option value="'.$value->id.'" ';
            if($value->id == $request->city_other){
                $html .= 'selected'; 
            }
            $html .='>'.$value->name.'</option>';
        }

        echo json_encode(['html' => $html,'code' => 200]);
    
    }
}
