<?php

namespace App\Http\Controllers\Admin\Consultancy;

use App\Construction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class ConstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $constructions = Construction::orderBy('id','desc')->get();
        return view('admin.consultancy.construction.list',compact('constructions'));
    }
    public function status(Construction $construction){
        if(Auth::guard('admin')->user()->permission == 1){
            $data = ($construction->status == 1)?['status' => 0, 'addClass' => 'btn-danger', 'removeClass' => 'btn-success','message'=>'Request Done. Thank you..', 'text' => 'Pending', ]:['status' => 1, 'addClass' => 'btn-success', 'removeClass' => 'btn-danger', 'message'=>'Request Reopen. Please inform the manegment...', 'text' => 'Done'];
            $construction->status = $data['status'];
            if($construction->save()){
                return response()->json(['status'=>'OK','message'=>$data['message'],'btn'=>['addClass'=>$data['addClass'],'removeClass'=>$data['removeClass'],'text'=>$data['text']]]);
            }
            else{
                return response()->json(['status'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
            }

        }
        else{
            
            if($construction->status == 0){
                $data = ['status' => 1, 'addClass' => 'btn-success', 'removeClass' => 'btn-danger','message'=>'Request Done. Thank you..', 'text' => 'Done', ];
                $construction->status = $data['status'];
                if($construction->save()){
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
     * @param  \App\Construction  $construction
     * @return \Illuminate\Http\Response
     */
    public function show(Construction $construction)
    {
        //
        return view('admin.consultancy.construction.view',compact('construction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Construction  $construction
     * @return \Illuminate\Http\Response
     */
    public function edit(Construction $construction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Construction  $construction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Construction $construction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Construction  $construction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Construction $construction)
    {
        //
        if(Auth::guard('admin')->user()->permission == 1){
            if($construction->delete()){
              return response()->json(['message'=>'Data deleted successfully.','status'=>'OK']);
            }
            return response()->json(['message'=>'Whoops, looks like something went wrong ! Try again ...','status'=>'error']);
        }
        else{
            return response()->json(['message'=>'You have not permission to access this.','status'=>'error']);
        }
    }
}
