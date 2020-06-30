<?php

namespace App\Http\Controllers\BackEnd\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BannerManageController extends Controller
{
   	public function banner()
	{
		
		$bannerList = Banner::orderBy('id','desc')->get();
		return view('backend.pages.banner.banner',compact('bannerList'));
	}

	public function addBanner()
	{
		return view('backend.pages.banner.banner');	
	}


	public function editBanner($id)
	{
		$data = Banner::where('id', $id)->first();
		return View('backend.pages.banner.banner',compact('data'));
	}


	public function saveBanner(Request $request)
	{  
		//dd($request->all());
		
		if($request->id != '')
		{  
			$rules['expiry_date'] = 'required|after:today';
		} else {
			$rules['expiry_date'] = 'required|after:today';
            $rules['banner_image'] = 'required|image|mimes:jpeg,jpg,png,jfif';
		}

		$validator = Validator::make($request->all(),$rules,
        [
            'banner_image.required' => 'Please select Image',
    	]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

		if(!empty($request->id)) {
			$banner = Banner::find($request->id);
		}
		else {
			$banner  = new Banner;
			$banner->pages  = 'home';
		}

		if(isset($request->banner_image))
        {
            $imageName = '';
            $imageName = \Str::Random('6').time().'.'.$request->banner_image->extension();
            $request->banner_image->move(public_path('banner'), $imageName);
            $banner_image = 'banner/'.$imageName;
			$banner->banner_image  = $banner_image;      
        }
		$banner->expiry_date  = Carbon::createFromFormat('m/d/Y', $request->expiry_date)->format('Y-m-d');
		$banner->save();
		if(empty($request->id)) {
			return redirect()->route('banner')->with('success','Banner added successfully');
		}
		elseif(!empty($request->id)) {
			return redirect()->route('banner')->with('success','Banner updated successfully');
		}
	}

	public function deleteBanner($id)
	{
		$delCanner = Banner::where('id', $id)->delete();
		return redirect()->route('banner')->with('delete','Banner deleted successfully');
	}

	public function bannerAction(Request $request)
    {
      	$data  = $request->all();
      	foreach($request->input('boxchecked') as $action)
      	{
          	if($request->input('cmbaction')=='Active')
          	{
              	Banner::where('id', $action)->update(array('status' => '1'));
          	}
          	else
          	{
              	Banner::where('id', $action)->update(array('status' => '0'));
          	}
      	}
      	return \Redirect()->back()->with('success', 'Action successfully done.');
  	}
}
