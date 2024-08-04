<?php

namespace App\Http\Controllers\Seller;

use App\Model\Catalog\Product;
use App\Model\Catalog\ProductImage;
use App\Model\Catalog\ProductOnCategory;
use App\Model\Catalog\SellOnProduct;
use App\Model\Catalog\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Catalog\Unit;
use Auth;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $products = Product::all();

        return view('seller.product.list', compact('products'));
        
    }
    public function image(Request $request)
    {
        Storage::disk('public')->put('products/',  $request->file);
    }
    public function getImage($name)
    {
        if(Storage::disk('public')->has('products/thumbnail/'.$name)){
            return Storage::disk('public')->get('products/thumbnail/'.$name);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function status(Product $product){
        $data = ($product->status == 1)?['status' => 0, 'addClass' => 'btn-danger', 'removeClass' => 'btn-success','message'=>'Product deactivated ...', 'text' => 'Inactive', ]:['status' => 1, 'addClass' => 'btn-success', 'removeClass' => 'btn-danger', 'message'=>'Product activated ...', 'text' => 'Active', ]; 
        $product->status = $data['status'];
        if($product->save()){
            return response()->json(['status'=>'OK','message'=>$data['message'],'btn'=>['addClass'=>$data['addClass'],'removeClass'=>$data['removeClass'],'text'=>$data['text']]]);
        }
        else{
            return response()->json(['status'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
        }
    }
  
    public function create()
    {
        //
        $categories = Category::where(['type'=>'0','label'=>1,'status'=>1])->orderBy('position','asc')->get();
        $mesure = array_pluck(collect(Unit::select('id','name')->get()->toArray()),'name', 'id');
        return view('seller.product.add',compact('categories','mesure'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
            // 'seller_price' => 'nullable|numeric',
            'catId' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png|between:10,1024|dimensions:width=917,height=1000',
            'status' => 'required|numeric',
        ]);
        $filename = str_slug($request->name.' '.strtolower(str_random(5)),'_').'.'.$request->file('image')->getClientOriginalExtension();
        $request->image->storeAs('image/product',$filename,'public');
       
        // product main data
        $product = new Product();
        $product->ukey = str_random(12);
        $product->sid = Auth::guard('seller')->user()->id;       
        $product->name = $request->name;
        $product->status = $request->status;
        $product->weight = $request->weight;
        $product->keywords = $request->keywords;
        $product->description = $request->description;
        $product->save();

        // upload and save product image
        $priductImage = new ProductImage();
        $priductImage->pid = $product->id;
        $priductImage->name = $filename;
        $priductImage->sid = Auth::guard('seller')->user()->id;
        $priductImage->status = 1;
        $priductImage->save();
        
        foreach (explode(",", $request->catId) as $key => $value) {
            $productOnCategory = new ProductOnCategory();
            $productOnCategory->pid = $product->id;
            $productOnCategory->cid = $value;
            $productOnCategory->sid = Auth::guard('seller')->user()->id;
            $productOnCategory->status = $request->status;
            $productOnCategory->save();
        }
         
        return redirect()->route('seller.product.view',$product->ukey)->with(['message'=>'Product Created now you can sell ...', 'class'=>'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
        $product = Product::where('ukey',$product)->firstOrfail();
        return view('seller.product.view',compact('product'));
    }
    public function sell(Product $product)
    {
        //
        return view('seller.product.sellform',compact('product'));
    }

    public function sellOnProduct(Request $request, Product $product)
    {
        $this->validate($request,[
            'price'=>'required|numeric',
            'stock' => 'required|numeric'
        ]);
       // After product entry auto sell on this product
        $SellOnProduct = new SellOnProduct();
        $SellOnProduct->pid = $product->id;
        $SellOnProduct->sku = $request->sku;
        $SellOnProduct->msp = $request->price;
        $SellOnProduct->stock = $request->stock;
        $SellOnProduct->sid = Auth::guard('seller')->user()->id;
        $SellOnProduct->save();
         if($SellOnProduct->id){
            return redirect()->back()->with(['message'=>'Product sell successfully ...','class'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Whoops Look like something went wrong.','class'=>'error']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        $product = Product::where(['ukey'=>$product,'sid'=>Auth::guard('seller')->user()->id])->firstOrfail();
        $categories = Category::where(['type'=>'0','label'=>1,'status'=>1])->orderBy('position','asc')->get();
        $mesure = array_pluck(collect(Unit::select('id','name')->get()->toArray()),'name', 'id');
        return view('seller.product.edit',compact('product','mesure','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product)
    {
        $product = Product::where(['ukey'=>$product,'sid'=>Auth::guard('seller')->user()->id])->firstOrfail();
        $this->validate($request,[
            'name' => 'required|max:255',
            'weight' => 'required|digits_between:0,1',
            'image' => 'nullable|image|mimes:jpeg,png|between:10,1024|dimensions:width=917,height=1000',
            'status' => 'required|digits_between:0,1',
        ]);
        if ($request->file('image')) {
            $filename = str_slug($request->name.' '.strtolower(str_random(5)),'_').'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->storeAs('image/product',$filename,'public');
        }
        
       
        // product main data     
        $product->name = $request->name;
        $product->keywords = $request->keywords;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->weight = $request->weight;
        $product->keywords = $request->keywords;
        $product->description = $request->description;
        $product->save();
        if ($request->file('image')) {
            // upload and save product image
            $priductImage = ProductImage::firstOrNew(['pid'=>$product->id]);
            if(@!$filename){
                $filename = $priductImage->name;
            }
            
            $priductImage->pid = $product->id;
            $priductImage->name = $filename;
        
        $priductImage->sid = Auth::guard('seller')->user()->id;
        
            
            $priductImage->status = 1;
            $priductImage->save();        
            @unlink(public_path('image/product/'.$oldfileName));
        }
        
         
        return redirect()->route('seller.product.list')->with(['message'=>'Product updated ...', 'class'=>'success']);
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
        $product->delete();
        ProductImage::where('pid',$product->id)->delete();
        ProductOnCategory::where('pid',$product->id)->delete();
        SellOnProduct::where('pid',$product->id)->delete();
        return response()->json(['status'=>'OK','message'=>'product deleted success...']);
    }
}
