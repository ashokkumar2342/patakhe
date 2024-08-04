<?php

namespace App\Http\Controllers\Admin\Services;

use App\Dth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class DthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dthservices = Dth::orderBy('id','desc')->get();
        return view('admin.services.dthservice.list',compact('dthservices'));
    }

     //request status 
    public function status(Dth $dth){
        if(Auth::guard('admin')->user()->permission == 1){
            $data = ($dth->status == 1)?['status' => 0, 'addClass' => 'btn-danger', 'removeClass' => 'btn-success','message'=>'Request Done. Thank you..', 'text' => 'Pending', ]:['status' => 1, 'addClass' => 'btn-success', 'removeClass' => 'btn-danger', 'message'=>'Request Reopen. Please inform the manegment...', 'text' => 'Done'];

            $dth->status = $data['status'];
            if($dth->save()){
                return response()->json(['status'=>'OK','message'=>$data['message'],'btn'=>['addClass'=>$data['addClass'],'removeClass'=>$data['removeClass'],'text'=>$data['text']]]);
            }
            else{
                return response()->json(['status'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
            }

        }
        else{
            
            if($dth->status == 0){
                $data = ['status' => 1, 'addClass' => 'btn-success', 'removeClass' => 'btn-danger','message'=>'Request Done. Thank you..', 'text' => 'Done', ];
                $dth->status = $data['status'];
                if($dth->save()){
                    return response()->json(['status'=>'OK','message'=>$data['message'],'btn'=>['addClass'=>$data['addClass'],'removeClass'=>$data['removeClass'],'text'=>$data['text']]]);
                }
                else{
                    return response()->json(['status'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
                }
            }
            return response()->json(['status'=>'error','message'=>'You can not open this case']);
        }        
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
     * @param  \App\Dth  $dth
     * @return \Illuminate\Http\Response
     */
    public function show(Dth $dth)
    {
        //
        return view('admin.services.dthservice.view',compact('dth'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dth  $dth
     * @return \Illuminate\Http\Response
     */
    public function edit(Dth $dth)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dth  $dth
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dth $dth)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dth  $dth
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dth $dth)
    {
        //
        if(Auth::guard('admin')->user()->permission == 1){
            if($dth->delete()){
              return response()->json(['message'=>'Data deleted successfully.','status'=>'OK']);
            }
            return response()->json(['message'=>'Whoops, looks like something went wrong ! Try again ...','status'=>'error']);
        }
        else{
            return response()->json(['message'=>'You have not permission to access this.','status'=>'error']);
        }
    }
}
