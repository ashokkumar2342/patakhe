<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Model\Catalog\ProductOnCategory;
use Mail;
use App\Mail\test\Testmail;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fruits =  ProductOnCategory::where('product_on_categories.cid',54)
            ->join('categories', 'product_on_categories.cid','=', 'categories.id')
            ->join('products', 'product_on_categories.pid', '=', 'products.id')
            ->leftJoin('product_images','products.id','=','product_images.pid')
            ->join('product_items', 'products.id', '=', 'product_items.pid')
            ->leftJoin('product_item_images','product_item_images.iid','=','product_items.id')
            ->join('sell_on_products', 'product_items.id', '=', 'sell_on_products.iid')
            ->where(['product_on_categories.deleted_at'=>null,'categories.deleted_at'=>null,'products.deleted_at'=>null,'product_images.deleted_at'=>null,'product_items.deleted_at'=>null,'product_item_images.deleted_at'=>null,'sell_on_products.deleted_at'=>null,])
            ->select('products.name as pName','products.ukey as pUkey','product_images.name as pImage', 'product_items.qty as piQty','product_items.unit_id as piUnit','product_items.ukey as piUkey','product_items.mrp as piMrp','sell_on_products.msp as sopMsp','categories.ukey as cUkey','categories.name as cName','product_item_images.name as piImage')
            ->get(); 
        $vegetables =  ProductOnCategory::where('product_on_categories.cid',4)
            ->join('categories', 'product_on_categories.cid','=', 'categories.id')
            ->join('products', 'product_on_categories.pid', '=', 'products.id')
            ->leftJoin('product_images','products.id','=','product_images.pid')
            ->join('product_items', 'products.id', '=', 'product_items.pid')
            ->leftJoin('product_item_images','product_item_images.iid','=','product_items.id')
            ->join('sell_on_products', 'product_items.id', '=', 'sell_on_products.iid')
            ->where(['categories.deleted_at'=>null,'products.deleted_at'=>null,'product_images.deleted_at'=>null,'product_items.deleted_at'=>null,'product_item_images.deleted_at'=>null,'sell_on_products.deleted_at'=>null,])
            ->select('products.name as pName','products.ukey as pUkey','product_images.name as pImage', 'product_items.qty as piQty','product_items.unit_id as piUnit','product_items.ukey as piUkey','product_items.mrp as piMrp','sell_on_products.msp as sopMsp','categories.ukey as cUkey','categories.name as cName','product_item_images.name as piImage')
            ->get();
        $newArrivals =  ProductOnCategory::where(['product_on_categories.cid'=>43])
            ->join('categories', 'product_on_categories.cid','=', 'categories.id')
            ->join('products', 'product_on_categories.pid', '=', 'products.id')
            ->leftJoin('product_images','products.id','=','product_images.pid')
            ->join('product_items', 'products.id', '=', 'product_items.pid')
            ->leftJoin('product_item_images','product_item_images.iid','=','product_items.id')
            ->join('sell_on_products', 'product_items.id', '=', 'sell_on_products.iid')
            ->where(['categories.deleted_at'=>null,'products.deleted_at'=>null,'product_images.deleted_at'=>null,'product_items.deleted_at'=>null,'product_item_images.deleted_at'=>null,'sell_on_products.deleted_at'=>null,])
            ->select('products.name as pName','products.ukey as pUkey','product_images.name as pImage', 'product_items.qty as piQty','product_items.unit_id as piUnit','product_items.ukey as piUkey','product_items.mrp as piMrp','sell_on_products.msp as sopMsp','categories.ukey as cUkey','categories.name as cName','product_item_images.name as piImage')
            ->get();
            
        return view('front.home',compact('fruits','vegetables','newArrivals'));
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
    public function destroy($id)
    {
        //
    }
}
