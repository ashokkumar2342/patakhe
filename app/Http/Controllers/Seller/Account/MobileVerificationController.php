<?php

namespace App\Http\Controllers\Seller\Account;

use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\SellerMobileVerify;
use Auth;
use Mail;

class MobileVerificationController extends Controller
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
     public function MobileVerificationPost(Request $request)
    {
        $this->validate($request, [
            'mobile' => 'required|numeric|min:10',
            'password' => 'required|min:6'
        ]);
        $seller = Seller::where(['mobile'=>$request->mobile])->get();
        if ($seller->count()) {
            if (Hash::check($request->password, $seller->first()->password)) {
                if ($seller->first()->mobile_verified == 1) {
                    return redirect()->route('seller.login.form')->with(['message'=>'Mobile has already verified ..','class'=>'success']);
                }
                $seller = $seller->first();
                SellerMobileVerify::destroy($seller->id);
                $data = new SellerMobileVerify();
                $data->id = $seller->id;
                $data->mobile = $seller->mobile;
                $data->confirmation_code = rand(1000000,9999999);
                $data->status = 0;
                $data->save();
                Mail::to($seller->email)->send(new MobileVerificationMail($data, $seller));
                $data['confirmation_code'] = '';
                $request->session()->put('OtpId',$seller->id);
                return redirect()->route('seller.mobile.verification.otp.form');
            }
            return redirect()->back()->withInput()->with(['message'=>'Invalid Mobile or Password','class'=>'error']);
        }
        return redirect()->back()->withInput()->with(['message'=>'Invalid Mobile or Password','class'=>'error']);
    }
    public function MobileVerificationOTP(Request $request)
    {
        $this->validate($request,[
            'otp' => 'required|numeric|digits:7',
        ]);
        if ($request->session()->has('OtpId')) {
            $id = $request->session()->get('OtpId');
            $OtpVerify = SellerMobileVerify::where(['id'=>$id,'confirmation_code'=>$request->otp])->get();
            if($OtpVerify->count()){
                $seller = Seller::find($id);
                $seller->mobile_verified = 1;
                $seller->save();
                $SellerMobileVerify = SellerMobileVerify::find($id);
                $SellerMobileVerify->status = 1;
                $SellerMobileVerify->save();
                $request->session()->forget('OtpId');
                return redirect()->route('seller.login.form')->with(['message'=>'Your mobile has verified','class'=>'success']);
            }
            return redirect()->back()->withErrors(['otp'=>'Otp do not match']);
        }
        return redirect()->route('seller.mobile.verification.form')->with(['message'=>'Request Not Found','class'=>'error']);
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
