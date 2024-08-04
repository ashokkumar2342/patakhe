<?php

namespace App\Http\Middleware\Seller;

use Closure;
use Auth;
class CheckEmailVerification
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
           if (!Auth::guard('seller')->user()->email_verified == 1 && $request->session()->has('email')) {
                Auth::guard('seller')->logout();
                $request->session()->forget('email');
                return redirect()->route('seller.login.form')->with(['class'=>'error','message'=>'Your email is not verified yet, ' ." <a href='".route('seller.email.verification.form')."' class='text-muted'> Click Here </a> to send verification link."]);
            }
        }
        return $next($request);
    }
}
