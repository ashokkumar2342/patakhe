<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Model\Catalog\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::all();   
        return view('admin.catalog.color.form',compact('colors'));
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
        $this->validate($request,[
            'name'=>'required|max:191',
            'color'=>'required|max:191',
        ]);
        $color = new Color();
        $color->name = $request->name;
        $color->code = $request->color;
         if($color->save()){
            return redirect()->back()->with(['message'=>'Color Created successfully ...','class'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Whoops Look like something went wrong.','class'=>'error']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Catalog\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Catalog\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
        $colors = Color::all(); 
        return view('admin.catalog.color.edit',compact('colors','color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Catalog\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Color $color)
    {
        $this->validate($request,[
            'name'=>'required|max:191',
            'color'=>'required|max:191',
        ]);
        $color->name = $request->name;
        $color->code = $request->color;
         if($color->save()){
            return redirect()->route('admin.color.form')->with(['message'=>'Color updated successfully ...','class'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Whoops Look like something went wrong.','class'=>'error']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Catalog\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        
    }
}
