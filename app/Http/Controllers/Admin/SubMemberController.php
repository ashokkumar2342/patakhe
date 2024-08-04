<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\SubMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return view('admin.member.submember.add',compact('user'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function formValidate($request)
    {
        $this->validate($request,[
            'member_id' => 'required|numeric',
            'first_name'=>'required|max:255',
            'last_name'=>'nullable|max:255',
            'email'=>'nullable|email|max:255',
            'mobile'=>'nullable|numeric',
            'aadhar_card_no'=>'nullable|numeric|digits:12',
            'date_of_birth'=>'nullable|date',
            'gender' => 'required|integer|digits_between:1,2',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,User  $user)
    {
        $this->formValidate($request);
        if($request->member_id == $user->member->id){
            $submember = new SubMember();
            $submember->member_id = $request->member_id;
            $submember->first_name = $request->first_name;
            $submember->last_name = $request->last_name;
            $submember->email = $request->email;
            $submember->mobile = $request->mobile;
            $submember->aadhar_card_no = $request->aadhar_card_no;
            $submember->dob = date('Y-m-d',strtotime($request->date_of_birth));
            $submember->gender = $request->gender;
            $submember->status = $request->status;
            if($submember->save()){
                $url = ($request->referer)?$request->referer:route('admin.member.list');
                return redirect($url)->with(['message'=>'Sub Member created successfully !','class'=>'success']);
            }
        }
        return redirect()->back()->with(['message'=>'Whoops, looks like something went wrong ! Try again ...','class'=>'error']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(SubMember $subMember)
    {
        return view('admin.member.submember.view',compact('subMember'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(SubMember $subMember)
    {
        return view('admin.member.submember.edit',compact('subMember'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubMember $subMember)
    {
        $this->formValidate($request);
        $subMember->first_name = $request->first_name;
        $subMember->last_name = $request->last_name;
        $subMember->mobile = $request->mobile;
        $subMember->email = $request->email;
        $subMember->mobile = $request->mobile;
        $subMember->aadhar_card_no = $request->aadhar_card_no;
        $subMember->dob = date('Y-m-d',strtotime($request->date_of_birth));
        $subMember->gender = $request->gender;
        $subMember->status = $request->status;
        if($subMember->save()){
            $url = ($request->referer)?$request->referer:route('admin.member.list');
            return redirect($url)->with(['message'=>'Sub Member update successfully !','class'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Whoops, looks like something went wrong ! Try again ...','class'=>'error']);
    }   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubMember $subMember)
    {
        if($subMember->delete()){
            return response()->json(['message'=>'Sub Member delete successfully ...','status'=>'OK']);
        }
        return response()->json(['message'=>'Whoops, looks like something went wrong ! Try again ...','status'=>'error']);
    }
}
