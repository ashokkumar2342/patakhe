@extends('admin.layout.master')
@push('links')
<link rel="stylesheet" type="text/css" href="{{ asset('js/bootstrap-datepicker/css/datepicker.css') }}"/>
@endpush
@section('content')
    <!-- page head start-->
    <div class="page-head">
        <h3>
            User Edit
        </h3>
        
    </div>
    <!-- page head end-->

    <!--body wrapper start-->
    <div class="wrapper">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {{ Form::open(['route'=>['admin.user.update', $user->id]]) }}                
                <div class="row clearfix">
                    <div class="col-md-6">
                        {{ Form::bsText('first_name','First Name',['class'=>'control-label'],$user->first_name,['class'=>'form-control']) }}
                    </div>
                    <div class="col-md-6">
                        {{ Form::bsText('last_name','Last Name',['class'=>'control-label'],$user->last_name,['class'=>'form-control']) }}
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-6">
                        <div class="form-group ">
                            <br>
                            <div class="form-control">
                                 {{ Form::label('gender','Gender',['class'=>'control-label']) }}
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <label style="cursor: pointer"><input type="radio" name="gender" value="1" {{ @($user->gender == 1)?'checked':'' }} > Male </label>&nbsp;&nbsp;&nbsp;
                                <label style="cursor: pointer;"><input type="radio" name="gender" value="2" {{ @($user->gender == 2)?'checked':''}}> Female</label>
                                <p class="text-danger">{{ $errors->first('gender') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('dob','Date Of Birth',['class'=>'control-label']) }}
                            <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{{ ($user->dob)?date('d-m-Y', strtotime($user->dob)):date('d-m-Y') }}"  class="input-append date dpYears">
                                <input type="text" value="{{ ($user->dob)?date('d-m-Y', strtotime($user->dob)):'' }}"  name="date_of_birth"  size="16" class="form-control">
                                <span class="input-group-btn add-on" style="margin-right: 30px; ">
                                    <button style="height: 34px" class="btn btn-primary" type="button"><i class="fa fa-calendar"></i></button>
                                </span>
                                <p class="text-danger">{{ $errors->first('dob') }}</p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-12">
                        {{ Form::bsText('mobile','Mobile',['class'=>'control-label'], $user->mobile ,['class'=>'form-control']) }}
                    </div>
                </div>
                <div class="row clearfix">
                     <div class="col-md-12">
                        {{ Form::bsEmail('email','Email',['class'=>'control-label'], $user->email ,['class'=>'form-control']) }}
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('address','Address',['class'=>'control-label']) }}
                            {{ Form::text('address',@$user->default_address->address,['class'=>'form-control']) }}
                        </div>
                        <p class="text-danger">{{ $errors->first('address') }}</p>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('street_address','Street Address',['class'=>'control-label']) }}
                            {{ Form::text('street_address',@$user->default_address->street,['class'=>'form-control']) }}
                        </div>
                        <p class="text-danger">{{ $errors->first('street_address') }}</p>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('landmark','Landmark',['class'=>'control-label']) }}
                            {{ Form::text('landmark',@$user->default_address->landmark,['class'=>'form-control']) }}
                        </div>
                        <p class="text-danger">{{ $errors->first('landmark') }}</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-success">Update</button>
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
 {{-- Form validatin script --}}
<script src="{{ asset('js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/form-validation-init.js')}}" type="text/javascript"></script>

@endpush