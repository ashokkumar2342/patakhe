<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Events\SendSmsEvent;
use Event;
use App\User;
use App\UserPasswordResetByMobile;
use Auth;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('user.guest');
    }
    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return view('user.auth.passwords.forgetPassword');
    }
    public function GetOtp(Request $request){
        $this->validate($request,[
            'mobile' => 'required|numeric',
            'captcha' => 'required|captcha'
            ]);
        $user = User::where('mobile',$request->mobile)->first();
        if ($user ) {
            $currDate = date('Y-m-d H:i:s',strtotime("-5 minutes"));            
            $userOtpFind = UserPasswordResetByMobile::where(['user_id'=>$user->id,'status'=>0,'mobile'=>$request->mobile])->where('created_at', '>', $currDate);    
                
            if($userOtpFind->count() ){
                $message = $userOtpFind->first()->otp.' is your one time password (otp). valid for 5 min.';
                Event::fire(new SendSmsEvent($user->mobile,$message));
                return response()->json(['status'=>'OK', 'message'=>'Otp has already sent to your registered mobile no.']);
            }
            
            UserPasswordResetByMobile::create(['user_id'=>$user->id,'mobile'=>$user->mobile,'otp'=>$otp = rand(1000000,9999999)]);
                $message = $otp.' is your one time password (otp). valid for 5 min.';
                Event::fire(new SendSmsEvent($user->mobile,$message));
            return response()->json(['status'=>'OK', 'message'=>'Otp sent to your registered mobile no.']);
        }
       return response()->json(['status'=>'NotValid','message'=>'Mobile no. is not find in our database']);
    }
    public function MatchOTP(Request $request){
        $this->validate($request,[
            'mobile' => 'required|numeric',
            'otp' => 'required'
        ]);
        if ($user = User::where('mobile',$request->mobile)->first()) {
            $currDate = date('Y-m-d H:i:s',strtotime("-5 minutes"));
            $userOtp = UserPasswordResetByMobile::where(['user_id'=>$user->id,'mobile'=>$request->mobile,'otp'=>$request->otp,'status'=>0])->where('created_at', '>', $currDate);
            if ($userOtp->count() ) {
                return response()->json(['status'=>'OK','message'=>'Now you can reset your password']);
            }
           return response()->json(['status'=>'NotValid','message'=>'Data do not match ']);
        }
    }
    public function changePassword(Request $request){
        $this->validate($request,[
            'password' => 'required|confirmed',
        ]);
        $currDate = date('Y-m-d H:i:s',strtotime("-5 minutes"));
        if ($user = User::where('mobile',$request->mobile)->first()) {
             $userOtp = UserPasswordResetByMobile::where(['user_id'=>$user->id,'mobile'=>$request->mobile,'otp'=>$request->otp,'status'=>0])->where('created_at', '>', $currDate);
            if ($userOtp->count()) {
                $user->password = bcrypt($request->password);
                $user->save();
                $userOtp = $userOtp->first();
                $userOtp->status = 1;
                $userOtp->save();
                Auth::guard('user')->login($user);
                return response()->json(['status'=>'OK','message'=>'Password successfuly changed .']);
            }
            return response()->json(['status'=>'OK','message'=>'Time up ! please try again ...']);
        }
        return response()->json(['status'=>'OK','message'=>'Time up ! Please try again ...']);
    }
    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );
        return response()->json(['status'=>'OK','message'=>'Reset link send to your email.']);
        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($response)
                    : $this->sendResetLinkFailedResponse($request, $response);
    }
    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('users');
    }
}
