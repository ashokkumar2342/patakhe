<?php

namespace App\Http\Controllers;

use App\TaxiBooking;
use Illuminate\Http\Request;
use Auth;
class TaxiBookingController extends Controller
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
        return view('front.services.TaxiBooking');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($data)
    {
       
        return TaxiBooking::updateOrCreate([
            'user_id' =>    @Auth::guard('user')->user()->id,
            'status' => 0
        ]);
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
        
        if($this->create($request)){
            return redirect()->route('front.home')->with(['message'=>'Request Sent ! Our excutive will contact you soon ...','class'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Whoops, looks like something went wrong ! Try again ...','class'=>'error']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TaxiBooking  $taxiBooking
     * @return \Illuminate\Http\Response
     */
    public function show(TaxiBooking $taxiBooking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TaxiBooking  $taxiBooking
     * @return \Illuminate\Http\Response
     */
    public function edit(TaxiBooking $taxiBooking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaxiBooking  $taxiBooking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaxiBooking $taxiBooking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TaxiBooking  $taxiBooking
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaxiBooking $taxiBooking)
    {
        //
    }
}
