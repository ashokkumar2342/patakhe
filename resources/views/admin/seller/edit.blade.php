@extends('admin.layout.master')
@push('links')
<link rel="stylesheet" type="text/css" href="{{ asset('js/bootstrap-datepicker/css/datepicker.css') }}"/>
@endpush
@section('content')
    <!-- page head start-->
    <div class="page-head">
        <h3>
            Seller Edit
        </h3>
        
    </div>
    <!-- page head end-->

    <!--body wrapper start-->
    <div class="wrapper">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {{ Form::open(['route'=>['admin.seller.update', $seller->id]]) }}
                 
                
                <div class="col-md-6">
                    {{ Form::bsText('first_name','First Name',['class'=>'control-label'],$seller->first_name,['class'=>'form-control']) }}
                </div>
                
                <div class="col-md-6">
                    {{ Form::bsText('last_name','Last Name',['class'=>'control-label'],$seller->last_name,['class'=>'form-control']) }}
                </div>
           
                 
                <div class="col-md-12">
                    {{ Form::bsText('mobile','Mobile',['class'=>'control-label'],$seller->mobile,['class'=>'form-control']) }}
                </div>

                  <div class="col-md-12">
                    {{ Form::bsText('email','Email',['class'=>'control-label'],$seller->email,['class'=>'form-control']) }}
                </div>
                 
                <div class="col-md-12">
                    <button class="btn btn-success">Save</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
        
    </div>
    <!--body wrapper end-->

@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('js/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<!--picker initialization-->
<script src="{{ asset('js/picker-init.js') }}"></script>

<script src="{{ asset('js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/form-validation-init.js')}}" type="text/javascript"></script>

@endpush