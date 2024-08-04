<?php

namespace App\Http\Controllers;

use App\Educational;
use Illuminate\Http\Request;
use Auth;
class EducationalController extends Controller
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
        return view('front.consultancy.educational',compact('educational'));
        
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
        $this->validate($request,[
            'apply_for' => 'required|max:191',
            'message' => 'required|max:1000'
        ]);
        $Educational = Educational::create([
            'user_id' => Auth::guard('user')->user()->id,
            'apply_for' => $request->apply_for,
            'message' => $request->message,
        ]);
        if($Educational){
            return redirect()->route('front.home')->with(['message'=>'Request sent successfully. Our excutive will contact you soon ...','class'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Whoops Look like something went wrong.','class'=>'error']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Educational  $educational
     * @return \Illuminate\Http\Response
     */
    public function show(Educational $educational)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Educational  $educational
     * @return \Illuminate\Http\Response
     */
    public function edit(Educational $educational)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Educational  $educational
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Educational $educational)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Educational  $educational
     * @return \Illuminate\Http\Response
     */
    public function destroy(Educational $educational)
    {
        //
    }
}
