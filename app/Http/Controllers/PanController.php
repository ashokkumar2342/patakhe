<?php

namespace App\Http\Controllers;

use App\Pan;
use Illuminate\Http\Request;
use Auth;
class PanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::guard('user')->check()) {
            # code...
            return redirect()->route('user.login.form')->with(['message'=>'Please Login To continue','class'=>'error']);
        }
        return view('front.assistance.PanCard');
        
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
          $Pan = Pan::create([
            'user_id' => Auth::guard('user')->user()->id
            ]);
        if($Pan){
            return redirect()->route('front.home')->with(['message'=>'Request sent successfully. Our excutive will contact you soon ...','class'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Whoops Look like something went wrong.','class'=>'error']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\pan  $pan
     * @return \Illuminate\Http\Response
     */
    public function show(pan $pan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\pan  $pan
     * @return \Illuminate\Http\Response
     */
    public function edit(pan $pan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\pan  $pan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pan $pan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\pan  $pan
     * @return \Illuminate\Http\Response
     */
    public function destroy(pan $pan)
    {
        //
    }
}
