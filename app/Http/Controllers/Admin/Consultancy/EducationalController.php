<?php

namespace App\Http\Controllers\Admin\Consultancy;

use App\Educational;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class EducationalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $educationals = Educational::orderBy('id','desc')->get();
        return view('admin.consultancy.educational.list',compact('educationals'));
    }

    //request status 
    public function status(Educational $educational){
        if(Auth::guard('admin')->user()->permission == 1){
            $data = ($educational->status == 1)?['status' => 0, 'addClass' => 'btn-danger', 'removeClass' => 'btn-success','message'=>'Request Done. Thank you..', 'text' => 'Pending', ]:['status' => 1, 'addClass' => 'btn-success', 'removeClass' => 'btn-danger', 'message'=>'Request Reopen. Please inform the manegment...', 'text' => 'Done'];
            $educational->status = $data['status'];
            if($educational->save()){
                return response()->json(['status'=>'OK','message'=>$data['message'],'btn'=>['addClass'=>$data['addClass'],'removeClass'=>$data['removeClass'],'text'=>$data['text']]]);
            }
            else{
                return response()->json(['status'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
            }

        }
        else{
            
            if($educational->status == 0){
                $data = ['status' => 1, 'addClass' => 'btn-success', 'removeClass' => 'btn-danger','message'=>'Request Done. Thank you..', 'text' => 'Done', ];
                $educational->status = $data['status'];
                if($educational->save()){
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
     * @param  \App\Educational  $educational
     * @return \Illuminate\Http\Response
     */
    public function show(Educational $educational)
    {
        //
        return view('admin.consultancy.educational.view',compact('educational'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Educational  $educational
     * @return \Illuminate\Http\Response
     */
    public function edit(Educational $educational)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Educational  $educational
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Educational $educational)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Educational  $educational
     * @return \Illuminate\Http\Response
     */
    public function destroy(Educational $educational)
    {
        //
        if(Auth::guard('admin')->user()->permission == 1){
            if($educational->delete()){
              return response()->json(['message'=>'Data deleted successfully.','status'=>'OK']);
            }
            return response()->json(['message'=>'Whoops, looks like something went wrong ! Try again ...','status'=>'error']);
        }
        else{
            return response()->json(['message'=>'You have not permission to access this.','status'=>'error']);
        }
    }
}
