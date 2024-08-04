<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
Use Auth;
use App\User;

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
        $user = Auth::guard('user')->user();
        return view('user.profile.info',compact('user'));
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function picture(Request $request)
    {
        //
        $this->validate($request,[
            'profile_pic' => 'required|image|mimes:jpeg,bmp,png,gif|between:5,1024'
        ]);
        $file = $request->file('profile_pic');
        $hashName = $file->hashName('profile');
        $image = Image::make($file)->fit(150)->encode('jpg');

        Storage::disk('user')->put($hashName,  $image);
        $user = Auth::guard('user')->user();        
        $user->profile_pic = $file->hashName();
        if ($user->save()) {
             return redirect()->back()->with(['message'=>'Your profile picture successfully changed...','class'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Whoops, looks like something went wrong ! Try again ...','class'=>'error']);

    }
    public function getPicture($image)
    {
        if(Storage::disk('user')->has('profile/'.$image)){
            return Storage::disk('user')->get('profile/'.$image);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        $user = Auth::guard('user')->user();
        return view('user.profile.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $this->validate($request,['first_name'=>'required','last_name'=>'nullable','date_of_birth'=>'required|date','gender'=>'required|numeric']);
        $user = Auth::guard('user')->user();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->dob = date('Y-m-d',strtotime($request->date_of_birth));
        $user->gender = $request->gender;
        if($user->save()){
            return redirect()->back()->with(['message'=>'Information update successfully','class'=>'success']);
        }
        return redirect()->back()->withInput()->with(['message'=>'Whoops, looks like something went wrong ! Try again ...','class'=>'danger']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
