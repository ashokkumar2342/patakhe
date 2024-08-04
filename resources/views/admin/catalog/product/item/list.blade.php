@extends('admin.layout.master')
@push('links')
 <!--bootstrap picker-->
    <link rel="stylesheet" type="text/css" href="{{ asset('js/bootstrap-datetimepicker/css/datetimepicker.css') }}"/>
@endpush
@section('content')  
    <!--body wrapper start-->
    <div class="wrapper" style="min-height: 1000px">
        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-info">                   
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <img  src="{{ route('front.product.image.get',['230','300','100',$product->image->first()->name]) }}">
                            </div>
                            <div class="col-md-9">
                                <h2> {{ $product->name }}</h2>
                                <table class="table">
                                    <tr><th>Category  </th><td>  : </td><td> @foreach($product->productOnCategory as $category) {{  App\Model\Catalog\Category::find($category->cid)->name }} @endforeach</td></tr>
                                    <tr><th>Price </th><td>  :  </td><td> {{ $product->mrp }}</td></tr>
                                    
                                    <tr><th>Description </th><td>  :</td><td>  {{ $product->description }}</td></tr>
                                </table>
                                <table class="table responsive-data-table data-table">
                                    <thead>
                                        <tr>
                                            <th>Sn &nbsp;&nbsp;</th>
                                            <th>Seller Name</th>
                                            <th>msp</th>
                                            <th>Stock</th>
                                            <th>sku</th>
                                            <th>status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $productItem->SellOnProduct as $sellOnProduct )
                                            @php
                                                $sellers[$sellOnProduct->seller->id] = $sellOnProduct->seller->first_name;
                                            @endphp
                                            <tr>
                                                <td>{{ @$sn++ }}</td>
                                                <td>{{ $sellOnProduct->seller->first_name}}</td>
                                                <td>{{ $sellOnProduct->msp }}</td>
                                                <td> {{ $sellOnProduct->stock }}</td>
                                                <td>{{ $sellOnProduct->sku }}</td>
                                                <td> <span class="label {{ ($sellOnProduct->status == 1) ?'label-success':'label-danger'}} btn btn-xs">{{ ($sellOnProduct->status == 1)? 'Active' : 'Inactive' }}</span> </td> 
                                            </tr>
                                        @endforeach                                    
                                    </tbody>
                                </table>                                  
                            </div>                         
                        </div>                       
                    </div><!--/panel body -->
                </div><!--/panel -->
            </div>
        </div>    
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        Other Properties
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <ul class="nav nav-tabs">
                                  <li class="active"><a data-toggle="tab" href="#potm">Product Of The Month</a></li>
                            </ul>

                            <div class="tab-content">
                                  <div id="potm" class="tab-pane fade in active">
                                  <br>

                                        {!! Form::open(['route'=>['admin.product.potm.add',$product->id]]) !!}
                                            <div class="form-group clearfix">
                                            <div class="col-md-3">{!! Form::label('Seller', 'Seller', ['class'=>'control-label']) !!}</div>
                                            <div class="col-md-9">
                                                {!! Form::select('seller', $sellers,null, ['class'=>'form-control','required']) !!}
                                                 @if($errors->has('seller'))<p class="text-danger">{{ $errors->first('seller') }}</p> @endif
                                            </div>
                                        </div>
                                       
                                        <div class="form-group clearfix">
                                            <label class="control-label col-md-3">Expire date</label>
                                            <div class="col-md-9">
                                                <div class="input-group date form_datetime-component">
                                                    <input type="text" name="date" class="form-control" readonly="" required size="16">
                                                    <span class="input-group-btn">
                                                    <button type="button" class="btn btn-primary date-set"><i class="fa fa-calendar"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <div class="col-md-3">Is Active</div>
                                            <div class="col-md-9">
                                                {!! Form::select('status', ['0' => 'no', '1' => 'yes'], null, ['class' => 'form-control']) !!}
                                                @if($errors->has('status'))<p class="text-danger">{{ $errors->first('status') }}</p> @endif
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <button class="btn btn-primary pull-right">Add Product</button>
                                        </div>
                                        {!! Form::close() !!}
                                  </div>
                                  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    <!--body wrapper end-->
@endsection
@push('scripts')
<script src="{{ asset('js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/form-validation-init.js')}}" type="text/javascript"></script>
<!--bootstrap picker-->
<script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>
<!--picker initialization-->
<script src="{{ asset('js/picker-init.js')}}"></script>
@endpush