<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Model\Catalog\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $units = Unit::all();
        $editData = ($request->id)?Unit::findorFail($request->id):null;

        return view('admin.catalog.unit.form',compact('units','editData'));
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
            'unit'=>'required|max:191',
            'weight'=>'required|digits:1|digits_between:0,1',
        ]);
        $unit = new Unit();
        $unit->name = $request->name;
        $unit->alias = $request->unit;
        $unit->weight = $request->weight;
        $unit->calculation = $request->calculation;
        if($unit->save()){
            return redirect()->back()->with(['message'=>'Unit Created successfully ...','class'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Whoops Look like something went wrong.','class'=>'error']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Catalog\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Catalog\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Catalog\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        $this->validate($request,[
            'name'=>'required|max:191',
            'unit'=>'required|max:191',
            'weight'=>'required|digits:1|digits_between:0,1',
        ]);
        $unit->name = $request->name;
        $unit->alias = $request->unit;
        $unit->weight = $request->weight;
        $unit->calculation = $request->calculation;
        if($unit->save()){
            return redirect()->route('admin.unit.form')->with(['message'=>'Unit Updated successfully ...','class'=>'success']);
        }
        return redirect()->back()->with(['message'=>'Whoops Look like something went wrong.','class'=>'error']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Catalog\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        //
    }
}
