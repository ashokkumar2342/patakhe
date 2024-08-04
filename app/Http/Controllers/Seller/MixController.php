<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
class MixController extends Controller
{
   public function profile($path)
   {
    return  $file = Storage::disk('seller')->get($path); 
        return response($file, 200)->header('Content-Type', 'image/jpeg');
   }
   public function image1($path,$image)
   {
     return 'hello.jpg';
   }
}
