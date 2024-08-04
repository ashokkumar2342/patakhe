<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\ProductOfTheMonth;
use App\Model\Catalog\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Catalog\SpecialProduct;
use App\Model\Catalog\ProductExpire;
class ProductOfTheMonthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ProductOfTheMonths = ProductOfTheMonth::all();
        return view('admin.product.productofthemonth.list',compact('ProductOfTheMonths'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        //
        return view('admin.product.productofthemonth.form',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Product $product)
    {
        //
        dd($request);
        // $specialProduct = new SpecialProduct();
        // $specialProduct->pid = $product->id;
        // $specialProduct->cid = 1;
        // $specialProduct->
        // if () {
        //     # code...
        // }
        // $datetime = date('Y-m-d h:i:s',strtotime($request->date));
        // $ProductOfTheMonth  = new ProductOfTheMonth();
        // $ProductOfTheMonth->msp = $request->seller_price;
        // $ProductOfTheMonth->stock = $request->stock;
        // $ProductOfTheMonth->expire = $datetime;
        // $ProductOfTheMonth->pid = $product->id;
        // $ProductOfTheMonth->status = $product->status;
        // if($ProductOfTheMonth->save()){
        //     return redirect()->route('admin.productofthemonth.list')->with(['status'=>'OK','message'=>'Special Category Created successfully.']);
        // }
        // return redirect()->back()->with(['status'=>'error','message'=>'There was an problem to creating Special category.']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductOfTheMonth  $productOfTheMonth
     * @return \Illuminate\Http\Response
     */
    public function show(ProductOfTheMonth $productOfTheMonth)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductOfTheMonth  $productOfTheMonth
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductOfTheMonth $productOfTheMonth)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductOfTheMonth  $productOfTheMonth
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductOfTheMonth  $productOfTheMonth
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductOfTheMonth $productOfTheMonth)
    {
        //
    }
}
