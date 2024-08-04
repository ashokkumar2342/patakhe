<?php

namespace App\Http\Controllers\Admin;

use App\MemberRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Event;
use App\Events\SendSmsEvent;
use App\User;
use App\Member;
use App\Model\User\UserAddress;
use Auth;
class MemberRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $members = MemberRequest::where(['status'=>0])->orderBy('id','desc')->get();
        return view('admin.member_request.list',compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {

        return view('admin.member_request.approvel',compact('user'));
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
     * @param  \App\MemberRequest  $memberRequest
     * @return \Illuminate\Http\Response
     */
    public function show(MemberRequest $memberRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MemberRequest  $memberRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(MemberRequest $memberRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MemberRequest  $memberRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  User $user)
    {
        $this->validate($request,[
            'first_name' => 'required|max:255',
            'last_name' => 'nullable|max:255',
            'member_type' => 'required|integer|digits_between:0,3',
            'gender' => 'required|integer|digits_between:1,2',
            'date_of_birth' => 'nullable|date',
            'street_address' =>'nullable|max:1000',
            'landmark' =>'nullable|max:1000',
            'address' =>'nullable|max:1000',
            'membership_card_no' => 'nullable|numeric|digits:16',
            'aadhar_card_no' => 'nullable|numeric|digits:12'
        ]);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->gender = $request->gender;
        $user->dob = ($request->date_of_birth)?date('Y-m-d',strtotime($request->date_of_birth)):null;
        $user->aadhar_card_no = $request->aadhar_card_no;
        $user->mobile_verified = 1;
        $user->email_verified = 1;
        $user->status = 1;
        $user->customer_id = rand(10000000,99999999);

        // find user address by address_id or create a new address
        $address = UserAddress::firstOrNew(['id'=>$user->address_id]);
        $address->user_id = $user->id;
        $address->address = $request->address;
        $address->street = $request->street_address;
        $address->landmark = $request->landmark;
        $address->save(); 

        // update user address id
        $user->address_id = $address->id;

        if ($user->save()) {

            //find member by user id or create new
            $member = Member::firstOrNew(['user_id'=>$user->id]);
            $member->user_id = $user->id;
            $member->membership_card_no = $request->membership_card_no;
            $member->member_type = $request->member_type;
            $member->save();   
                     
            $message = 'Thank you for ICAPS membership registration. '.$user->customer_id.' is your customer id.';
            Event::fire(new SendSmsEvent($user->mobile,$message));
            return redirect()->route('admin.member.lists')->with(['message'=>'Member approved successfully.','class'=>'success']);
         }
        return redirect()->back()->with(['message'=>'Whoops, looks like something went wrong ! Try again ...','class'=>'danger']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MemberRequest  $memberRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(MemberRequest $memberRequest)
    {
        //
        if(Auth::guard('admin')->user()->permission == 1){
            if($memberRequest->delete()){
              return response()->json(['message'=>'Request remove successfully.','status'=>'OK']);
            }
            return response()->json(['message'=>'Whoops, looks like something went wrong ! Try again ...','status'=>'error']);
        }
        else{
            return response()->json(['message'=>'You have not permission to access this.','status'=>'error']);
        }
    }
}
