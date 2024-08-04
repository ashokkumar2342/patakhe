<?php

namespace App\Http\Controllers\Seller;

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
        $categories = Category::where(['type'=>'0'])->get();
        foreach ($categories as $cat2) {
            $cat[]=['id'=>$cat2->id,'text'=>$cat2->name,'parent'=>($cat2->parent)?$cat2->parent:'#'];
        }
        return response()->json($cat);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        //
        $category = Category::where('name', 'like', $request->value.'%')->get();
        return response()->json(['status'=>'OK','categories'=>$category]);
    }
    public function find(Request $request,Category $category)
    {        
        $categories = Category::find(explode(',', $category->childrens));
        foreach ($categories as $cat2) {
            $cat[]=['id'=>$cat2->id,'text'=>$cat2->name];
        }
        return response()->json($cat);
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
     * @param  \App\Model\Product\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Product\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
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
