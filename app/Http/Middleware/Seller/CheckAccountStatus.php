<?php

namespace App\Http\Middleware\Seller;

use Closure;
use Auth;
class CheckAccountStatus
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
        if (!Auth::guard('seller')->user()->status == 1) {

            Auth::guard('seller')->logout();

            return redirect()->route('seller.login.form')->with(['class'=>'error','message'=>'Your account is not active yet !']);
        }
        return $next($request);
    }
}
