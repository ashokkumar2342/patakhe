<?php

namespace App\Http\Controllers\Admin\Assistance;

use App\Pan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class PanCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pancards = Pan::orderBy('id','desc')->get();
        return view('admin.assistance.pancard.list',compact('pancards'));
    }
    //request status 
    public function status(Pan $pan){
        if(Auth::guard('admin')->user()->permission == 1){
            $data = ($pan->status == 1)?['status' => 0, 'addClass' => 'btn-danger', 'removeClass' => 'btn-success','message'=>'Request Done. Thank you..', 'text' => 'Pending', ]:['status' => 1, 'addClass' => 'btn-success', 'removeClass' => 'btn-danger', 'message'=>'Request Reopen. Please inform the manegment...', 'text' => 'Done'];

            $pan->status = $data['status'];
            if($pan->save()){
                return response()->json(['status'=>'OK','message'=>$data['message'],'btn'=>['addClass'=>$data['addClass'],'removeClass'=>$data['removeClass'],'text'=>$data['text']]]);
            }
            else{
                return response()->json(['status'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
            }

        }
        else{
            
            if($pan->status == 0){
                $data = ['status' => 1, 'addClass' => 'btn-success', 'removeClass' => 'btn-danger','message'=>'Request Done. Thank you..', 'text' => 'Done', ];
                $pan->status = $data['status'];
                if($pan->save()){
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
     * @param  \App\Pan  $pan
     * @return \Illuminate\Http\Response
     */
    public function show(Pan $pan)
    {
        //
        return view('admin.assistance.pancard.view',compact('pan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pan  $pan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pan $pan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pan  $pan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pan $pan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pan  $pan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pan $pan)
    {
        //
        if(Auth::guard('admin')->user()->permission == 1){
            if($pan->delete()){
              return response()->json(['message'=>'Data deleted successfully.','status'=>'OK']);
            }
            return response()->json(['message'=>'Whoops, looks like something went wrong ! Try again ...','status'=>'error']);
        }
        else{
            return response()->json(['message'=>'You have not permission to access this.','status'=>'error']);
        }
    }
}
