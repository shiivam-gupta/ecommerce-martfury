<?php

namespace App\Http\Controllers\BackEnd\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BelowBannerContent;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BelowBannerContentController extends Controller
{
   	public function belowBanner()
	{
		
		$bannerList = BelowBannerContent::orderBy('id','desc')->get();
		return view('backend.pages.belowbanner.belowbanner',compact('bannerList'));
	}

	public function addBelowBanner()
	{
		return view('backend.pages.belowbanner.belowbanner');	
	}


	public function editBelowBanner($id)
	{
		$data = BelowBannerContent::where('id', $id)->first();
		return View('backend.pages.belowbanner.belowbanner',compact('data'));
	}


	public function saveBelowBanner(Request $request)
	{  
		//dd($request->all());
		
		$rules['title'] = 'required|min:2|max:60';
		$rules['content'] = 'required|min:2|max:60';

		if($request->id == '')
		{  
            $rules['image_icon'] = 'required|image|mimes:jpeg,jpg,png,jfif';
		}

		$validator = Validator::make($request->all(),$rules,
        [
            'image_icon.required' => 'Please select Image',
    	]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

		if(!empty($request->id)) {
			$banner = BelowBannerContent::find($request->id);
		}
		else {
			$banner  = new BelowBannerContent;
			
		}

		if(isset($request->image_icon))
        {
            $imageName = '';
            $imageName = \Str::Random('6').time().'.'.$request->image_icon->extension();
            $request->image_icon->move(public_path('belowbanner'), $imageName);
            $image_icon = 'belowbanner/'.$imageName;
			$banner->image_icon  = $image_icon;      
        }
        $banner->title  = $request->title;
        $banner->content  = $request->content;

		$banner->save();
		if(empty($request->id)) {
			return redirect()->route('belowbanner')->with('success','Below Banner Content added successfully');
		}
		elseif(!empty($request->id)) {
			return redirect()->route('belowbanner')->with('success','Below Banner Content updated successfully');
		}
	}

	public function deleteBelowBanner($id)
	{
		$delCanner = BelowBannerContent::where('id', $id)->delete();
		return redirect()->route('belowbanner')->with('delete','Below Banner Content deleted successfully');
	}

	public function belowBannerAction(Request $request)
    {
      	$data  = $request->all();
      	foreach($request->input('boxchecked') as $action)
      	{
          	if($request->input('cmbaction')=='Active')
          	{
              	BelowBannerContent::where('id', $action)->update(array('status' => '1'));
          	}
          	else
          	{
              	BelowBannerContent::where('id', $action)->update(array('status' => '0'));
          	}
      	}
      	return \Redirect()->back()->with('success', 'Action successfully done.');
  	}
}
