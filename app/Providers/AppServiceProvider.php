<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Appsetting;
use App\Models\WishlistModels;
use App\Models\Category;
use App\Models\Brand;
use View;
use Auth;
use App\Models\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $appsetting = Appsetting::first();

        view()->composer('*', function ($view) 
        {
            $wishCount = WishlistModels::where('user_id',Auth::id())->count();
            View::share('wishCount', $wishCount);
        });

        $pageinfo = Product::where('slug', \Request::segment(2))->first();

        $getAllCat = Category::where('status',1)->get();
        $brandlists = Brand::where('status','active')->get();
        View::share('appsetting', $appsetting);
        View::share('getAllCat', $getAllCat);
        View::share('brandlists', $brandlists);
        View::share('pageinfo', $pageinfo);
    }
}
