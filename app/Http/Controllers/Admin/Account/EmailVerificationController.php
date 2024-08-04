<?php

namespace App\Http\Controllers\Vendor\Account;

use App\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\VendorEmailVerify;
use App\Mail\Vendor\EmailVerificationMail;
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
    public function EmailVerificationGet(VendorEmailVerify $request, $token)
    {
        //
        $data = VendorEmailVerify::where(['token'=>$token]);
        if ($data->count()) {
            $vendor = Vendor::find($data->first()->id);
            if ($vendor->email_verified ==1) {
                return redirect()->route('vendor.login.form')->with(['message'=>'Email has already verified ..','class'=>'succcess']);
            }
            $vendor->email_verified =1;
            $vendor->save();
            Auth::guard('vendor')->login($vendor);
            VendorEmailVerify::destroy($data->first()->id);
            return redirect()->route('vendor.dashboard')->with(['message'=>'Email has been verified ..','class'=>'succcess']);
        }
        return redirect()->route('vendor.login.form')->with(['message'=>'Token not found '." <a href='".route('vendor.email.verification.form')."'> Click Here </a> to send again.",'class'=>'danger']);
    }
    public function EmailVerificationPost(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:256',
            'password' => 'required'
        ]);
        $vendor = Vendor::where(['email'=>$request->email]);
        if ($vendor->count()) {
            if (Hash::check($request->password, $vendor->first()->password)) {
                if ($vendor->first()->email_verified == 1) {
                    return redirect()->route('vendor.login.form')->with(['message'=>'Email has already verified ..','class'=>'success']);
                }
                $vendor = $vendor->first();
                VendorEmailVerify::where(['id'=>$vendor->id])->delete();
                $data = new VendorEmailVerify();
                $data->id = $vendor->id;
                $data->email = $vendor->email;
                $data->token = str_random(150);
                $data->status = 0;
                $data->save();
                Mail::to($vendor->email)->send(new EmailVerificationMail($data,$vendor));
                return redirect()->route('vendor.login.form')->with(['message'=>'Verification link has been successfully sent ! please verify your email id ..','class'=>'success']);
            }
            return redirect()->back()->withInput()->with(['message'=>'Invalid email id or  password','class'=>'danger']);
        }
        return redirect()->back()->withInput()->with(['message'=>'Invalid email id or  password','class'=>'danger']);
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
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
}
