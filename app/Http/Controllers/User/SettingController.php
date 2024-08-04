<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\UserEmailVerify;
use App\UserMobileVerify;
use Event;
use App\Events\SendSmsEvent;
use App\User;
use Auth;
class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function AccountVerificationForm()
    {
        return view('user.account.verify');
    }
    public function AccountVerificationResendOtp(Request $request)
    {
        $this->validate($request,[
            'mobile' => 'required|numeric',
            'password' => 'required',
            'captcha' => 'required|captcha'
            ]);
        $user = User::where(['mobile'=>$request->mobile]);
        if ($user->count() && Hash::check($request->password, $user->first()->password)) {
            $user = $user->first();
            $userOtp = UserMobileVerify::firstOrNew(['user_id'=>$user->id]);
            $userOtp->user_id = $user->id;
            $userOtp->mobile = $user->mobile;
            $userOtp->confirmation_code = rand(1000000,9999999);
            $userOtp->status = 0;
            if($userOtp->save()){
                $message = $userOtp->confirmation_code.' is your icaps verification code.';
                Event::fire(new SendSmsEvent($user->mobile, $message));
                return response()->json(['status'=>'OK','message'=>'OTP sent successfully..']);
            }
            return response()->json(['status'=>'KO','message'=>'Whoops Look like something went wrong']);
        }
        return response()->json(['status'=>'KO','message'=>'Invalid email id or password']);
    }
    public function AccountVerificationPost(Request $request)
    {
        $this->validate($request,[
            'mobile' => 'required|numeric',
            'otp' => 'required|numeric',
            'captcha' => 'required|captcha'
            ]);
        $userVerify = UserMobileVerify::where(['mobile'=>$request->mobile,'confirmation_code'=>$request->otp]);
        if ($userVerify->count() && $userVerify->first()->user()) {
            $userVerify = $userVerify->first();
            $userVerify->status = 1;
            $userVerify->save();
            $userVerify->user->status = 1;
            $userVerify->user->mobile_verified = 1;
            if($userVerify->user->save()){
                Auth::guard('user')->login($userVerify->user);
                return response()->json(['status'=>'OK','message'=>'Account verification completed...']);
            }
            return response()->json(['status'=>'KO','message'=>'Whoops Look like something went wrong']);
        }
        return response()->json(['status'=>'KO','message'=>'data do not match. try again...']);
    }
    public function resendOtp(Request $request)
    {
        $id = $request->session()->has('id');
        if ($id) {
            $user = User::find(decrypt($request->session()->get('id')));
            $otp = rand(1000000,9999999);
            $data = UserMobileVerify::firstOrNew(['user_id'=>$user->id]);
            $data->id = $user->id;
            $data->mobile = $user->mobile;
            $data->confirmation_code = $otp;
            $data->status = 0;
            if($data->save()){
                $message = $otp.' is your icaps verification code.';
                Event::fire(new SendSmsEvent($user->mobile, $message));
            }            
            return redirect()->back()->with(['message'=>'OTP sent successfully..','class'=>'success']);
        }
        
    }
    public function EmailVerification($token)
    {
        $data = EmailVerification::where('token',$token)->first();
        if (!$data) {
            return redirect()->route('user.email.error.message')->with(['EmailVerified'=>2]);
        }
        
        else if ($data->user->email_verified == 1) {
            Auth::guard('user')->login($data->user);
            return redirect()->route('user.email.verification.message')->with(['EmailVerified'=>0]);
        }
        
        else{
            $data->user->status = 1;
            if($data->user->save()){
                Auth::guard('user')->login($data->user);
                return redirect()->route('user.email.verification.message')->with(['EmailVerified'=>1]);
            }            
            return redirect()->back()->with(['message'=>'Whoops Look like something went wrong.','class'=>'error']);
        }
    }
    public function CheckEmailVerification(){
        $email =  Auth::guard('user')->user()->EmailVerification;
        if(Session::has('EmailVerified')){
            $data['class'] = 'success'; 
            $data['message'] = 'Email verification success .';
        }
        else if ($email->status == 1) {
            $data['class'] = 'primary'; 
            $data['message'] = 'Email already verified .';
        }
        else{
            $data['class'] = 'danger'; 
            $data['message'] = 'Email not verified please verify your email.';
        }
        return view('user.extra.email_verification',compact('data'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
