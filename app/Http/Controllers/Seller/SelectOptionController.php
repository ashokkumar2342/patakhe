<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\SubCategory;
use App\ProductMenu;
class SelectOptionController extends Controller
{
    //
    public function category(ProductMenu $productMenu){
    	if ($productMenu->category->count()) {
    		return response()->json([$productMenu->category]);
    	}    	
    }
    public function subCategory(Category $category){
    	if ($category->subCategory->count()) {
    		return response()->json([$category->subCategory]);
    	}    	
    }
}
