<?php

namespace App\Http\Controllers\Seller;

use App\Model\Catalog\ProductOfTheMonth;
use App\Model\Catalog\Category;
use App\Model\Catalog\Product;
use App\Model\Catalog\ProductImage;
use App\Model\Catalog\SellOnProduct;
use App\Model\Catalog\ProductOnCategory;
use App\Model\Catalog\ProductItemMesurment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
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
        $ProductOfTheMonths = ProductOfTheMonth::orderBy('id','desc')->get();
        return view('seller.potm.list',compact('ProductOfTheMonths'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $mesure = array_pluck(collect(ProductItemMesurment::select('id','name')->get()->toArray()),'name', 'id');
         $categories = Category::where(['type'=>'1','label'=>1])->orderBy('position','asc')->get();
        return view('seller.potm.add',compact('categories','mesure'));
    }
    public function status(ProductOfTheMonth $productOfTheMonth)
    {
        $data = ($productOfTheMonth->status == 1)?['status' => 0, 'addClass' => 'btn-danger', 'removeClass' => 'btn-success','message'=>'Product deactivated ...', 'text' => 'Inactive', ]:['status' => 1, 'addClass' => 'btn-success', 'removeClass' => 'btn-danger', 'message'=>'Product activated ...', 'text' => 'Active', ]; 
        $productOfTheMonth->status = $data['status'];
        if($productOfTheMonth->save()){
            return response()->json(['status'=>'OK','message'=>$data['message'],'btn'=>['addClass'=>$data['addClass'],'removeClass'=>$data['removeClass'],'text'=>$data['text']]]);
        }
        else{
            return response()->json(['status'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
        }
        // $categories = Category::where('type','1')->get();
        // return view('seller.potm.add',compact('categories'));
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
        // dd($request);
         $this->validate($request,[
            'name' => 'required|max:255',
            'product_price' => 'required|numeric',
            'catId' => 'required',
            'image' => 'required|image|mimes:jpeg,png|between:10,500',
            'status' => 'required|numeric',
            'expire' => 'required'
        ]);
        $filename = str_slug($request->name.' '.strtolower(str_random(5)),'_').'.'.$request->file('image')->getClientOriginalExtension();
        $request->image->storeAs('image',$filename,'public');
       
        // product main data
        $product = new Product();
        $product->ukey = str_random(12);
        $product->sid = Auth::guard('seller')->user()->id;       
        $product->name = $request->name;
        $product->mrp = $request->product_price;
        $product->keywords = $request->keywords;
        $product->description = $request->description;
        $product->status = 1;
        $product->mesure = $request->mesure;
        $product->save();

        // upload and save product image
        $priductImage = new ProductImage();
        $priductImage->pid = $product->id;
        $priductImage->name = $filename;
        $priductImage->sid = Auth::guard('seller')->user()->id;
        $priductImage->status = 1;
        $priductImage->save();

        // After product entry auto sell on this product
        $SellOnProduct = new SellOnProduct();
        $SellOnProduct->pid = $product->id;
        $SellOnProduct->sku = $request->sku;
        $SellOnProduct->msp = $request->seller_price;
        $SellOnProduct->stock = $request->stock;
        $SellOnProduct->status = $request->status;
        $SellOnProduct->sid = Auth::guard('seller')->user()->id;
        $SellOnProduct->position = 1;
        $SellOnProduct->save();
        
        foreach (explode(",", $request->catId) as $key => $value) {
            $productOnCategory = new ProductOnCategory();
            $productOnCategory->pid = $product->id;
            $productOnCategory->cid = $value;
            $productOnCategory->sid = Auth::guard('seller')->user()->id;
            $productOnCategory->status = $request->status;
            $productOnCategory->save();
        }
         $datetime = date('Y-m-d h:i:s',strtotime($request->expire));
         $ProductOfTheMonth = new ProductOfTheMonth();
         $ProductOfTheMonth->sop_id  = $SellOnProduct->id;
         $ProductOfTheMonth->sid  = Auth::guard('seller')->user()->id;
         $ProductOfTheMonth->expire  = $datetime;
         $ProductOfTheMonth->save();
          
        return redirect()->back()->with(['message'=>'Task done ...', 'class'=>'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\model\Catalog\ProductOfTheMonth  $productOfTheMonth
     * @return \Illuminate\Http\Response
     */
    public function show(ProductOfTheMonth $productOfTheMonth)
    {
        //
        // dd($productOfTheMonth);
        return view('seller.potm.view',compact('productOfTheMonth'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\model\Catalog\ProductOfTheMonth  $productOfTheMonth
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
     * @param  \App\model\Catalog\ProductOfTheMonth  $productOfTheMonth
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductOfTheMonth $productOfTheMonth)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\model\Catalog\ProductOfTheMonth  $productOfTheMonth
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductOfTheMonth $productOfTheMonth)
    {
        //
    }
}
