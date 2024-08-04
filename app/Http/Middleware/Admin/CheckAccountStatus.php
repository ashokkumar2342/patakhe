<?php

namespace App\Http\Middleware\Admin;

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
        if (!Auth::guard('admin')->user()->status) {

            Auth::guard('admin')->logout();

            return redirect()->route('admin.login.form')->with(['class'=>'danger','message'=>'Your account is not active yet, Please verify your account!']);
        }
        return $next($request);
    }
}
