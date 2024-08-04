<?php

namespace App\Http\Controllers\Front;
use App\Model\Catalog\Cart;
use App\Model\Catalog\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Catalog\SellOnProduct;
use App\Model\Catalog\OrderItem;
use App\Model\Catalog\ProductItem;
use App\Model\Catalog\Order;    
use Session;
use Auth;
use Carbon\Carbon;
use App\Events\SendSmsEvent;
use Event;
class CartController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (!Session::has('cart')) {
            return view('front.cart.list');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart); 
        return view('front.cart.list', ['items' => $cart->items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $this->validate($request,[
            'qt' => 'nullable|integer|min:1',
        ]);
        if($request->lv > 0){
            $this->validate($request,[
            'lv' => 'nullable|integer|min:1',
            'sv' => 'nullable|integer',
            ]);
        }
        if($request->sv > 0){
            $this->validate($request,[
            'lv' => 'nullable|integer',
            'sv' => 'nullable|integer|min:50',
            ]);
        }
        $pid = decrypt($request->puk); 
        $sop = decrypt($request->sop);  
        $iid = decrypt($request->iid);    
        $oldcart = Session::has('cart')?$request->session()->get('cart'):null;
        $cart = new Cart($oldcart);
        $qty = ($request->qt)? $request->qt :   ['lv'=>$request->lv,'sv'=>$request->sv];
        $cart->add($pid, $qty, $sop, $iid);
        $request->session()->put('cart', $cart);
        return redirect()->back();
    }

    public function checkout()
    {
        if(!Session::has('cart')){
           return redirect()->route('front.home')->with(['class'=>'success','message'=>'There have no any cart']);
        }
        return view('front.catalog.checkout');
    }
     public function order(Request $request)
     {


        if (!Carbon::now()->between(Carbon::createFromTime(22), Carbon::createFromTime(00),false)) {
            return redirect()->route('front.home')->with(['class'=>'error','message'=>'you can order between 12AM to 10PM...']);
        }
       
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        foreach ($cart->items as $itemCheckout1) {
                @$productItem = ProductItem::find($itemCheckout1['iid']);
                @$sop = SellOnProduct::find($itemCheckout1['sop']);
                if($productItem->saleUnit->weight){
                    $qty1 = implode('.',$itemCheckout1['qty']);
                    $itemCheckout1['qty']['sv'] = str_pad($itemCheckout1['qty']['sv'], 3, '0', STR_PAD_LEFT);
                    $qty2 = implode('.',$itemCheckout1['qty']);
                }else{
                    $qty1 = $itemCheckout1['qty'];
                    $qty2 = $itemCheckout1['qty'];
                }
                if($productItem->unit->alias == 'gm' && $productItem->saleUnit->alias == 'kg' || $productItem->unit->alias == 'ml' && $productItem->saleUnit->alias == 'ltr'){ 
                    $grandTotal = $sop->msp*(($qtyCart2*1000)/$qty2->qty);
                }
                elseif($productItem->unit->alias == 'pcs' && $productItem->saleUnit->alias == 'pcs'){
                    $grandTotal =($sop->msp/$productItem->qty)*$qty2 ;
                }
                else{
                    $grandTotal = $sop->msp*$qty2;
                }
                @$totalPrice += $grandTotal;
        }
        
        $order = new Order();
        $order->ukey = str_random(12);
        $order->user_id = Auth::guard('user')->user()->id;
        $order->amount = (int)round($totalPrice);  
        $order->address = Auth::guard('user')->user()->address_id;  
        $order->slot = $request->slot;
        
        if($order->save()){
            foreach($cart->items as $itemCheckout2){
                @$productItem2 = ProductItem::find($itemCheckout2['iid']);
                @$sop2 = SellOnProduct::find($itemCheckout2['sop']);
                if($productItem2->saleUnit->weight){
                    $itemCheckout2['qty']['sv'] = str_pad($itemCheckout2['qty']['sv'], 3, '0', STR_PAD_LEFT);
                    $qty2 = implode('.',$itemCheckout2['qty']);
                }else{
                    $qty2 = $itemCheckout2['qty'];
                }
                $orderItem = new OrderItem();
                $orderItem->ukey = str_random(20);
                $orderItem->order_id = $order->id;
                $orderItem->user_id = Auth::guard('user')->user()->id;
                $orderItem->qty = $qty2;
                $orderItem->msp = $sop2->msp;
                $orderItem->mrp = $productItem2->mrp;
                $orderItem->iid = $productItem2->id;
                $orderItem->sop = $itemCheckout2['sop'];
                $orderItem->pid = $itemCheckout2['pid'];
                $orderItem->save();
            }
            Session::forget('cart');
            $message = 'Your order will be delivered next day. Thank you for visiting our website.';
            Event::fire(new SendSmsEvent($order->user->mobile,$message));
            return redirect()->route('front.home')->with(['message'=>'Sucessfully Your order will be delivered next day','class'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Whoops, looks like something went wrong ! Try again ...','class'=>'error']);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        $product = decrypt($product);
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        if(array_key_exists($product, $oldCart->items)) {
            if (count($oldCart->items) > 1) {
                unset($oldCart->items[$product]);
            }
            else{
                Session::forget('cart');
            }
            
        }  
        return redirect()->back()->with(['message'=>'Cart item removed','class'=>'success']);
    }
}
