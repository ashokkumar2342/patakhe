@extends('admin.layout.master')
@push('links')
<link href="{{ asset('admin/js/icheck/skins/all.css') }}" rel="stylesheet">
<style type="text/css">
    .radio-custom input{
       float: left;
        visibility: hidden;
    }
    .radio-custom {
        margin-top: -5px;

    }
</style>
@endpush
@section('content')
    <!-- page head start-->
    <div class="page-head">
        <h3>
            Member
        </h3>
        
    </div>
    <!-- page head end-->

    <!--body wrapper start-->
    <div class="wrapper">
         <div class="row">
                <div class="col-lg-6 col-md-offset-3 ">
                    <section class="panel">
                        <header class="panel-heading">
                            <h3>Seller Registration Form</h3>
                        </header>
                        <div class="panel-body">
                        {{ Form::open(['route'=>'admin.seller.new.post','class'=>'signupForm cmxform']) }}
                            <div class="form-group clearfix">
                                {{ Form::label('first_name','First Name ',['class'=>'control-label col-md-3']) }}
                                <div class="col-md-9">
                                    {{ Form::text('first_name','',['class'=>'form-control required']) }}
                                    <p class="text-danger">{{ $errors->first('first_name') }}</p>
                                </div>                                    
                                
                            </div>
                            <div class="form-group clearfix">
                                {{ Form::label('last_name','Last Name ',['class'=>'control-label col-md-3']) }}
                                <div class="col-md-9">
                                    {{ Form::text('last_name','',['class'=>'form-control required']) }}
                                     <p class="text-danger">{{ $errors->first('last_name') }}</p>
                                </div>
                               
                            </div>
                            <div class="form-group clearfix">
                                {{ Form::label('mobile','Mobile ',['class'=>'control-label col-md-3']) }}
                                <div class="col-md-9">
                                    {{ Form::text('mobile','',['class'=>'form-control required']) }}
                                    <p class="text-danger">{{ $errors->first('mobile') }}</p>
                                </div>
                                
                            </div>
                            <div class="form-group clearfix">
                                {{ Form::label('email','Email ',['class'=>'control-label col-md-3']) }}
                                <div class="col-md-9">
                                    {{ Form::email('email','',['class'=>'form-control required']) }}
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                </div>
                                
                            </div>
                            <div class="form-group clearfix">
                                <div class="col-md-12">
                                    <button class="btn btn-primary pull-right" type="submit">Create Seller</button>
                                </div>
                            </div>
                           
                            {{ Form::close() }}


                        </div>
                    </section>
                </div>
            </div>
      

    </div>
    <!--body wrapper end-->

@endsection
@push('scripts')
{{-- Form validation script --}}
<script src="{{ asset('admin/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin/js/form-validation-init.js') }}" type="text/javascript"></script>
@endpush