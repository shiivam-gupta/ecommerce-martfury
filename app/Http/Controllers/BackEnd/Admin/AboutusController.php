<?php

namespace App\Http\Controllers\BackEnd\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aboutus;

class AboutusController extends Controller
{
    public function aboutus()
    {
        $aboutus = Aboutus::first();
        return view('backend.cms.aboutus', compact('aboutus'));
    }

    public function saveAboutus(Request $request)
    {
        $this->validate($request, [
            'title'       => 'required',
            'description' => 'required'
        ]);

        $destinationPath    = 'frontend/img/aboutus';
        $aboutusImg = $request->old_image;
        if($request->hasFile('image'))
        {
            $file        = $request->image;
            $aboutusImg  = value(function() use ($file)
            {
              $pageImages = 'about-us-'.rand(100, 999) . '.' . $file->getClientOriginalExtension();
              return strtolower($pageImages);
          	});
            $request->image  ->move($destinationPath, $aboutusImg);
        }
        $aboutus = Aboutus::first();
        $aboutus->title 		= $request->title;
        $aboutus->subtitle 		= $request->subtitle;
        $aboutus->description 	= $request->description;
        $aboutus->image 		= $aboutusImg;
        $aboutus->save();
        
        return redirect()->route('aboutus')->with('success','About us updated successfully.');
    }
}
