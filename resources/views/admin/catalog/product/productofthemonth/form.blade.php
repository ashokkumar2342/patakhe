@extends('admin.layout.master')
@push('links')
 <!--bootstrap picker-->
    <link rel="stylesheet" type="text/css" href="{{ asset('js/bootstrap-datetimepicker/css/datetimepicker.css') }}"/>
@endpush
@section('content')  
    <!--body wrapper start-->
    <div class="wrapper" style="min-height: 1000px">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ $product->name }}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            {!! Form::open(['route'=>['admin.productofthemonth.create.post',$product->id],'class'=>'validate cmxform','method'=>'put'])!!}
                           
                            
                            <div class="form-group clearfix">
                                <div class="col-md-3">{!! Form::label('seller_price', 'Seller Price', ['class'=>'control-label']) !!}</div>
                                <div class="col-md-9">
                                    {!! Form::number('seller_price', '', ['class'=>'form-control','required']) !!}
                                     @if($errors->has('seller_price'))<p class="text-danger">{{ $errors->first('seller_price') }}</p> @endif
                                </div>
                               
                            </div>
                            <div class="form-group clearfix">
                                <div class="col-md-3">{!! Form::label('stock', 'Stock', ['class'=>'control-label']) !!}</div>
                                <div class="col-md-9">
                                    {!! Form::number('stock', '', ['class'=>'form-control','required']) !!}
                                     @if($errors->has('stock'))<p class="text-danger">{{ $errors->first('stock') }}</p> @endif
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