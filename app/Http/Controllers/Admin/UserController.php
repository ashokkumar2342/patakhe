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
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newUser()
    {
        //
        return view('admin.user.new');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists()
    {
        //
        $users = User::doesntHave('member')->latest()->get();
        return view('admin.user.list',compact('users'));
    }
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name' => 'required|max:199',
            'last_name' => 'required|max:199',
            'email' => 'sometimes|nullable|email|max:199|unique:users',
            'mobile' =>'required|numeric|unique:users',
        ]);
        $password = $this->random_password(6);
        $user= User::create([
            'first_name'   => $request->first_name,
            'last_name' =>  $request->last_name,
            'email' =>  $request->email,
            'password'  => bcrypt($password),
            'mobile'    =>  $request->mobile,
            'mobile_verified' => 1,
            'status'    =>  1,
        ]);
        $message = 'Thank you for connecting with I-CAPS. Your user id is '.$user->mobile.' and your password is '.$password.'  For Membership Registration Assistance Please contact on these No : 9996786071, 9996786072, 9996786073, 9996786074, 9996786075 or visit www.icaps.co.in';
        Event::fire(new SendSmsEvent($request->mobile,$message));
        return redirect()->route('admin.user.lists')->with(['message'=>'User registration successfully.','class'=>'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        return view('admin.user.view',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        return view('admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        $this->validate($request,[
            'first_name' => 'required|max:255',
            'last_name' => 'nullable|max:255',
            'street_address' => 'nullable|max:1000',
            'address' => 'nullable|max:1000',
            'landmark' => 'nullable|max:100'
        ]);
        if( $user->mobile != $request->mobile){
            $this->validate($request,[
                'mobile' => 'required|numeric|unique:users',
            ]);
        }
        if( $user->email != $request->email){
            $this->validate($request,[
                'email' => 'required|email|max:199|unique:users',
            ]);
        }
        $oldMobile = $user->mobile;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->gender = $request->gender;
        $user->mobile = $request->mobile;
        $user->dob = ($request->date_of_birth)?date('Y-m-d',strtotime($request->date_of_birth)):null;

        $address = UserAddress::firstOrNew(['id'=>$user->address_id]);
        $address->user_id = $user->id;
        $address->address = $request->address;
        $address->street = $request->street_address;
        $address->landmark = $request->landmark;
        $address->save();

        //update user default address
        $user->address_id = $address->id;

        if ($user->save()) {   
            if($oldMobile != $user->mobile){
                $message = 'Resently your mobile no. has been changed. For Membership Registration Assistance Please contact on these No : 9996786071, 9996786072, 9996786073, 9996786074, 9996786075 or visit www.icaps.co.in';
                Event::fire(new SendSmsEvent($user->mobile,$message));
            }
            return redirect()->route('admin.user.lists')->with(['message'=>'User Updated successfully !','class'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Whoops, looks like something went wrong ! Try again ...','class'=>'error']);
    }
    public function passwordReset(User $user){
        $password = $this->random_password(6);
        $user->password = bcrypt($password);
        
        if($user->save()){
         $message = 'Resently your password has been changed. Your new password is'.$password.'  For Membership Registration Assistance Please contact on these No : 9996786071, 9996786072, 9996786073, 9996786074, 9996786075 or visit www.icaps.co.in';
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
   public function destroy(User $user)
    {
        if ($user->delete()) {
            return response()->json(['status'=>'OK','message'=>'User delete success ...!']);
        }
        return response()->json(['status'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);   
    }
}
