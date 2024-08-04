@extends('seller.layout.auth')

<!-- Main Content -->
@section('content')
<div class="container">
@include('seller.include.message')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Mobile Verification Form</div>
                <div class="panel-body">
                    {!! Form::open(['route'=>'seller.mobile.verification.post', 'class'=>'form-group form-horizontal']) !!}
                        <div class="form-group">
                            {!! Form::label('mobile', 'Mobile', ['class'=>'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('mobile', '', ['class'=>'form-control']) !!}
                                @if ($errors->has('mobile'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('password', 'Password', ['class'=>'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::password('password', ['class'=>'form-control']) !!}
                                @if ($errors->has('password'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send OTP
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
