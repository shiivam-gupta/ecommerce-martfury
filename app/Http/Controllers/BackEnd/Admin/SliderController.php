<?php

namespace App\Http\Controllers\BackEnd\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    /////////////Slider
    public function sliders()
    {
        $sliders = Slider::orderBy('id', 'DESC')->get();
        return view('backend.cms.slider', compact('sliders'));
    }

    public function addSlider()
    {
        return view('backend.cms.slider');
    }

    public function saveSlider(Request $request)
    {
        $this->validate($request, [
            'image'       => 'required',
        ]);

        $destinationPath    = 'frontend/img/slider';
        
        if($request->hasFile('image'))
        {
            $file             = $request->image;
            $sliderImg  = value(function() use ($file)
            {
              $pageImages = 'slider-'.rand(100, 999) . '.' . $file->getClientOriginalExtension();
              return strtolower($pageImages);
          	});
            $request->image  ->move($destinationPath, $sliderImg);
        }
        $slider = new Slider;
        $slider->image = $sliderImg;
        $slider->save();
        
        return redirect()->route('sliders')->with('success','Slider Added successfully.');
    }

    public function deleteSlider($id)
    {
        $destinationPath    = 'frontend/img/slider/';
        $getImage = Slider::where('id', $id)->first();
        if(file_exists($destinationPath.$getImage->image)){ 
            unlink($destinationPath.$getImage->image);
        }
        $webgallery = $getImage->delete();
        return redirect()->route('sliders')->with('success','Slider deleted successfully.');
    }
}
