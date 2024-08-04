<?php

namespace App\Http\Controllers;

use App\UtilityBillPayment;
use Illuminate\Http\Request;
use Auth;
class UtilityBillPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (!Auth::guard('user')->check()) {
            # code...
            return redirect()->route('user.login.form')->with(['message'=>'Please Login To continue','class'=>'error']);
        }
        return view('front.services.UtilityBillPayment');
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
        $UtilityBillPayment = UtilityBillPayment::create([
            'user_id' => Auth::guard('user')->user()->id
            ]);
        if($UtilityBillPayment){
            return redirect()->route('front.home')->with(['message'=>'Request sent successfully. Our excutive will contact you soon ...','class'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Whoops Look like something went wrong.','class'=>'error']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UtilityBillPayment  $utilityBillPayment
     * @return \Illuminate\Http\Response
     */
    public function show(UtilityBillPayment $utilityBillPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UtilityBillPayment  $utilityBillPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(UtilityBillPayment $utilityBillPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UtilityBillPayment  $utilityBillPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UtilityBillPayment $utilityBillPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UtilityBillPayment  $utilityBillPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(UtilityBillPayment $utilityBillPayment)
    {
        //
    }
}
