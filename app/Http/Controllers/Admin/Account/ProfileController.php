<?php

namespace App\Http\Controllers\Admin\Account;

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
     * @param  \App\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\admin  $admin
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

        Storage::disk('admin')->put($hashName,  $image);
        $admin = Auth::guard('admin')->user();
        if($admin->profile_pc){
            Storage::disk('admin')->delete('profile/'.$admin->profile_pic);
        }
        
        $admin->profile_pic = $file->hashName();
        if ($admin->save()) {
             return redirect()->route('admin.account.profile.information.view')->with(['message'=>'Your profile picture successfully changed...','class'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Whoops, looks like something went wrong ! Try again ...','class'=>'danger']);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function infoUpdate(Request $request)
    {
        //
        $this->validate($request,[
            'first_name' => 'required|max:255',
            'dob' => 'required|date'
        ]);
        $admin = Auth::guard('admin')->user();
        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->dob = $request->dob;
        if($admin->save()){
             return redirect()->back()->with(['message'=>'Profile information updated successfully...','class'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Whoops, looks like something went wrong ! Try again ...','class'=>'danger']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(admin $admin)
    {
        //
    }
}
