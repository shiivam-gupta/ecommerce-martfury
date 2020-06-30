<?php

namespace App\Http\Controllers\BackEnd\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quicklink;

class QuicklinkController extends Controller
{
    public function quicklink()
    {
    	$quicklink = Quicklink::orderBy('id','desc')->get();
		return view('backend.cms.quicklink',compact('quicklink'));
    }

    public function addQuicklink()
	{
		return view('backend.cms.quicklink');	
	}

	public function editQuicklink($id)
	{
		$quicklink = Quicklink::where('id', $id)->first();
		return View('backend.cms.quicklink',compact('quicklink'));
	}

    public function quicklinkSave(Request $request)
    {
    	if($request->id != '')
		{  
			$this->validate($request, [   
				'title' => 'required',    
				'description' => 'required',  
				'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000'
			]);

		} else {
	    	$this->validate($request, [  
				'quicklink_slug' => 'required',    
				'title' => 'required',    
				'description' => 'required',  
				'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000'
			]);
		}

		if($request->id != ''){
			$destinationPath    = 'frontend/img/quicklink';
	        $quickImg = $request->old_image;
	        if($request->hasFile('image'))
	        {
	            $file        = $request->image;
	            $quickImg  = value(function() use ($file)
	            {
	              $pageImages = 'quicklink-'.rand(100, 999) . '.' . $file->getClientOriginalExtension();
	              return strtolower($pageImages);
	          	});
	            $request->image  ->move($destinationPath, $quickImg);
	        }
			$quicklink = Quicklink::find($request->id);
		 	$quicklink->title = $request->title;
		 	$quicklink->subtitle = $request->subtitle;
		 	$quicklink->description = $request->description;
		 	$quicklink->image 		= $quickImg;
		 	$quicklink->save();
		 	return redirect(route('admin.quicklink'))->with('success', 'Quicklink Updated successfully.');
		} else {
			$destinationPath    = 'frontend/img/quicklink';
	        $quickImg = $request->old_image;
	        if($request->hasFile('image'))
	        {
	            $file        = $request->image;
	            $quickImg  = value(function() use ($file)
	            {
	              $pageImages = 'quicklink-'.rand(100, 999) . '.' . $file->getClientOriginalExtension();
	              return strtolower($pageImages);
	          	});
	            $request->image  ->move($destinationPath, $quickImg);
	        }

		 	$quicklink['quicklink_slug'] = $request->quicklink_slug;
		 	$quicklink['title'] = $request->title;
		 	$quicklink['subtitle'] = $request->subtitle;
		 	$quicklink['description'] = $request->description;
		 	$quicklink['image'] 		= $quickImg;

		 	$quicklinkData = Quicklink::updateOrCreate([
            	'quicklink_slug'   => $request->quicklink_slug,
        	],$quicklink);

		 	return redirect(route('admin.quicklink'))->with('success', 'Quicklink Created successfully.');
		}

    }

    public function deleteQuicklink($id)
	{
		$deletequicklink = Quicklink::where('id', $id)->delete();
		return redirect()->route('admin.quicklink')->with('delete','Quicklink deleted successfully');
	}
}
