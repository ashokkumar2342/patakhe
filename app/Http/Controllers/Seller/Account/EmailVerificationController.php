<?php

namespace App\Http\Controllers\Seller\Account;

use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\SellerEmailVerify;
use App\Mail\Seller\EmailVerificationMail;
use Auth;
use Mail;
class EmailVerificationController extends Controller
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
    public function EmailVerificationGet(SellerEmailVerify $request, $token)
    {
        //
        $data = SellerEmailVerify::where(['token'=>$token]);
        if ($data->count()) {
            $seller = Seller::find($data->first()->id);
            if ($seller->email_verified ==1) {
                return redirect()->route('seller.login.form')->with(['message'=>'Email has already verified ..','class'=>'succcess']);
            }
            $seller->email_verified =1;
            $seller->save();
            Auth::guard('seller')->login($seller);
            SellerEmailVerify::destroy($data->first()->id);
            return redirect()->route('seller.dashboard')->with(['message'=>'Email has been verified ..','class'=>'succcess']);
        }
        return redirect()->route('seller.login.form')->with(['message'=>'Token not found '." <a href='".route('seller.email.verification.form')."'> Click Here </a> to send again.",'class'=>'error']);
    }
    public function EmailVerificationPost(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:256',
            'password' => 'required'
        ]);
        $seller = Seller::where(['email'=>$request->email]);
        if ($seller->count()) {
            if (Hash::check($request->password, $seller->first()->password)) {
                if ($seller->first()->email_verified == 1) {
                    return redirect()->route('seller.login.form')->with(['message'=>'Email has already verified ..','class'=>'success']);
                }
                $seller = $seller->first();
                sellerEmailVerify::where(['id'=>$seller->id])->delete();
                $data = new sellerEmailVerify();
                $data->id = $seller->id;
                $data->email = $seller->email;
                $data->token = str_random(150);
                $data->status = 0;
                $data->save();
                Mail::to($seller->email)->send(new EmailVerificationMail($data,$seller));
                return redirect()->route('seller.login.form')->with(['message'=>'Verification link has been successfully sent ! please verify your email id ..','class'=>'success']);
            }
            return redirect()->back()->withInput()->with(['message'=>'Invalid email id or  password','class'=>'error']);
        }
        return redirect()->back()->withInput()->with(['message'=>'Invalid email id or  password','class'=>'error']);
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
     * @param  \App\seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function edit(Seller $seller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seller $seller)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller)
    {
        //
    }
}
