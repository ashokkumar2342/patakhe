@extends('seller.layout.master')
@section('content')
<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4"><img src="{{ route('front.product.image.get',['250','250','70',($product->image->first())?$product->image->first()->name : 'blank.jpg']) }}"></div>
            <div class="col-md-8">
                <div class="col-md-8">
                     <table >
                        <tr><th>Product name </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ $product->name }} ({{ $productItem->qty }} {{$productItem->unit->name}})</td></tr>
                        <tr><th>Category  </th><td> &nbsp;&nbsp; : &nbsp;&nbsp;  @foreach($product->productOnCategory as $category) {{  App\Model\Catalog\Category::find($category->cid)->name }} @endforeach</td></tr>
                        <tr><th>In Weight </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ ($product->weight == 1)?'Yes':'No' }}</td></tr>
                        <tr><th>Mrp </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ (@$produtItem->mrp)?'<i class="fa fa-inr"></i>'.$productItem->mrp:'' }}</td></tr>
                        <tr><th>Description </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ $productItem->description }}</td></tr>
                        <tr><th>Keywords </th><td> &nbsp;&nbsp; : &nbsp;&nbsp; {{ $productItem->keywords }}</td></tr>
                    </table>
                    <hr>

                </div>
                <div class="col-md-4">
                    <a class="btn btn-warning btn-sm" href="{{ route('seller.product.item.sale',[$product->ukey,$productItem->ukey]) }}">Sale in this category</a>
                    
                </div>
            </div>
        </div>
    </div>
    <br>
        <div class=" row">
            <div class="panel panel-default col-md-12 ">
                <div class="panel-body">
                {!! Form::open(['route'=>['seller.product.item.sale.update',$product->ukey,$productItem->ukey,$saleOnProduct->ukey]]) !!}
                     {!! Form::hidden('referr', route('seller.product.item.view',[$product->ukey,$productItem->ukey]), []) !!}
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="selling_price">Selling Price <span class="text-danger">*</span></label>
                            {!! Form::number('selling_price', $saleOnProduct->msp, ['class'=>'form-control','placeholder'=>'Selling price','required']) !!}
                            <label class="text-danger">{{ $errors->first('selling_price') }}</label>
                        </div>
                         <div class="form-group col-md-3">
                            {!! Form::label('stock', 'Stock', ['class'=>'control-label','required']) !!}
                            {!! Form::number('stock', $saleOnProduct->stock, ['class'=>'form-control']) !!}
                            <label class="text-danger">{{ $errors->first('stock') }}</label>
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
            <section class="panel">
                <header class="panel-heading ">
                    Product Item sale List
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
                            <th>Selling Price (Rs)</th>
                            <th>stock</th>
                            <th>Expire Time</th>
                            <th width="70px">Custom</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(App\Model\Catalog\SellOnProduct::where(['pid'=>$product->id,'iid'=>$productItem->id,'sid'=>Auth::guard('seller')->user()->id])->get()   as $saleProductItem)
                            <tr>
                                <td>{{ @$sn=$sn+1 }}</td>
                                <td>{{ $saleProductItem->created_at->format('d-m-Y') }}</td>
                                <td>{{ $saleProductItem->msp }}</td>
                                <td>{{ $saleProductItem->stock }}</td>
                                <td>{{ ($saleProductItem->expire)?date('d-m-Y H:i:s',strtotime($saleProductItem->expire)):'' }}</td>
                                <td>
                                    
                                    <a href="{{ route('seller.product.item.sale.edit',[$product->ukey,$productItem->ukey,$saleProductItem->ukey]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('seller.product.item.sale.delete',[$product->ukey,$productItem->ukey,$saleProductItem->ukey]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                   
                                   
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
            format: "yyyy-mm-dd hh:mm:ii",
            autoclose: true,
            todayBtn: true,
            pickerPosition: "bottom-left"
        });
      
    </script>
@endpush
@push('links')
    <link href="{{asset ('js/bootstrap-datetimepicker/css/datetimepicker.css') }}" rel="stylesheet">
@endpush