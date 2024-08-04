<?php

namespace App\Http\Controllers\Admin\Assistance;

use App\Training;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $trainings = Training::orderBy('id','desc')->get();
        return view('admin.assistance.training.list',compact('trainings'));
    }

     //request status 
    public function status(Training $training){
        if(Auth::guard('admin')->user()->permission == 1){
            $data = ($training->status == 1)?['status' => 0, 'addClass' => 'btn-danger', 'removeClass' => 'btn-success','message'=>'Request Done. Thank you..', 'text' => 'Pending', ]:['status' => 1, 'addClass' => 'btn-success', 'removeClass' => 'btn-danger', 'message'=>'Request Reopen. Please inform the manegment...', 'text' => 'Done'];

            $training->status = $data['status'];
            if($training->save()){
                return response()->json(['status'=>'OK','message'=>$data['message'],'btn'=>['addClass'=>$data['addClass'],'removeClass'=>$data['removeClass'],'text'=>$data['text']]]);
            }
            else{
                return response()->json(['status'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
            }

        }
        else{
            
            if($training->status == 0){
                $data = ['status' => 1, 'addClass' => 'btn-success', 'removeClass' => 'btn-danger','message'=>'Request Done. Thank you..', 'text' => 'Done', ];
                $training->status = $data['status'];
                if($training->save()){
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
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function show(Training $training)
    {
        //
        return view('admin.assistance.training.view',compact('training'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function edit(Training $training)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Training $training)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function destroy(Training $training)
    {
        //
        if(Auth::guard('admin')->user()->permission == 1){
            if($training->delete()){
              return response()->json(['message'=>'Data deleted successfully.','status'=>'OK']);
            }
            return response()->json(['message'=>'Whoops, looks like something went wrong ! Try again ...','status'=>'error']);
        }
        else{
            return response()->json(['message'=>'You have not permission to access this.','status'=>'error']);
        }
    }
}
