<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Model\Catalog\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpecialCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::where('type','!=','0')->get();
        return view('admin.catalog.specialcategory.form',compact('categories'));
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
        $this->validate($request,[
            'name'=>'required|max:191',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->title = $request->title;
        $category->keywords = $request->keywords;
        $category->description = $request->description;
        $category->ukey = str_random(50);
        $category->status = $request->status;
          
        if($category->save()){
            return redirect()->back()->with(['status'=>'OK','message'=>'Special Category Created successfully.']);
        }
        return response()->back()->with(['status'=>'error','message'=>'There was an problem to creating category.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SpecialCategory  $specialCategory
     * @return \Illuminate\Http\Response
     */
    public function show(Category $specialCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SpecialCategory  $specialCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($ukey)
    {
        $specialCategory = Category::where('ukey',$ukey)->first();
        return view('admin.catalog.specialcategory.edit',compact('specialCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SpecialCategory  $specialCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request,[
            'name'=>'required|max:191',
        ]);
        $category->name = $request->name;
        $category->title = $request->title;
        $category->keywords = $request->keywords;
        $category->description = $request->description;
        $category->status = $request->name;
        $category->status = $request->status;
        $category->name = $request->name;
        $category->type = $request->type;
        if ($category->save()) {
            return redirect()->back()->with(['class'=>'success','message'=>'Category updated successfully ...']);
        }
        return redirect()->back()->with(['class'=>'success','message'=>'Category updated successfully ...']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SpecialCategory  $specialCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $specialCategory)
    {
        //
    }
}
