@extends('front.layout.main')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-3 " style="min-height: 300px">
			@include('user.include.side_menu')
		</div>
		<div class="col-md-9" style="background-color: white; padding:30px">
			@include('user.include.member_request')			
			<div class="col-md-12" >
				<h3 style="margin-bottom: 25px;padding-bottom: 10px;border-bottom: 1px solid #c6c6c6;"><strong>	Change Password</strong></h3>
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						 {!! Form::open(['route'=>'user.changepassword.update','method'=>'put']) !!}
                                <div class="form-group">
                                    {!! Form::label('current_password', 'Old Password', ['class'=>'control-label']) !!}
                                    {!! Form::password('current_password', ['class'=>'form-control']) !!}
                                    @if($errors->has('current_password'))<p class="text-danger">{{ $errors->first('current_password') }}</p>@endif
                                </div>
                                <div class="form-group">
                                    {!! Form::label('new_password', 'New Password', ['class'=>'control-label']) !!}
                                    {!! Form::password('new_password', ['class'=>'form-control']) !!}
                                    @if($errors->has('new_password'))<p class="text-danger">{{ $errors->first('new_password') }}</p>@endif
                                </div>
                                <div class="form-group">
                                    {!! Form::label('new_password_confirmation', 'New Password Confirm', ['class'=>'control-label']) !!}
                                    {!! Form::password('new_password_confirmation', ['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group">
                                   <button class="btn btn-primary" type="submit">Change Password</button>
                                </div>
                            {!! Form::close() !!}
					</div>
				</div>				
		 	</div>
		</div>
	</div>
</div>
@endsection