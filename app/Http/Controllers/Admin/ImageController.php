<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
class ImageController extends Controller
{
    //
    public function profile($image)
    {
    	if(Storage::disk('admin')->has('profile/'.$image)){
    		return Storage::disk('admin')->get('profile/'.$image);
    	}
    }
  
}
