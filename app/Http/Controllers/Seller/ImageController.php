<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;
class ImageController extends Controller
{
    //
    public function profile($image)
    {
    	if(Storage::disk('seller')->has('profile/'.$image)){
    		return Storage::disk('seller')->get('profile/'.$image);
    	}
    	// return response(Storage::disk('vendor')->get($image), 200)->header('Content-Type', 'text/plain');
    }
    public function product(  $name, $width=null,$height=null,$quality=null)
    {
    	// $image =Image::make('image/'.$name);
    	// return $this->applyFilter($image);
    	// $image->pixelate($width);
     //    return $image->greyscale();
    	// return $name->fit(120, 90)->encode('jpg', 20);
    	 // echo "<img src='".Storage::disk('public')->get('image/'.$name)."'>";
    	// return Storage::disk('public')->get('image/'.$name);
    	 // $image  =Image::make('image/'.$name);
      //   	return $image->fit(120, 90)->encode('jpg', 20);
    	// if(Storage::disk('public')->has('products/'.$name)){
     //    	 $image  =Image::make('image/'.$name);
     //    	return $image->fit(120, 90)->encode('jpg', 20);
     //        // return Storage::disk('public')->get('products/'.$name);
     //    }

    	// echo storage_path('app\public\products\\'.$name);
    	// echo "<img src='".storage_path('app\public\products\\'.$name)."'>";
  //   	$img = Image::cache(function($image) {
		//     $image->make('public/foo.jpg')->resize(300, 200)->greyscale();
		// });
        // if(Storage::disk('public')->has('products/'.$name)){
        // 	 $image  =Image::make(storage_path('app/public/products/'.$name));
        // 	return $image->fit(120, 90)->encode('jpg', 20);
        //     // return Storage::disk('public')->get('products/'.$name);
        // }
    }
    public function applyFilter(Image $image,$size)
    {
        $image->pixelate($size);
        $image->greyscale();

        return $image;
    }
}
