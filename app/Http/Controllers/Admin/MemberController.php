<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\SendSmsEvent;
use Event;
use App\User;
use App\Model\User\UserAddress;
use App\Member;
use Auth;
class MemberController extends Controller
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
    public function lists()
    {
        //
        $members = Member::latest()->get();
        return view('admin.member.list',compact('members'));
    }

    //user activation 
    public function status(User $user){
        $data = ($user->status == 1)?['status' => 0, 'addClass' => 'btn-danger', 'removeClass' => 'btn-success','message'=>'User deactivated ...', 'text' => 'Inactive', ]:['status' => 1, 'addClass' => 'btn-success', 'removeClass' => 'btn-danger', 'message'=>'User activated ...', 'text' => 'Active', ]; 
        $user->status = $data['status'];
        if($user->save()){
            return response()->json(['status'=>'OK','message'=>$data['message'],'btn'=>['addClass'=>$data['addClass'],'removeClass'=>$data['removeClass'],'text'=>$data['text']]]);
        }
        else{
            return response()->json(['status'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function request(User $user)
    {
        //
        return view('admin.member.edit',compact('user'));
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
        $this->validate($request,[
            'first_name' => 'required|max:255',
            'member_type' => 'required|integer|digits_between:1,3',
            'gender' => 'required|integer|digits_between:1,2',
            'date_of_birth' => 'nullable|date',
            'email' => 'sometimes|nullable|email|max:255|unique:users',
            'mobile' =>'required|numeric|unique:users',
            'address' =>'nullable|max:1000',
            'membership_card_no' => 'nullable|numeric|digits:16',
            'aadhar_card_no' => 'nullable|numeric|digits:12'
        ]);
        $password = $this->random_password(6);
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($password);
        $user->mobile = $request->mobile;
        $user->gender = $request->gender;
        $user->dob = ($request->date_of_birth)?date('Y-m-d',strtotime($request->date_of_birth)):null;
        $user->member_type = $request->member_type;       
        $user->membership_card_no = $request->membership_card_no;
        $user->aadhar_card_no = $request->aadhar_card_no;
        $user->referred_by = $request->referred_by;
        $user->member_status = 1;
        $user->mobile_verified = 1;
        $user->email_verified = 1;
        $user->customer_id = rand(10000000,99999999);
        $user->status = 1;
        if ($user->save()) {
           $member  = new Member();
           $member->user_id = $user->id;
           $member->member_type = $user->member_type;
           $member->membership_card_no = $request->membership_card_no;
           $member->status = 1;
           $member->save();
           if($request->address){
            $address = new UserAddress();
            $address->user_id = $user->id;
            $address->address = $request->address;
            $address->street = $request->street_address;
            $address->landmark = $request->landmark;
            $address->save();
            $user->address_id = $address->id;
            $user->save();
           }
           $message = 'Thank you for ICAPS membership registration. Your customer id is '.$user->customer_id.' and your password is '.$password.' For order & enquiry Please contact on these No : 9996786071, 9996786072, 9996786073, 9996786074, 9996786075 or visit www.icaps.co.in';
           Event::fire(new SendSmsEvent($user->mobile,$message));
           return redirect()->route('admin.member.lists')->with(['message'=>'Member registration successfully.','class'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Whoops, looks like something went wrong ! Try again ...','class'=>'error']);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.member.view',compact('user'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.member.edit',compact('user'));
    }

    // New Membership Registration Form
    public function newMember()
    {
        return view('admin.member.new');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $this->validate($request,[
            'first_name' => 'required|max:199',
            'member_type' => 'required|integer|digits_between:1,3',
            'gender' => 'required|integer|digits_between:1,2',
            'date_of_birth' => 'nullable|date',
            'address' =>'nullable|max:1000',
            'membership_card_no' => 'nullable|numeric|digits:16',
            'aadhar_card_no' => 'nullable|numeric|digits:12'
        ]);
        if( $user->mobile != $request->mobile){
            $this->validate($request,[
                'mobile' => 'required|numeric|unique:users',
            ]);
            $user->mobile = $request->mobile;
        }
        if( $user->email != $request->email){
            $this->validate($request,[
                'email' => 'required|email|max:199|unique:users',
            ]);
            $user->email = $request->email;
        }
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->gender = $request->gender;
        $user->dob = ($request->date_of_birth)?date('Y-m-d',strtotime($request->date_of_birth)):null;
        $user->aadhar_card_no = $request->aadhar_card_no;
        $address = UserAddress::firstOrNew(['id'=>$user->address_id]);
        $address->user_id = $user->id;
        $address->address = $request->address;
        $address->street = $request->street_address;
        $address->landmark = $request->landmark;
        $address->save(); 
       

        $user->address_id = $address->id;
        if ($user->save()) {
           
        
            $member = Member::firstOrNew(['user_id'=>$user->id]);
            $member->user_id = $user->id;
            $member->membership_card_no = $request->membership_card_no;
            $member->member_type = $request->member_type;
            $member->save(); 
           return redirect()->route('admin.member.lists')->with(['message'=>'Member update successfully.','class'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Whoops, looks like something went wrong ! Try again ...','class'=>'error']);
       
    }
    public function passwordReset(User $user){
        $password = $this->random_password(6);
        $user->password = bcrypt($password);
        
        if($user->save()){
         $message = 'Thank you for ICAPS membership registration. Your customer id is '.$user->customer_id.' and your password is '.$password.' For order & enquiry Please contact on these No : 9996786071, 9996786072, 9996786073, 9996786074, 9996786075 or visit www.icaps.co.in';
           Event::fire(new SendSmsEvent($user->mobile,$message));
           return response()->json(['message'=>'Password reset successfully ...','status'=>'OK']);
       }
       return response()->json(['message'=>'Whoops, looks like something went wrong ! Try again ...','status'=>'error']);
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyRequest(Member $id)
    {
        $id->delete();
        return redirect()->route('admin.member.lists')->with(['message'=>'Member delete success ...!','class'=>'success']);
       
        
    }
   public function destroy(Member $member)
    {
        if(Auth::guard('admin')->user()->permission == 1){  
            if($member->delete()){
                $message = 'As per your request your membership with icaps has been cancelled.';
                Event::fire(new SendSmsEvent($member->user->mobile,$message));
                return response()->json(['message'=>'Member delete successfully ...','status'=>'OK']);
            }
            return response()->json(['message'=>'Whoops, looks like something went wrong ! Try again ...','status'=>'error']);
        }
        else{
            return response()->json(['message'=>'You have not permission to access this.','status'=>'error']);
        }
       
        
    }
}
