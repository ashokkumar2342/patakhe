@extends('seller.layout.master')
@section('content')
<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4"><img src="{{ route('front.product.image.get',['250','250','70',($product->image->first())?$product->image->first()->name : 'blank.jpg']) }}"></div>
            <div class="col-md-8">
                <div class="col-md-8">
                    <table class="">
                        <tr><th>Category  </th><td> &nbsp;&nbsp; : &nbsp;&nbsp;  @foreach($product->productOnCategory as $category) {{  App\Model\Catalog\Category::find($category->cid)->name }} @endforeach</td></tr>
                        <tr><th>In Weight </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ ($product->weight == 1)?'Yes':'No' }}</td></tr>
                        <tr><th>Description </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ $product->description }}</td></tr>
                        <tr><th>Keywords </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ $product->keywords }}</td></tr>
                    </table>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-warning btn-sm" href="{{ route('seller.product.view',[$product->ukey]) }}" >Sale in this category</a>
                    
                </div>
            </div>
        </div>
    </div>
    <br>
        <div class="row">
            <div class="panel panel-default col-md-12 ">
                <div class="panel-body">
                {!! Form::open(['route'=>['seller.product.item.sale',$product->ukey,$productItem->ukey]]) !!}
                     {!! Form::hidden('referr', route('seller.product.item.view',[$product->ukey,$productItem->ukey]), []) !!}
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="selling_price">Selling Price</label>
                            {!! Form::number('selling_price', '', ['class'=>'form-control','placeholder'=>'Selling price']) !!}
                            <label class="text-danger">{{ $errors->first('selling_price') }}</label>
                        </div>
                         <div class="form-group col-md-3">
                            {!! Form::label('stock', 'Stock', ['class'=>'control-label']) !!}
                            {!! Form::number('stock', '', ['class'=>'form-control']) !!}
                            <label class="text-danger">{{ $errors->first('stock') }}</label>
                        </div>   
                        <div class="form-group col-md-3">
                            {!! Form::label('price_expire', 'Price Expire', ['class'=>'control-label']) !!}
                            <div class="input-group date form_datetime-component">
                                <input type="text" class="form-control" readonly="" size="16">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary date-set"><i class="fa fa-calendar"></i></button>
                                </span>
                            </div>
                           
                            <label class="text-danger">{{ $errors->first('price_expire') }}</label>
                        </div>
                      
                        
                    </div>
                   
                    <button type="submit" class="btn btn-primary" >Sale</button>
                 {!! Form::close() !!}
            </div>
        </div>
       
        </div>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading ">
                    Product Item List
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
                            <th>Product price</th>
                            <th>Selling Unit</th>
                            <th width="70px">Custom</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(App\Model\Catalog\ProductItem::where(['pid'=>$product->id,'sid'=>Auth::guard('seller')->user()->id])->get()   as $productItem)
                            <tr>
                                <td>{{ @$sn=$sn+1 }}</td>
                                <td>{{ $productItem->created_at->format('d-m-Y') }}</td>
                                <td><img src="{{ route('front.product.image.get',['50','50','80',($productItem->image->first())?$productItem->image->first()->name : $product->image->first()->name]) }}"></td>
                                <td>{{ $productItem->qty }} {{ $productItem->unit->name }} ({{ $productItem->unit->alias }})</td>
                                <td>{{ $productItem->mrp }}</td>
                                <td>{{ $productItem->saleUnit->name }}</td>
                                <td>
                                    <a href="{{ route('seller.product.item.view',[$product->ukey,$productItem->ukey]) }}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>
                                    @if($productItem->sid == Auth::guard('seller')->user()->id)
                                    <a href="{{ route('seller.product.item.edit',[$product->ukey,$productItem->ukey]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('seller.product.item.delete',[$product->ukey,$productItem->ukey]) }}" onclick="return confirm('are you sure to delete this data ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                   @endif
                                   
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
    <script src="{{ asset('js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>
    <!--select2 init-->
    <script type="text/javascript">
       
        $(".form_datetime-component").datetimepicker({
            format: "dd MM yyyy - hh:ii",
            autoclose: true,
            todayBtn: true,
            pickerPosition: "bottom-left"
        });
      
    </script>
@endpush
@push('links')
    <link href="{{asset ('js/bootstrap-datetimepicker/css/datetimepicker.css') }}" rel="stylesheet">
@endpush