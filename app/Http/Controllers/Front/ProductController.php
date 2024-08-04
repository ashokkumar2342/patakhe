<?php

namespace App\Http\Controllers\Front;

use App\Model\Catalog\Product;
use App\Model\Catalog\ProductOnCategory;
use App\Model\Catalog\ProductItem;
use App\Model\Catalog\SellOnProduct;
use App\Model\Catalog\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
class ProductController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchAjax(Request $request)
    {
        if(strlen($request->name) < 1){
            return null;
        }
        $products= Product::join('product_on_categories', 'product_on_categories.pid', '=', 'products.id')
                    ->join('categories', 'product_on_categories.cid','=', 'categories.id')
                    ->join('product_items', 'products.id', '=', 'product_items.pid')
                    ->join('sell_on_products', 'product_items.id', '=', 'sell_on_products.iid')
                    ->join('units','units.id','=','product_items.unit_id')
                    
                    // ->orWhere('categories.name','like','%'.$request->name.'%')
                    ->where(['products.deleted_at'=>null,'categories.deleted_at'=>null,'product_items.deleted_at'=>null,'sell_on_products.deleted_at'=>null,'product_on_categories.deleted_at'=>null])
                    ->where('products.name','like','%'.$request->name.'%')
                    ->orWhere('product_items.keywords','like','%'.$request->name.'%')
                    ->select('products.name as pName','products.ukey as pUkey','product_items.qty as piQty','units.alias as piUnit','product_items.ukey as piUkey','categories.ukey as cUkey','categories.name as cName')
                    ->take(10)
                    ->get();
        return response()->json(['status'=>'OK','jsonData'=>$products]);
    }
    public function search(Request $request)
    {
        $products=   Product::join('product_on_categories', 'product_on_categories.pid', '=', 'products.id')
                    ->join('categories', 'product_on_categories.cid','=', 'categories.id')
                    ->join('product_images', 'products.id', '=', 'product_images.pid')
                    ->join('product_items', 'products.id', '=', 'product_items.pid')
                    ->leftJoin('product_item_images', 'product_items.id', '=', 'product_item_images.iid')
                    ->join('sell_on_products', 'product_items.id', '=', 'sell_on_products.iid')
                    ->join('units','units.id','=','product_items.unit_id')
                    ->where(['products.deleted_at'=>null,'categories.deleted_at'=>null,'product_items.deleted_at'=>null,'sell_on_products.deleted_at'=>null,'product_on_categories.deleted_at'=>null])
                    ->where('products.name','like','%'.$request->name.'%')
                    ->orWhere('product_items.keywords','like','%'.$request->name.'%')
                    ->select('products.name as pName','product_images.name as pImage','products.ukey as pUkey','units.alias as piUnit','product_items.qty as piQty', 'product_item_images.name as piImge','units.alias as piUnit','product_items.ukey as piUkey','categories.ukey as cUkey','categories.name as cName','sell_on_products.msp as sopMsp')
                    ->paginate();
        // return response()->json(['status'=>'OK','jsonData'=>$products]);
         return view('front.catalog.search',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function category($category)
    {
        //
        $category = Category::where('ukey',$category)->first()->id;
        $products =   ProductOnCategory::where('product_on_categories.cid',$category)
            ->join('categories', 'product_on_categories.cid','=', 'categories.id')
            ->join('products', 'product_on_categories.pid', '=', 'products.id')
            ->leftJoin('product_images','products.id','=','product_images.pid')
            ->join('product_items', 'products.id', '=', 'product_items.pid')
            ->join('units','units.id','=','product_items.unit_id')
            ->leftJoin('product_item_images','product_item_images.iid','=','product_items.id')
            ->Join('sell_on_products', 'product_items.id', '=', 'sell_on_products.iid')
            ->where(['products.deleted_at'=>null,'product_images.deleted_at'=>null,'product_item_images.deleted_at'=>null,'units.deleted_at'=>null,'categories.deleted_at'=>null,'product_items.deleted_at'=>null,'sell_on_products.deleted_at'=>null,'product_on_categories.deleted_at'=>null])
            ->select('products.name as pName','products.ukey as pUkey','product_images.name as pImage','units.alias as piUnit', 'product_items.qty as piQty','product_items.ukey as piUkey','product_items.mrp as piMrp','sell_on_products.msp as sopMsp','categories.ukey as cUkey','categories.name as cName','product_item_images.name as piImage')
            ->paginate(20);
        $products2 =   ProductOnCategory::inRandomOrder()->first()
            ->join('categories', 'product_on_categories.cid','=', 'categories.id')
            ->join('products', 'product_on_categories.pid', '=', 'products.id')
            ->leftJoin('product_images','products.id','=','product_images.pid')
            ->join('product_items', 'products.id', '=', 'product_items.pid')
            ->join('units','units.id','=','product_items.unit_id')
            ->leftJoin('product_item_images','product_item_images.iid','=','product_items.id')
            ->join('sell_on_products', 'product_items.id', '=', 'sell_on_products.iid')
            ->where(['products.deleted_at'=>null,'categories.deleted_at'=>null,'product_items.deleted_at'=>null,'sell_on_products.deleted_at'=>null,'product_on_categories.deleted_at'=>null])

            ->select('products.name as pName','products.ukey as pUkey','product_images.name as pImage', 'product_items.qty as piQty','units.alias as piUnit','product_items.ukey as piUkey','product_items.mrp as piMrp','sell_on_products.msp as sopMsp','categories.ukey as cUkey','categories.name as cName','product_item_images.name as piImage')
            ->paginate(20);
        return view('front.product.category',compact('products','products2'));
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
    public function productOfTheMonth($producName, $category, $ukey){
        $product = Product::where('ukey',$ukey)->firstOrFail();
        return view('front.product.special',compact('producName','category','product','ukey'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // dd(Session::get('cart'));
        // dd($request);
        $category = Category::where('ukey',$request->cid)->first();
        if(!$category){
            return redirect()->route('front.home')->with(['class'=>'error','message'=>'category not found or removed']);
        }
        
        $product = Product::where('ukey',$request->pid)->first();
        if(!$product){
            return redirect()->route('front.home')->with(['class'=>'error','message'=>'product not found or removed']);
        }
        $productItem = ProductItem::where('ukey',$request->iid)->first();
        
        if (!$productItem) {
            $productItem = ProductItem::where('pid',$product->id)->first();
            if(!$productItem){
                return redirect()->route('front.home')->with(['class'=>'error','message'=>'product item not found or removed']);
            }
            return redirect()->route('front.product.details',[$product->name,$category->name,$category->ukey,$productItem->ukey,$product->ukey]);
        }
        $sellOnProduct = SellOnProduct::where('iid',$productItem->id)->first();
        $reletedPrds =  ProductOnCategory::where('cid',$category->id)
            ->join('categories', 'product_on_categories.cid','=', 'categories.id')
            ->join('products', 'product_on_categories.pid', '=', 'products.id')
            ->leftJoin('product_images','products.id','=','product_images.pid')
            ->join('product_items', 'products.id', '=', 'product_items.pid')
            ->leftJoin('product_item_images','product_item_images.iid','=','product_items.id')
            ->join('units','units.id','=','product_items.unit_id')
            ->join('sell_on_products', 'product_items.id', '=', 'sell_on_products.iid')
            ->where(['products.deleted_at'=>null,'categories.deleted_at'=>null,'product_items.deleted_at'=>null,'sell_on_products.deleted_at'=>null,'product_on_categories.deleted_at'=>null])

            ->select('products.name as pName','products.ukey as pUkey','product_images.name as pImage', 'product_items.qty as piQty','units.alias as piUnit','product_items.ukey as piUkey','product_items.mrp as piMrp','sell_on_products.msp as sopMsp','categories.ukey as cUkey','categories.name as cName','product_item_images.name as piImage')
            ->get();
        return view('front.product.details',compact('category','product','productItem','sellOnProduct','reletedPrds'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
    public function medicine()
    {
        //ec
        return redirect()->route('front.home')->with(['message'=>'Our excutive will contact you soon.', 'class'=>'success']);
    }
    public function medicinePost(Request $request)
    {
        //
        $Medicine = Medicine::create([
            'user_id' => Auth::guard('user')->user()->id
            ]);
        if($Medicine){
            return redirect()->back()->with(['message'=>'Request sent successfully. Our excutive will contact you soon ...','class'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Whoops Look like something went wrong.','class'=>'danger']);
    }
}
