<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // if (Auth::guard($guard)->check()) {
        //     return redirect(RouteServiceProvider::HOME);
        // }

        if(\Auth::check()){
            if($request->user()->hasRole('Admin')){
                return redirect(route('admin.dashboard'));
            }

            // if($request->user()->hasRole('Customer')){
            //     return redirect(route('customer.dashboard'));
            // }
        }

        return $next($request);
    }
}
