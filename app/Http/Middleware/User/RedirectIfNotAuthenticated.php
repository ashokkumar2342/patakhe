<?php

namespace App\Http\Middleware\User;

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
        if (!Auth::guard('user')->check()) {
            return redirect()->route('user.login.form','referrer='.url()->current())->with(['message'=>'Please Login To continue','class'=>'error']);
        }
        return $next($request);
    }
}
