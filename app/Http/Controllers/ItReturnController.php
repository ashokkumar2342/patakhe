<?php

namespace App\Http\Controllers;

use App\ItReturn;
use Illuminate\Http\Request;
use Auth;   
class ItReturnController extends Controller
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
        return view('front.services.ItReturn');
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
        $itreturn = ItReturn::create([
            'user_id' => Auth::guard('user')->user()->id
            ]);
        if($itreturn){
            return redirect()->route('front.home')->with(['message'=>'Request sent successfully. Our excutive will contact you soon ...','class'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Whoops Look like something went wrong.','class'=>'error']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ItReturn  $itReturn
     * @return \Illuminate\Http\Response
     */
    public function show(ItReturn $itReturn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItReturn  $itReturn
     * @return \Illuminate\Http\Response
     */
    public function edit(ItReturn $itReturn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItReturn  $itReturn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItReturn $itReturn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItReturn  $itReturn
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItReturn $itReturn)
    {
        //
    }
}
