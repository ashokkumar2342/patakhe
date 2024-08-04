<?php

namespace App\Http\Middleware\user;

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
        if (Auth::guard('user')->check()) {
           if (!Auth::guard('user')->user()->email_verified == 1 && $request->session()->has('email')) {
                Auth::guard('user')->logout();
                $request->session()->forget('email');
                return redirect()->route('user.login.form')->with(['class'=>'error','message'=>'Your email is not verified yet !'." <a href='".route('user.email.verification.form')."' style='color:#0f0;'> Click Here </a> to send verification link." ]);
            }
        }
        return $next($request);
    }
}
