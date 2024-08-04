<?php

namespace App\Http\Controllers\Vendor\Account;

use App\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\VendorMobileVerify;
use App\Mail\Vendor\MobileVerificationMail;
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
        $vendor = Vendor::where(['mobile'=>$request->mobile])->get();
        if ($vendor->count()) {
            if (Hash::check($request->password, $vendor->first()->password)) {
                if ($vendor->first()->mobile_verified == 1) {
                    return redirect()->route('vendor.login.form')->with(['message'=>'Mobile has already verified ..','class'=>'success']);
                }
                $vendor = $vendor->first();
                VendorMobileVerify::destroy($vendor->id);
                $data = new VendorMobileVerify();
                $data->id = $vendor->id;
                $data->mobile = $vendor->mobile;
                $data->confirmation_code = rand(1000000,9999999);
                $data->status = 0;
                $data->save();
                Mail::to($vendor->email)->send(new MobileVerificationMail($data, $vendor));
                $data['confirmation_code'] = '';
                $request->session()->put('OtpId',$vendor->id);
                return redirect()->route('vendor.mobile.verification.otp.form');
            }
            return redirect()->back()->withInput()->with(['message'=>'Invalid Mobile or Password','class'=>'danger']);
        }
        return redirect()->back()->withInput()->with(['message'=>'Invalid Mobile or Password','class'=>'danger']);
    }
    public function MobileVerificationOTP(Request $request)
    {
        $this->validate($request,[
            'otp' => 'required|numeric|digits:7',
        ]);
        if ($request->session()->has('OtpId')) {
            $id = $request->session()->get('OtpId');
            $OtpVerify = VendorMobileVerify::where(['id'=>$id,'confirmation_code'=>$request->otp])->get();
            if($OtpVerify->count()){
                $vendor = Vendor::find($id);
                $vendor->mobile_verified = 1;
                $vendor->save();
                $vendorMobileVerify = VendorMobileVerify::find($id);
                $vendorMobileVerify->status = 1;
                $vendorMobileVerify->save();
                $request->session()->forget('OtpId');
                return redirect()->route('vendor.login.form')->with(['message'=>'Your mobile has verified','class'=>'success']);
            }
            return redirect()->back()->withErrors(['otp'=>'Otp do not match']);
        }
        return redirect()->route('vendor.mobile.verification.form')->with(['message'=>'Request Not Found','class'=>'danger']);
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
