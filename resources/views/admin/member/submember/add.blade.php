@extends('admin.layout.master')
@push('links')
<link rel="stylesheet" type="text/css" href="{{ asset('js/bootstrap-datepicker/css/datepicker.css') }}"/>
@endpush
@section('content')
    <!-- page head start-->
    <div class="page-head">
        <h3>Add Sub Member</h3>       
    </div>
    <!-- page head end-->

    <!--body wrapper start-->
    <div class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel">
                    {!! Form::open(['route'=>['admin.submember.add',$user->id]]) !!}
                        <input type="hidden" name="referer" value="{{ URL::previous() }}">
                        <input type="hidden" name="member_id" value="{{ $user->member->id }}">
                        
                        <div class="col-md-8 col-md-offset-2">
                            <div class="row">
                                <div class="col-md-6">
                                    {{ Form::bsText('first_name','First Name',['class'=>'control-label'],'',['class'=>'form-control']) }}
                                </div>
                                <div class="col-md-6">
                                    {{ Form::bsText('last_name','Last Name',['class'=>'control-label'],'',['class'=>'form-control']) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ Form::bsText('email','Email',['class'=>'control-label'],'',['class'=>'form-control']) }}
                                </div>
                                <div class="col-md-6">
                                    {{ Form::bsText('mobile','Mobile',['class'=>'control-label'],'',['class'=>'form-control']) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ Form::bsText('aadhar_card_no','Aadhar Card No',['class'=>'control-label'],'',['class'=>'form-control']) }}
                                </div>
                                <div class="col-md-6">
                                    {{ Form::label('dob','Date Of Birth',['class'=>'control-label']) }}

                                    <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{{ date('d-m-Y') }}"  class="input-append date dpYears">
                                        {!! Form::text('date_of_birth',  '', ['size'=>'16', 'class'=>'form-control']) !!}
                                        <span class="input-group-btn add-on">
                                            <button class="btn btn-primary" style="height: 34px; padding-top: 9px" type="button"><i class="fa fa-calendar"></i></button>
                                        </span>
                                    </div>
                                    <p class="text-danger">{{ $errors->first('date_of_birth') }}</p>
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="col-md-6">
                                    {!! Form::label('status', 'Is Active', ['class'=>'control-label']) !!}
                                    {!! Form::select('status', ['0' => 'no', '1' => 'yes'], null, ['class' => 'form-control']) !!}
                                    @if($errors->has('status'))<p class="text-danger">{{ $errors->first('status') }}</p> @endif
                                </div>    
                                <div class="col-md-6">
                                    <div class="form-group"><br>
                                        <div class="form-control">
                                             {{ Form::label('gender','Gender',['class'=>'control-label']) }}
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <label style="cursor: pointer">{{ Form::radio('gender', '1') }} Male&nbsp;&nbsp;&nbsp;
                                            <label style="cursor: pointer;">{{ Form::radio('gender', '2') }} Female
                                        </div>
                                        <p class="text-danger">{{ $errors->first('gender') }}</p>
                                    </div>
                                </div>    
                            </div>   
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary pull-right">Add Sub Member</button>
                                </div>
                            </div>               
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!--body wrapper end-->

@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('js/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<!--picker initialization-->
<script src="{{ asset('js/picker-init.js') }}"></script>
@endpush