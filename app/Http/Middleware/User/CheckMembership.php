<?php

namespace App\Http\Middleware\User;

use Closure;
use Auth;
class CheckMembership
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
           if (!Auth::guard('user')->user()->member) {
                return redirect()->route('front.home')->with([
                    'class'=>'error',
                    'message'=> "Currently you are not of icaps member. Merbership request <form style='margin-right:200px'  action='".route('user.member.request.post')."' method='post' class='pull-right'><input type='hidden' name='_token' value='".csrf_token()."'> <button class='btn btn-link btn-xs' type='submit'><span style='color:#0f0'>Click Here</span></button></form>"
                  
                ]);
            }
        }
        return $next($request);
    }
}