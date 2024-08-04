<?php

namespace App\Http\Middleware\Seller;

use Closure;
use Auth;
class CheckMobileVerification
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
        if (Auth::guard('seller')->check()) {
           if (!Auth::guard('seller')->user()->mobile_verified == 1 && $request->session()->has('mobile')) {
                Auth::guard('seller')->logout();
                $request->session()->forget('mobile');
                return redirect()->route('seller.login.form')->with(['class'=>'error','message'=>'Your mobile is not verified yet ! '." <a href='".route('seller.mobile.verification.form')."' style='color:#0f0'>Click Here</a> to verify."]);
            }
        }
        return $next($request);
    }
}
