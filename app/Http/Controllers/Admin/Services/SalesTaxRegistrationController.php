<?php

namespace App\Http\Controllers\Admin\Services;

use App\SalesTaxRegistration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class SalesTaxRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $salestaxregistrations = SalesTaxRegistration::orderBy('id','desc')->get();
        return view('admin.services.salestaxregistration.list',compact('salestaxregistrations'));
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status(SalesTaxRegistration $salesTaxRegistration){
        if(Auth::guard('admin')->user()->permission == 1){
            $data = ($salesTaxRegistration->status == 1)?['status' => 0, 'addClass' => 'btn-danger', 'removeClass' => 'btn-success','message'=>'Request Done. Thank you..', 'text' => 'Pending', ]:['status' => 1, 'addClass' => 'btn-success', 'removeClass' => 'btn-danger', 'message'=>'Request Reopen. Please inform the manegment...', 'text' => 'Done'];

            $salesTaxRegistration->status = $data['status'];
            if($salesTaxRegistration->save()){
                return response()->json(['status'=>'OK','message'=>$data['message'],'btn'=>['addClass'=>$data['addClass'],'removeClass'=>$data['removeClass'],'text'=>$data['text']]]);
            }
            else{
                return response()->json(['status'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
            }

        }
        else{
            
            if($salesTaxRegistration->status == 0){
                $data = ['status' => 1, 'addClass' => 'btn-success', 'removeClass' => 'btn-danger','message'=>'Request Done. Thank you..', 'text' => 'Done', ];
                $salesTaxRegistration->status = $data['status'];
                if($salesTaxRegistration->save()){
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
     * @param  \App\SalesTaxRegistration  $salesTaxRegistration
     * @return \Illuminate\Http\Response
     */
    public function show(SalesTaxRegistration $salesTaxRegistration)
    {
        //
        return view('admin.services.salestaxregistration.view',compact('salesTaxRegistration'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SalesTaxRegistration  $salesTaxRegistration
     * @return \Illuminate\Http\Response
     */
    public function edit(SalesTaxRegistration $salesTaxRegistration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SalesTaxRegistration  $salesTaxRegistration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalesTaxRegistration $salesTaxRegistration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SalesTaxRegistration  $salesTaxRegistration
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalesTaxRegistration $salesTaxRegistration)
    {
        //
        if(Auth::guard('admin')->user()->permission == 1){
            if($salesTaxRegistration->delete()){
              return response()->json(['message'=>'Data deleted successfully.','status'=>'OK']);
            }
            return response()->json(['message'=>'Whoops, looks like something went wrong ! Try again ...','status'=>'error']);
        }
        else{
            return response()->json(['message'=>'You have not permission to access this.','status'=>'error']);
        }
    }
}
