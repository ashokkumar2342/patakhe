<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Model\Catalog\ProductItem;
use App\Model\Catalog\SellOnProduct;
use App\Model\Catalog\Category;
use App\Model\Catalog\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    public function sop($product,$productItem,$sop)
    {
        $product = Product::where('ukey',$product)->firstOrFail();  
        $productItem = ProductItem::where('ukey',$productItem)->firstOrFail();  
        $sop = SellOnProduct::where('ukey',$sop)->firstOrFail();  
        $spCat = Category::all();
        dd($spCat);
        return view('admin.catalog.product.item.sop.view',compact('product','productItem','sop')); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Catalog\ProductItem  $productItem
     * @return \Illuminate\Http\Response
     */
    public function show($product, $productItem)
    {
        $product = Product::where('ukey',$product)->firstOrFail();
        $productItem = ProductItem::where(['ukey'=>$productItem])->firstOrFail();
        return view('admin.catalog.product.item.view',compact('productItem','product'));   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Catalog\ProductItem  $productItem
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductItem $productItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Catalog\ProductItem  $productItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductItem $productItem)
    {
        //
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
