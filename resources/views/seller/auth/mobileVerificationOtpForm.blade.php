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
                    {!! Form::open(['route'=>'seller.mobile.verification.otp.post', 'class'=>'form-group form-horizontal']) !!}
                        <div class="form-group">
                            {!! Form::label('otp', 'OTP', ['class'=>'col-md-4 control-label']) !!}
                            <div class="col-md-5">
                                {!! Form::text('otp', '', ['class'=>'form-control']) !!}
                                @if ($errors->has('otp'))
                                        <p class="text-danger">{{ $errors->first('otp') }}</p>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">
                                    Verify
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
