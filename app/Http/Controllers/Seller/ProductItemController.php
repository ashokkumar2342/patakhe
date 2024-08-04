<?php

namespace App\Http\Controllers\Seller;

use App\Model\Catalog\ProductItem;
use App\Model\Catalog\ProductItemImage;
use App\Model\Catalog\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class ProductItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request,$product)
    {
        $this->validate($request,[
            'qty' => 'required|numeric',
            'sale_unit' => 'required|numeric',
            'unit' => 'required|numeric',
        ]);
        $product = Product::where(['ukey'=>$product])->firstOrFail();
        $productItem = new ProductItem();
        $productItem->ukey = str_random('15');
        $productItem->sid = Auth::guard('seller')->user()->id;
        $productItem->pid = $product->id;
        $productItem->qty = $request->qty;
        $productItem->unit_id = $request->unit;
        $productItem->mrp = $request->product_price;
        $productItem->sale_unit_id = $request->sale_unit;
        $productItem->keywords = $request->keywords;
        $productItem->description = $request->description;
        if ($productItem->save()) {
            return redirect()->back()->with(['message'=>'Product item added successfully ...','class'=>'success']);
        }   
        return redirect()->back()->with(['message'=>'Whoops Look like something went wrong.','class'=>'error']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Catalog\ProductItem  $productItem
     * @return \Illuminate\Http\Response
     */
    public function show($product, $productItem)
    {
        
    }
    public function imageAdd(Request $request,$product,$productItem){
        $this->validate($request,['image'=>'required|image|mimes:jpeg,png|between:10,1024|dimensions:width=917,height=1000']);
        $product = Product::where('ukey',$product)->firstOrFail();
        $productItem = ProductItem::where(['ukey'=>$productItem,'sid'=>Auth::guard('seller')->user()->id])->firstOrFail();
        $filename = str_slug($product->name.' '.strtolower(str_random(5)),'_').'.'.$request->file('image')->getClientOriginalExtension();
        $request->image->storeAs('image/product',$filename,'public');

        $productItemImage = new ProductItemImage ();
        $productItemImage->sid = Auth::guard('seller')->user()->id;
        $productItemImage->iid = $productItem->id;
        $productItemImage->name = $filename;
        
        if ($productItemImage->save()) {
            return redirect()->back()->with(['message'=>'Product item image added successfully ...','class'=>'success']);
        }   
        return redirect()->back()->with(['message'=>'Whoops Look like something went wrong.','class'=>'error']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Catalog\ProductItem  $productItem
     * @return \Illuminate\Http\Response
     */
    public function edit($product,$productItem)
    {
        $product = Product::where(['ukey'=>$product])->firstOrFail();
        $productItem = ProductItem::where(['ukey'=>$productItem,'sid'=>Auth::guard('seller')->user()->id])->firstOrFail();
        $productItemImages = productItemImage::where('iid',$productItem->id)->get();
        return view('seller.product.item.edit',compact('product','productItem','productItemImages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Catalog\ProductItem  $productItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product, $productItem)
    {
        $this->validate($request,[
            'qty' => 'required|numeric',
            'sale_unit' => 'required|numeric',
            'unit' => 'required|numeric'
        ]);
        $product = Product::where(['ukey'=>$product])->firstOrFail();
        $productItem = ProductItem::where(['ukey'=>$productItem,'sid'=>Auth::guard('seller')->user()->id])->firstOrFail();
        $productItem->qty = $request->qty;
        $productItem->unit_id = $request->unit;
        $productItem->mrp = $request->product_price;
        $productItem->sale_unit_id = $request->sale_unit;
        $productItem->keywords = $request->keywords;
        $productItem->description = $request->description;
        if ($productItem->save()) {
            $referr = ($request->referr)?$request->referr : route('seller.product.item.list');
            return redirect($referr)->with(['message'=>'Product item updated successfully ...','class'=>'success']);
        }   
        return redirect()->back()->with(['message'=>'Whoops Look like something went wrong.','class'=>'error']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Catalog\ProductItem  $productItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductItem $productItem)
    {
        //
    }
}
