@extends('seller.layout.master')
@section('content')
<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4"><img src="{{ route('front.product.image.get',['250','250','70',$product->image->first()->name]) }}"></div>
            <div class="col-md-8">
                <div class="col-md-10">
                    <table class="">
                        <tr><th>Category  </th><td> &nbsp;&nbsp; : &nbsp;&nbsp;  @foreach($product->productOnCategory as $category) {{  App\model\Catalog\Category::find($category->cid)->name }} @endforeach</td></tr>
                        <tr><th>Price </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ $product->mrp }}</td></tr>
                        <tr><th>In Weight </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ ($product->weight == 1)?'Yes':'No' }}</td></tr>
                        <tr><th>Description </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ $product->description }}</td></tr>
                        <tr><th>Keywords </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ $product->keywords }}</td></tr>
                    </table>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="collapse" data-target="#createColor">Sell in this category</button>
                </div>
            </div>
        </div>
    </div>
    <br>
        <div class="row">
            <div class="panel panel-default col-md-8 col-md-offset-2 ">
                <div class="panel-body">
                {!! Form::open(['route'=>['seller.product.item.update',$product->ukey,$productItem->ukey]]) !!}
                     <div class="form-group clearfix">
                        {!! Form::label('color', 'Color', ['class'=>'control-label','id'=>'e4']) !!}
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" {{ ($productItem->colors->count())?'checked':'' }} name="colorAvi">
                            {{ print_r(array_pluck($productItem->colors->toArray(),'cid')) }} 
                            <select id="multiple" name="colors[]" class="hidden form-control select2-multiple" placeholder="Select multiple color" multiple>
                                <option></option>

                                @foreach (App\Model\Catalog\Color::where('status',1)->get() as $color)
                                    <option color="{{ $color->code }}" value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </select>
                        <div class="text-danger">{{ $errors->first('color') }}</div>                        
                    </div>
                   
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="qty/weight">Qty/Weight</label>
                            {!! Form::number('qty', $productItem->qty, ['class'=>'form-control','placeholder'=>'Qty/Weight']) !!}
                            <label class="text-danger">{{ $errors->first('qty') }}</label>
                        </div>
                         <div class="form-group col-md-6">
                            {!! Form::label('unit', 'Unit', ['class'=>'control-label']) !!}
                            <select class="form-control select2" placeholder="Select unit" name="unit">
                                <option></option>
                                @foreach (App\Model\Catalog\Unit::where(['status'=>1,'weight'=>$product->weight])->get() as $unit)
                                    <option 
                                         @if(old('unit') == $unit->id)
                                        selected 
                                        @elseif($productItem->unit_id == $unit->id)
                                        selected
                                        @endif
                                        value="{{ $unit->id }}">{{ $unit->name }} ({{ $unit->alias }})</option>
                                @endforeach
                            </select>
                            <label class="text-danger">{{ $errors->first('unit') }}</label>
                        </div>   
                        <div class="form-group col-md-6">
                            {!! Form::label('msp', 'Selling price (msp)', ['class'=>'control-label']) !!}
                            <input class="form-control" placeholder="Selling price" name="msp" type="text" value={{ (old('msp')?old('msp'):$productItem->msp) }} id="msp">
                            <label class="text-danger">{{ $errors->first('msp') }}</label>
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('stock', 'Stock', ['class'=>'control-label']) !!}
                            {!! Form::number('stock', $productItem->stock, ['placeholder'=>"Item in stock",'class'=>'form-control']) !!}
                            <label class="text-danger">{{ $errors->first('stock') }}</label>
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('selling_unit_type', 'Selling Unit Type', ['class'=>'control-label']) !!}
                              <select class="form-control select2" placeholder="Select unit" name="sale_unit">
                                <option></option>
                                @foreach (App\Model\Catalog\Unit::where(['status'=>1])->get() as $sale_unit)
                                    <option 
                                         @if(old('sale_unit') == $sale_unit->id)
                                        selected 
                                        @elseif($productItem->sale_unit_id == $sale_unit->id)
                                        selected
                                        @endif
                                        value="{{ $sale_unit->id }}">{{ $sale_unit->name }}</option>
                                @endforeach
                            </select>
                            <label class="text-danger">{{ $errors->first('sale_unit') }}</label>
                        </div>
                        
                    </div>
                    <button type="submit" class="btn btn-primary" >Create</button>
                 {!! Form::close() !!}
            </div>
        </div>
       
        </div>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading ">
                    Product List
                    <span class="tools pull-right">
                        <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                        <a class="t-close fa fa-times" href="javascript:;"></a>
                    </span>
                </header>
                <table class="table responsive-data-table data-table">
                    <thead>
                        <tr>
                            <th width="30px">Sn</th>
                            <th width="80">Date</th>
                            <th width="60">Image</th>
                            <th>Qty</th>
                            <th>Sell price</th>
                            <th>Sell Unit</th>
                            <th width="70px">Custom</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(App\Model\Catalog\ProductItem::where(['pid'=>$product->id,'sid'=>Auth::guard('seller')->user()->id])->get()   as $productItem)
                            <tr>
                                <td>{{ @$sn=$sn+1 }}</td>
                                <td>{{ $productItem->created_at->format('d-m-Y') }}</td>
                                <td><img src="{{ route('front.product.image.get',['50','50','80',($productItem->image->first())?$productItem->image->first()->name : $product->image->first()->name]) }}"></td>
                                <td>{{ $productItem->qty }} {{ $productItem->unit->name }}</td>
                                <td>{{ $productItem->msp }}</td>
                                <td>{{ $productItem->saleUnit->name }}</td>
                                <td>
                                    <a href="{{ route('seller.product.item.view',[$product->ukey,$productItem->ukey]) }}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('seller.product.item.edit',[$product->ukey,$productItem->ukey]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('seller.product.item.delete',[$product->ukey,$productItem->ukey]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                   
                                    {{-- <a href="{{ route('seller.product.edit',[$product->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a> --}}
                                </td>
                               
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </div>
    </div>
    </div>
@endsection
@push('scripts')
    <!--select2-->
    <script src="{{ asset('js/select2.js') }}"></script>
    <!--select2 init-->
    <script type="text/javascript">
        function format(color) {
            if (!color.id) return color.text; // optgroup
            return "<span style='background:"+$(color.element).attr('color')+"; padding:0px 9px; margin:5px;'></span>"+color.text;
        }
        $('.select2-multiple').select2({
            formatResult: format,
            formatSelection: format,
            escapeMarkup: function(m) {
                return m;
            }
        });
        $('.select2').select2();
      
    </script>
    <script type="text/javascript">
    $('input[name="colorAvi"]').on('click',function() {
        if($(this).is(':checked')) {
            $('#multiple').removeClass('hidden')
        } else {
            $('#multiple').addClass('hidden')
        }
    });

       
    </script>
@endpush
@push('links')
    <link href="{{asset ('css/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2-bootstrap.css') }}" rel="stylesheet">
@endpush