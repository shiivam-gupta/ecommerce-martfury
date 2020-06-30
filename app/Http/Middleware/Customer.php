<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Customer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!\Auth::check()){
            return redirect(route('account.login'));
        }
        if(!$request->user()->hasRole('Customer')){
            \Auth::logout();
            return redirect(route('account.login'));
        }
        return $next($request);
    }
}
