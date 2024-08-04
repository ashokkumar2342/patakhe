@extends('seller.layout.master')
@section('content')
<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <img src="{{ route('front.product.image.get',['150','150','70',($productItem->image->first())?$productItem->image->first()->name: 'blank.jpg']) }}">
               
            </div>
            <div class="col-md-8">
                <div class="col-md-8">
                    <table class="">
                        <tr><th>Product name </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ $product->name }} ({{ $productItem->qty }} {{$productItem->unit->name}})</td></tr>
                        <tr><th>Category  </th><td> &nbsp;&nbsp; : &nbsp;&nbsp;  @foreach($product->productOnCategory as $category) {{  App\Model\Catalog\Category::find($category->cid)->name }} @endforeach</td></tr>
                        <tr><th>In Weight </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ ($product->weight == 1)?'Yes':'No' }}</td></tr>
                        <tr><th>Sale Unit </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ $productItem->saleUnit->name }}</td></tr>
                        <tr><th>Mrp </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ ($productItem->mrp)?'<i class="fa fa-inr"></i>'.$productItem->mrp:'' }}</td></tr>
                        <tr><th>Description </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ $productItem->description }}</td></tr>
                        <tr><th>Keywords </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ $productItem->keywords }}</td></tr>
                    </table>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-info btn-sm" href="{{ route('seller.product.edit',$product->ukey) }}">Edit</a>
                    <a class="btn btn-warning btn-sm" href="{{ route('seller.product.view',[$product->ukey]) }}" >Create New Product Type</a>                    
                </div>
            </div>
        </div>
    </div>
    <br>
        <div class="row">
            <div class="panel panel-default col-md-12 ">
                <div class="panel-body" style="border:1px solid #ccc">
                {!! Form::open(['route'=>['seller.product.item.update',$product->ukey,$productItem->ukey]]) !!}
                     {!! Form::hidden('referr', route('seller.product.view',[$product->ukey]), []) !!}
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="qty/weight">Qty/Weight</label>
                            {!! Form::number('qty', $productItem->qty, ['class'=>'form-control','placeholder'=>'Qty/Weight']) !!}
                            <label class="text-danger">{{ $errors->first('qty') }}</label>
                        </div>
                         <div class="form-group col-md-3">
                            {!! Form::label('unit', 'Product In Unit', ['class'=>'control-label']) !!}
                            <select class="form-control select2" placeholder="Select unit" name="unit">
                                <option></option>
                                @foreach (App\Model\Catalog\Unit::where(['status'=>1,'weight'=>$product->weight])->get() as $unit)
                                    <option  @if(old('unit') == $unit->id)
                                        selected 
                                        @elseif($productItem->unit_id == $unit->id)
                                        selected
                                        @endif value="{{ $unit->id }}">{{ $unit->name }} ({{ $unit->alias }})</option>
                                @endforeach
                            </select>
                            <label class="text-danger">{{ $errors->first('unit') }}</label>
                        </div>   
                        <div class="form-group col-md-3">
                            {!! Form::label('product_price', 'Product Price(MRP)', ['class'=>'control-label']) !!}
                            {!! Form::number('product_price',$productItem->mrp, ['class'=>'form-control','placeholder'=>'Product price (mrp)']) !!}
                           
                            <label class="text-danger">{{ $errors->first('product_price') }}</label>
                        </div>
                        <div class="form-group col-md-3">
                            {!! Form::label('selling_unit_type', 'Selling Unit Type', ['class'=>'control-label']) !!}
                              <select class="form-control select2" placeholder="Select unit" name="sale_unit">
                                <option></option>
                                @foreach (App\Model\Catalog\Unit::where(['status'=>1])->get() as $sale_unit)
                                    <option  
                                        @if(old('sale_unit') == $sale_unit->id)
                                        selected 
                                        @elseif($productItem->sale_unit_id == $sale_unit->id)
                                        selected
                                        @endif value="{{ $sale_unit->id }}">{{ $sale_unit->name }} ({{ $sale_unit->alias }})</option>
                                @endforeach
                            </select>
                            <label class="text-danger">{{ $errors->first('sale_unit') }}</label>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            {!! Form::label('keywords', 'Keywords', ['class'=>'control-label']) !!}
                            {!! Form::textarea('keywords',$productItem->keywords, ['class'=>'form-control','style'=>'resize:none','rows'=>'5','placeholder'=>'Product item keywords']) !!}
                           
                            <label class="text-danger">{{ $errors->first('keywords') }}</label>
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('description', 'Description', ['class'=>'control-label']) !!}
                            {!! Form::textarea('description',$productItem->description, ['class'=>'form-control','style'=>'resize:none','rows'=>'5','placeholder'=>'Product item description']) !!}
                           
                            <label class="text-danger">{{ $errors->first('description') }}</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" >Update</button>
                 {!! Form::close() !!}
            </div>
        </div>       
    </div>
    <br>
    <div class="row">
        <div class="col-sm-12">
            {!! Form::open(['route'=>['seller.product.item.image.upload',$product->ukey,$productItem->ukey],'files'=>true]) !!}
                    <div class="col-md-2">{!! Form::file('image', []) !!}</div>
                    <div class="col-md-2"><button class="btn btn-primary btn-sm pull-right">Upload</button></div> 
                    <p class="text-danger">{{ $errors->first('image') }}</p>                   
            {!! Form::close() !!}
        
        </div>
    </div>
    <br>
    <hr>
    <br>
    <div class="row">
        @foreach ($productItemImages as $productItemImage)
           <img style="margin: 10px" src="{{ route('front.product.image.get',['200','200','90',$productItemImage->name]) }}">
        @endforeach
        
    </div>
    </div>
@endsection
@push('scripts')
    <!--select2-->
    <script src="{{ asset('js/select2.js') }}"></script>
    <script type="text/javascript">
        $('.select2').select2();
    </script>
@endpush
@push('links')
    <link href="{{asset ('css/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2-bootstrap.css') }}" rel="stylesheet">
@endpush