<?php

namespace App\Http\Controllers\User;

use App\Model\Catalog\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Catalog\OrderItem;
use Hash;
use Auth;
use App\Review;
use App\Model\Catalog\OrderStatus;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $orders = Order::where('user_id',Auth::guard('user')->user()->id)->latest()->paginate(10);
        return view('user.profile.orderlist',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orderItemCancel(Request $request,  $orderItem)
    {
        $orderItem = OrderItem::where('ukey',$orderItem)->firstOrFail();
        if ($orderItem->user_id == Auth::guard('user')->user()->id && $orderItem->status == 1) {
            $orderItem->status = 2;
            if($orderItem->save()){
                 return redirect()->back()->with(['message'=>'Order Item canceled.','class'=>'success']);
            }
            return redirect()->back()->with(['message'=>'Whoops Look like something went wrong.','class'=>'error']);
        }
        return redirect()->back()->with(['message'=>'You have not allowed to cancled this item','class'=>'error']);
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
    public function show( $order)
    {
        $order = Order::where('ukey',$order)->firstOrFail();
        if ($order->user_id != Auth::guard('user')->user()->id) {
            return redirect()->back()->with(['message'=>'order not find ! Try different ..','class'=>'error']);
        }
        return view('user.profile.orderview',compact('order'));
         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Catalog\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function cancel($order)
    {
       
        $order = Order::where('ukey',$order)->firstOrFail();
        if ($order->user_id == Auth::guard('user')->user()->id && $order->status == 1) {
            $order->status = 2;
            if($order->save()){
                 return redirect()->back()->with(['message'=>'Order canceled.','class'=>'success']);
            }
            return redirect()->back()->with(['message'=>'Whoops Look like something went wrong.','class'=>'error']);
        }
        return redirect()->back()->with(['message'=>'You have not allowed to cancled this item','class'=>'error']);
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
    }
}
