<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Catalog\SellOnProduct;
use App\Model\Catalog\Product;
use App\Model\Catalog\ProductItem;
use Auth;
class SellOnProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($product,$productItem)
    {
        $product = Product::where('ukey',$product)->firstOrFail();
        $productItem = ProductItem::where(['ukey'=>$productItem])->firstOrFail();
        return view('seller.product.item.sale.form',compact('productItem','product'));       
    }
    public function lists(){
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status(SellOnProduct $product)
    {
        //
        if ($product->sid != Auth::guard('seller')->user()->id) {
           return response()->json(['status'=>'error','message'=>'You have not authorised to modify this..']);
        }
        $data = ($product->status == 1)?['status' => 0, 'addClass' => 'btn-danger', 'removeClass' => 'btn-success','message'=>'Product deactivated ...', 'text' => 'Inactive', ]:['status' => 1, 'addClass' => 'btn-success', 'removeClass' => 'btn-danger', 'message'=>'Product activated ...', 'text' => 'Active', ]; 
        $product->status = $data['status'];
        if($product->save()){
            return response()->json(['status'=>'OK','message'=>$data['message'],'btn'=>['addClass'=>$data['addClass'],'removeClass'=>$data['removeClass'],'text'=>$data['text']]]);
        }
        else{
            return response()->json(['status'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $product,$productItem)
    {
        //
        $product = Product::where('ukey',$product)->firstOrFail();
        $productItem = ProductItem::where('ukey',$productItem)->firstOrFail();
        
        $this->validate($request,[
            'stock' => 'nullable|numeric',
            'selling_price' => 'required|numeric'
        ]);
        
        $sellOnProduct = new SellOnProduct();
        $sellOnProduct->sid = Auth::guard('seller')->user()->id;
        $sellOnProduct->ukey = str_random(18);
        $sellOnProduct->pid = $product->id;
        $sellOnProduct->iid = $productItem->id;
        $sellOnProduct->msp = $request->selling_price;
        $sellOnProduct->position = Auth::guard('seller')->user()->position;
        $sellOnProduct->stock = $request->stock;
        // $sellOnProduct->expire = date('Y-m-d h:m:i',strtotime($request->price_expire));
        if($sellOnProduct->save()){
            return redirect()->back()->with(['message'=>'Product sell successfully ...','class'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Whoops Look like something went wrong.','class'=>'error']);
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
     public function create($product)
    {
        // $product = Product::where('ukey',$product)->firstOrFail();
        // return view('seller.sellonproduct.sell',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product, $productItem, $sellUkey)
    {   
        $product = Product::where('ukey',$product)->firstOrFail();
        $productItem = ProductItem::where('ukey',$productItem)->firstOrFail();
        $saleOnProduct = SellOnProduct::where(['ukey'=>$sellUkey,'iid'=>$productItem->id,'sid'=>Auth::guard('seller')->user()->id,'pid'=>$product->id])->firstOrFail();
        return view('seller.product.item.sale.edit',compact('product','productItem','saleOnProduct'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product, $productItem,$sellUkey)
    {
       
        //  $product = Product::where('ukey',$product)->firstOrFail();
        //  $productItem = ProductItem::where('ukey',$productItem)->firstOrFail();
        $product = Product::where('ukey',$product)->firstOrFail();
        $productItem = ProductItem::where('ukey',$productItem)->firstOrFail();
        $sellOnProduct = SellOnProduct::where(['ukey'=>$sellUkey,'iid'=>$productItem->id,'sid'=>Auth::guard('seller')->user()->id,'pid'=>$product->id])->firstOrFail();
        $this->validate($request,[
            'stock' => 'nullable|numeric',
            'selling_price' => 'required|numeric'
        ]);
        $sellOnProduct->msp = $request->selling_price;
        $sellOnProduct->stock = $request->stock;
        // $sellOnProduct->expire = date('Y-m-d h:m:i',strtotime($request->price_expire));
        if($sellOnProduct->save()){
            return redirect()->back()->with(['message'=>'data updated successfully ...','class'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Whoops Look like something went wrong.','class'=>'error']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product,$productItem,$sellUkey)
    {
        $product = Product::where('ukey',$product)->firstOrFail();
        $productItem = ProductItem::where('ukey',$productItem)->firstOrFail();
        $sellOnProduct = SellOnProduct::where(['ukey'=>$sellUkey,'iid'=>$productItem->id,'sid'=>Auth::guard('seller')->user()->id,'pid'=>$product->id])->firstOrFail();
        if ($sellOnProduct->sid != Auth::guard('seller')->user()->id) {
            return redirect()->back()->with(['message'=>'Product not find ...','class'=>'error']);
        }
        if ($sellOnProduct->delete()) {
           return redirect()->back()->with(['message'=>'data deleted success ...','class'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Whoops Look like something went wrong.','class'=>'error']);
    }
}
