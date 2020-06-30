<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\BelowBannerContent;
use App\Models\Banner;
use App\Models\Aboutus;
use App\Models\Contactus;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Quicklink;
use App\Models\Faqs;

class HomeController extends Controller
{
    public function index()
    {
    	$data['topCategory'] = Category::where('status',1)->orderby('id','desc')->limit(12)->get();

    	$data['firstRightImage'] = Banner::where('status',1)->where('pages','banner_right_image1')->first();
    	$data['secondRightImage'] = Banner::where('status',1)->where('pages','banner_right_image2')->first();
    	$data['banner'] = Banner::where('status',1)->orderby('id','desc')->limit(10)->get();

    	$data['belowBanner'] = BelowBannerContent::where('status',1)->orderby('id','desc')->get();
    	
    	return view('frontend.home')->with($data);
    }

    public function searchProduct(Request $request)
    {
        if ($request->serchbrand) {
            $brandName = Brand::where('name',$request->serchbrand)
                ->orWhere('name', 'like', '%' . $request->serchbrand . '%')->first();
            if ($brandName) {
                $product = Product::with('getProductImages')->where('status',1)->where('brand_id',$brandName->id)->paginate(12);
            }
        }else{
            $category = explode('_', $request->searchCategory);
            $catSlug = end($category);
            $firstCategory = Category::where('slug',$catSlug)->first();
            $secondCategory = SubCategory::where('slug',$catSlug)->first();
            $thirdCategory = ChildCategory::where('slug',$catSlug)->first();

            if ($firstCategory) {
                $product = Product::with('getProductImages')->where('status',1)->where('category_id',$firstCategory->id)->paginate(12); 
            }else if($secondCategory){
                $product = Product::with('getProductImages')->where('status',1)->where('subcategory_id',$secondCategory->id)->paginate(12);
            }else if($thirdCategory){
                $product = Product::with('getProductImages')->where('status',1)->where('childcategory_id',$thirdCategory->id)->paginate(12);
            }else if($request->searchtext){
                $product = Product::with('getProductImages')->where('status',1)->orWhere('product_title', 'like', '%' . $request->searchtext . '%')->paginate(12);
            }
        }

        $brandName = Brand::all();
    	// $data['searchtext'] = $request->searchCategory;
    	// $data['searchtext'] = $request->searchtext;
    	return view('frontend.product-list',compact('product','brandName'));
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

    public function aboutUs(){

        $data['aboutus'] = Aboutus::first();
        return view('frontend.about-us')->with($data);
    }

    public function contactUs()
    {
        return view('frontend.contact-us');
    }

    public function contactUsSave(Request $request)
    {

        $this->validate($request, [  
            'fullname' => 'required|min:2|max:60',    
            'email' => 'required|email|unique:contactus',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:10',    
            'address' => 'required',    
            'message' => 'required',    
        ]);

        $ip = $_SERVER['REMOTE_ADDR'];
        $contact = new Contactus;
        $contact->name = $request->fullname;
        $contact->email = $request->email;
        $contact->mobile = $request->mobile;
        $contact->address = $request->address;
        $contact->message = $request->message;
        $contact->ip_address = $ip;
        $contact->save();

        return redirect(route('contact-us'))->with('success', 'We have received your message,We will contact you soon.');
    }

    public function policy()
    {
        $quickData = Quicklink::where('quicklink_slug', 'policy')->first();
        return view('frontend.policy',compact('quickData'));
    }

    public function termCondition()
    {
        $quickData = Quicklink::where('quicklink_slug', 'termcondition')->first();
        return view('frontend.term-condition',compact('quickData'));
    }

    public function shipping()
    {
        $quickData = Quicklink::where('quicklink_slug', 'shipping')->first();
        return view('frontend.shipping',compact('quickData'));
    }

    public function return()
    {
        $quickData = Quicklink::where('quicklink_slug', 'return')->first();
        return view('frontend.return',compact('quickData'));
    }

    public function faqs()
    {
        $faqsData = Faqs::all();
        return view('frontend.faqs',compact('faqsData'));
    }
}
