<?php

namespace App\Http\Controllers\Admin;

use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\SendSmsEvent;
use Event;
use Auth;
class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sellers = Seller::latest()->get();
        return view('admin.seller.list',compact('sellers'));
    }

    public function newSeller()
    {
        return view('admin.seller.new');
    }
    public function status(Seller $seller){
        $data = ($seller->status == 1)?['status' => 0, 'addClass' => 'btn-danger', 'removeClass' => 'btn-success','message'=>'User deactivated ...', 'text' => 'Inactive', ]:['status' => 1, 'addClass' => 'btn-success', 'removeClass' => 'btn-danger', 'message'=>'User activated ...', 'text' => 'Active', ]; 
        $seller->status = $data['status'];
        if($seller->save()){
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
    public function create(Request $request)
    {
        //
        $this->validate($request, [
            'first_name' => 'required|max:199',
            'last_name' => 'required|max:199',
            'email' => 'sometimes|email|max:255|unique:sellers',
            'mobile' => 'required|numeric|unique:sellers',
        ]);
        $password = $this->random_password(6);
        $seller = Seller::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'mobile' => $request['mobile'],
            'mobile_verified' =>1,
            'email_verified' =>1,
            'password' => bcrypt($password),
            'status'    => 1
        ]);
        $message = 'You have been successfully registered. '.$password.' is your icaps seller account password. For Support  Please contact on these No : 9996786071, 9996786072, 9996786073, 9996786074, 9996786075 or visit www.icaps.co.in ';
        Event::fire(new SendSmsEvent($seller->mobile,$message));
        return redirect()->route('admin.seller.lists')->with(['message'=>'Seller Registration successfully','class'=>'success']);
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
   public function edit(Seller $seller)
    {
        return view('admin.seller.edit',compact('seller'));

    }
    


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seller $seller)
    {
        //
        $this->validate($request,[
            'first_name' => 'required|max:199',
            'last_name' =>  'required|max:199',
            'mobile'    =>  'required|numeric',
        ]);
        if ($seller->mobile != $request->mobile) {
            $this->validate($request,[
                'mobile' =>  'nullable|numeric|unique:sellers',
            ]);
        }
        if ($seller->email != $request->email) {
            $this->validate($request,[
                'email' =>  'nullable|email|max:255|unique:sellers',
            ]);
        }
        $seller->first_name = $request->first_name;
        $seller->last_name = $request->last_name;
        $seller->mobile = $request->mobile;
        $seller->email = $request->email;
        if($seller->save()){
            return redirect()->route('admin.seller.lists')->with(['message'=>'seller update successfully ..!','class'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Whoops, looks like something went wrong ! Try again ...','class'=>'error']);
        
    }
    public function passwordReset(Seller $seller){
        $password = $this->random_password(6);
        $seller->password = bcrypt($password);
        
        if($seller->save()){
            $message = 'As per your request your password have changed. Your new password is '.$password.'.';
            Event::fire(new SendSmsEvent($seller->mobile,$message));
            return response()->json(['message'=>'Password reset successfully ...','status'=>'OK']);
       }
       return response()->json(['message'=>'Whoops, looks like something went wrong ! Try again ...','status'=>'error']);
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller)
    {
        if ($seller->delete()) {
             $message = 'You are removed from icaps seller account for mor information please contact us.';
            Event::fire(new SendSmsEvent($seller->mobile,$message));
            return response()->json(['message'=>'seller delete successfully ...','status'=>'OK']);
        }
        return response()->json(['message'=>'Whoops, looks like something went wrong ! Try again ...','status'=>'error']);
    }
}
