<?php

namespace App\Http\Controllers\BackEnd\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appsetting;

class AppsettingController extends Controller
{
    public function appsetting()
    {
        $appsetting = Appsetting::first();
        return view('backend.pages.app-setting', compact('appsetting'));
    }

    public function saveAppsetting(Request $request)
    {
        $destinationPath    = 'frontend/img/aboutus';
        $app_logo 			= $request->old_app_logo;
        $app_logo_footer 	= $request->old_app_logo_footer;
        $app_favicon 		= $request->old_app_favicon;
        $appName = \Str::slug(substr($request->app_name, 0, 30));
        if($request->hasFile('app_logo'))
        {
            $file        = $request->app_logo;
            $app_logo  = value(function() use ($file, $appName)
            {
              $pageImages = $appName. '.' . $file->getClientOriginalExtension();
              return strtolower($pageImages);
          	});
            $request->app_logo  ->move($destinationPath, $app_logo);
        }

        if($request->hasFile('logo_footer'))
        {
            $file        = $request->logo_footer;
            $app_logo_footer  = value(function() use ($file, $appName)
            {
              $pageImages = $appName.'-footer'. '.' . $file->getClientOriginalExtension();
              return strtolower($pageImages);
          	});
            $request->logo_footer  ->move($destinationPath, $app_logo_footer);
        }

        if($request->hasFile('favicon'))
        {
            $file        = $request->favicon;
            $app_favicon  = value(function() use ($file, $appName)
            {
              $pageImages = 'favicon.' . $file->getClientOriginalExtension();
              return strtolower($pageImages);
          	});
            $request->favicon  ->move($destinationPath, $app_favicon);
        }
        $appsetting = Appsetting::first();
        $appsetting->app_name         = $request->app_name;
        $appsetting->email            = $request->email;
        $appsetting->seo_keyword      = $request->seo_keyword;
        $appsetting->seo_description  = $request->seo_description;
        $appsetting->google_analytics = $request->google_analytics;
        $appsetting->app_logo         = $app_logo;
        $appsetting->app_logo_footer  = $app_logo_footer;
        $appsetting->app_favicon  	  = $app_favicon;
        $appsetting->copyright        = $request->copyright;
        $appsetting->safe_payment     = $request->safe_payment;
        $appsetting->contact_title    = $request->contact_title;
        $appsetting->contact_address  = $request->contact_address;
        $appsetting->contact_phone    = $request->contact_phone;
        $appsetting->facebook         = $request->facebook;
        $appsetting->twitter          = $request->twitter;
        $appsetting->google_plus      = $request->google_plus;
        $appsetting->instagram        = $request->instagram;
        $appsetting->newsletter_title = $request->newsletter_title;
        $appsetting->newsletter_description = $request->newsletter_description;
        $appsetting->save();
        
        return redirect()->back()->with('success','App setting updated successfully.');
    }
}
