<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\validate;
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
        $this->middleware('user.guest', ['except' => 'logout']);
    }
   
    public function showLoginForm()
    {
        return view('user.auth.login');
    }
    
    public function logout(Request $request)
    {
        $this->guard()->logout();
        return redirect()->route('user.login.form');
    }
    public function otp(Request $request)
    {
        $this->validate($request,[
            'mobile' => 'required|min:10|numeric',
    
        ]);
        $user =User::where('mobile',$request->mobile)->first();
        if (isset($user)) {
             Auth::guard('user')->login($user);
         // return    Auth::loginUsingId(1);
            return $this->sendLoginResponse($request);
        }else{
            $otp = mt_rand(100000, 999999);
            $user =User::firstOrNew(['mobile'=>$request->mobile]);
            $user->mobile =$request->mobile;
            $user->otp =$otp;
            $user->status =0;
            $user->save();
            return view('user.auth.otp');
        }
        return redirect()->back()->with(['message'=>'Mobile Number Invalid','class'=>'error']);
       // return $request->all();
    }
    public function login(Request $request){
        $this->redirectTo = ($request->referrer)? $request->referrer : route('front.home');
        $this->validateLogin($request);
        if(filter_var($request->username, FILTER_VALIDATE_EMAIL)){
            $field = 'email';
            $auth = $this->guard()->attempt([$field => $request->username, 'password' => $request->password],$request->has('remember'));
            if ($auth) {
                if ($field == 'email') {
                    if(!Auth::guard('user')->user()->email_verified){
                        $request->session()->put('email','2');
                    }
                }

                return $this->sendLoginResponse($request);
            }
            return $this->sendFailedLoginResponse($request);
        }
        else{
            $field  = (strlen($request->username)==8)?'customer_id':'mobile';
            $auth = $this->guard()->attempt([$field => $request->username, 'password' => $request->password],$request->has('remember'));
            if ($auth) {
                if ($field == 'email') {
                    if(!Auth::guard('user')->user()->email_verified){
                        $request->session()->put('email','2');
                    }
                }
                return $this->sendLoginResponse($request);
            }
            return $this->sendFailedLoginResponse($request);
        }
        
    }
    
    public function username()
    {
        return 'username';
    }
    protected function guard()
    {
        return Auth::guard('user');
    }

}
