<?php

namespace App\Http\Middleware\Seller;

use Closure;
use Auth;
class RedirectIfNotAuthenticated
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
        if (!Auth::guard('seller')->check()) {
            return redirect()->route('seller.login.form','referrer='.url()->current());
        }
        return $next($request);
    }
}
