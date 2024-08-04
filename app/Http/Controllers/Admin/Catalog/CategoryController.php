<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Model\Catalog\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::where('type','0')->orderBy('position','asc')->get();
        return view('admin.catalog.category.form',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMenu(){
        $categories = Category::where(['type'=>'0'])->orderBy('position','asc')->get();
        foreach ($categories as $cat2) {
            $cat[]=['id'=>$cat2->id,'text'=>$cat2->name,'a_attr'=>['href'=>route('admin.category.select',$cat2->ukey)],'parent'=>($cat2->parent)?$cat2->parent:'#'];
        }
      
        return response()->json($cat);
    }
    public function create($data)
    {
        //
        // $this->validate($data,[
        //         'name'=>'required|max:191',
        // ]);
        // return Category::create([
        //     'name' -> $data->name,
        //     'title' -> $data->title,
        //     'image' -> $data->image,
        //     'keywords' -> $data->keywords,
        //     'description' -> $data->description,
        //     'status' -> $data->status,
        // ]);
    }
    public function select($category){
        $category = Category::where('ukey',$category)->firstOrfail();
        return view('admin.catalog.category.form',compact('category'));
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
            'name'=>'required|max:191|unique:categories',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->title = $request->title;
        $category->keywords = $request->keywords;
        $category->description = $request->description;
        $category->ukey = str_random(15);
        $category->parent = $request->parent;
        $category->status = $request->status;
          
        if($category->save()){
            return response()->json(['status'=>'OK','message'=>'Category Created successfully.']);
        }
        return response()->json(['status'=>'error','message'=>'There was an problem to creating category.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Product\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }
    public function arrange(Request $request)
    {
        //
        $category = Category::find($request->id);
        $category->parent = ($request->parent == '#')?null:$request->parent;
        $category->position = $request->position;
        $category->save();
        // $allCate = Category::count()-1;

        // $cat3 = Category::where('position',$request->position)->first()->id;
        // $cat2 = Category::count()-$cat3;
        // for($i=$cat3; $i<=$cat2; $i++){
        //     $cat4 = Category::find($i);
        //     $data[]= ['sn'=>$i,'name'=>$cat4->name,'id'=>$cat4->id];
        // }
        
        //     return $datas;

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Product\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($ukey)
    {
        //
        $catEdit = Category::where('ukey',$ukey)->firstOrFail();
        return view('admin.catalog.category.form',compact('catEdit'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Product\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        $category->name = $request->name;
        $category->title = $request->title;
        $category->keywords = $request->keywords;
        $category->description = $request->description;
        $category->status = $request->status;
        if($category->save()){
            return response()->json(['status'=>'OK','message'=>'Category updated']);
        }
        return response()->json(['status'=>'error','message'=>'There was an problem to updating category.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Product\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
