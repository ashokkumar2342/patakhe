<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Model\Catalog\Order;
use App\Model\Catalog\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id','desc')->get();
        // dd($orders);
        return view('admin.catalog.order.list',compact('orders'));
    }
    public function status(Order $order){
        $data = ($order->status == 4)?['status' => 1, 'addClass' => 'btn-danger', 'removeClass' => 'btn-success','message'=>'Order canceled ...', 'text' => 'Pending', ]:['status' => 4, 'addClass' => 'btn-success', 'removeClass' => 'btn-danger', 'message'=>'Order done ...', 'text' => 'Done', ]; 
        $order->status = $data['status'];
        if($order->save()){
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
    public function cancelOrder(Request $request, Order $order)
    {
        $order->status = 2;
        if($order->save()){
            return redirect()->back()->with(['status'=>'OK','message'=>'Order cancelation success ...']);
        }
        return redirect()->back()->with(['status'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);   
    }


    public function cancelOrderItem(Request $request, OrderItem $orderItem)
    {
        $orderItem->status = 2;
        if($orderItem->save()){
            return redirect()->back()->with(['status'=>'OK','message'=>'Order Item cancelation success ...']);
        }
        return redirect()->back()->with(['status'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);   
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
     * @param  \App\Model\Catalog\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
        // dd(unserialize($order->cart));
        return view('admin.catalog.order.view',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Catalog\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Catalog\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Catalog\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
        if ($order->delete()) {
            return response()->json(['status'=>'OK','message'=>'Order delete success ...!']);
        }
        return response()->json(['status'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);   
    }
}
