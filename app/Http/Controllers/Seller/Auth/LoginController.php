<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Seller;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public $redirectTo ;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('seller.guest', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        return view('seller.auth.login');
    }
   
    // Logout method with guard logout for seller only
    public function logout()
    {
        $this->guard()->logout();
        return redirect()->route('seller.login.form');
    }

    public function login(Request $request)
    {
        $this->redirectTo = ($request->referrer)? $request->referrer : route('seller.dashboard');
        $this->validateLogin($request);
        $field  = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
        $auth = $this->guard()->attempt([$field => $request->username, 'password' => $request->password],$request->has('remember'));
        if ($auth) {
            if ($field == 'email') {
                if(!Auth::guard('seller')->user()->email_verified == 1){
                    $request->session()->put('email','2');
                }
            }
            elseif ($field == 'mobile') {
                if(!Auth::guard('seller')->user()->mobile_verified == 1){
                    $request->session()->put('mobile','2');
                }
            }
            $this->redirectTo = ($request->referrer)? $request->referrer : route('seller.dashboard');
            return $this->sendLoginResponse($request);
        }
        return $this->sendFailedLoginResponse($request);
    }

    public function username()
    {
        return 'username';
    }

    protected function guard()
    {
        return Auth::guard('seller');
    }
}
