<?php

namespace App\Http\Controllers\Seller\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
class ProfileController extends Controller
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
    public function pictureUpdate(Request $request)
    {
        $this->validate($request,[
            'file' => 'required|image|mimes:jpeg,bmp,png,gif|between:10,1024'
        ]);
        $file = $request->file('file');
        $hashName = $file->hashName('profile');
        $image = Image::make($file)->fit(150)->encode('jpg');

        Storage::disk('seller')->put($hashName,  $image);
        $seller = Auth::guard('seller')->user();
        if($seller->profile_pc){
            Storage::disk('seller')->delete('profile/'.$seller->profile_pic);
        }
        
        $seller->profile_pic = $file->hashName();
        if ($seller->save()) {
             return redirect()->route('seller.account.profile.information.view')->with(['message'=>'Your profile picture successfully changed...','class'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Whoops, looks like something went wrong ! Try again ...','class'=>'error']);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function infoUpdate(Request $request)
    {
        //
        $this->validate($request,[
            'first_name' => 'required|max:255',
            'dob' => 'required|date'
        ]);
        $seller = Auth::guard('seller')->user();
        $seller->first_name = $request->first_name;
        $seller->last_name = $request->last_name;
        $seller->dob = $request->dob;
        if($seller->save()){
             return redirect()->back()->with(['message'=>'Profile information updated successfully...','class'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Whoops, looks like something went wrong ! Try again ...','class'=>'error']);
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
