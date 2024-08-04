<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Image;
class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home($image)
    {
        //
        return Storage::disk('public')->get('image/product/'.$image);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product($width,$height,$quality,$image)
    {
        //
        $img = Image::make($this->home($image));
         $img->fit($width, $height, function ($constraint) {
            $constraint->upsize();
            $constraint->aspectRatio();

        });
        return $img->response('jpg', $quality);
         //   return $img = Image::cache(function($img2) use ($width, $height,$image,$quality) {
        //     $img2->make('image/product/'.$image)->fit($width, $height, function ($constraint) {
        //         $constraint->upsize();
        //         $constraint->aspectRatio();

        //     })->encode('jpg',$quality);
        // });
    }
    public function productResize($width,$height,$quality,$image)
    {
        //
        $img = Image::make('image/product'.$image);
         $img->resize($width, $height, function ($constraint) {
            $constraint->upsize();
            $constraint->aspectRatio();

        });
        return $img->response('jpg', $quality);
    }
    public function productOriginal($quality,$image)
    {
        //
        $img = Image::make('image/product'.$image);
    
        return $img->response('jpg', $quality);
    }

    public function productOutofStock($width,$height,$quality,$image)
    {
        //
        $img = Image::make('image/product'.$image);
        return $img->fit($width, $height, function ($constraint) {
            $constraint->upsize();
            $constraint->aspectRatio();

        })->colorize(20, 20, 20)->greyscale()->contrast(10)->response('jpg', $quality);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
