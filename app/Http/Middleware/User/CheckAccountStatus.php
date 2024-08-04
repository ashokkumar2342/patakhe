<?php

namespace App\Http\Middleware\User;
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
        if (Auth::guard('user')->check()) {
           if (!Auth::guard('user')->user()->status) {
                Auth::guard('user')->logout();
                return redirect()->route('user.account.verify.form')->with(['class'=>'error','message'=>'Your account is not active yet, Please verify your account by mobile!']);
            }
        }
        
        return $next($request);
    }
}
