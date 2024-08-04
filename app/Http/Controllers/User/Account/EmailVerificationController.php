<?php

namespace App\Http\Controllers\User\Account;

use App\UserEmailVerify;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Mail\User\EmailVerificationMail;
use Auth;
use Mail;
use App\User;
class EmailVerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function PostMail(Request $request)
    {
        //
        $this->validate($request, [
            'email' => 'required|email|max:256',
            'password' => 'required'
        ]);
        $user = User::where(['email'=>$request->email])->first();
        if ($user && Hash::check($request->password, $user->password)) {
            if ($user->email_verified == 1) {

                return redirect()->route('user.login.form')->with(['message'=>'Email has already verified ..','class'=>'success']);
            }
            $data = UserEmailVerify::firstOrNew(['user_id'=>$user->id]);
            $data->user_id = $user->id;
            $data->email = $user->email;
            $data->token = str_random(150);
            $data->status = 0;
            $data->save();
            Mail::to($user->email)->send(new EmailVerificationMail($data));
            return redirect()->route('user.login.form')->with(['message'=>'Verification link has been successfully sent ! please verify your email id ..','class'=>'success']);
        }
        return redirect()->back()->withInput()->with(['message'=>'Invalid email id or  password','class'=>'error']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getToken($token)
    {
        //
          $data = UserEmailVerify::where(['token'=>$token])->first();
        if ($data && $data->user) {
            if ($data->user->email_verified ==1) {
                return redirect()->route('user.login.form')->with(['message'=>'Email has already verified ..','class'=>'succcess']);
            }
            $data->user->email_verified =1;
            $data->user->save();
            Auth::guard('user')->login($data->user);
            return redirect()->route('front.home')->with(['message'=>'Email has been verified ..','class'=>'succcess']);
        }
        return redirect()->route('user.login.form')->with(['message'=>'Token not found '." <a href='".route('user.email.verification.form')."'> Click Here </a> to send again.",'class'=>'error']);
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
     * @param  \App\UserEmailVerify  $userEmailVerify
     * @return \Illuminate\Http\Response
     */
    public function show(UserEmailVerify $userEmailVerify)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserEmailVerify  $userEmailVerify
     * @return \Illuminate\Http\Response
     */
    public function edit(UserEmailVerify $userEmailVerify)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserEmailVerify  $userEmailVerify
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserEmailVerify $userEmailVerify)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserEmailVerify  $userEmailVerify
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserEmailVerify $userEmailVerify)
    {
        //
    }
}
