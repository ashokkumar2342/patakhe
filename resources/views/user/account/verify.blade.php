@extends('front.layout.main')
@push('links')

@endpush
@section('content')
<div class="row">
	<div class="col-md-6 col-md-offset-3" style="min-height: 300px">
		<router-view></router-view>
		{{-- <br><br>
		{{ Form::open(['route'=>'user.account.verify.post','id'=>'verify-form']) }}
		<div class="form-group">
			{{ Form::label('otp','OTP',['class'=>'control-label col-md-2']) }}
			<div class="col-md-8">
				{{ Form::text('otp','',['class'=>'form-control']) }}
				<p class="text-danger">{{ $errors->first('otp') }}</p>
			</div>
			<div class="col-md-2">
				<button type="submit" class="btn btn-success">Verify</button>
			</div>
		</div>
		{{ Form::close() }}
		<div class="col-md-12">
			{!! Form::open(['route'=>'user.account.resend.otp']) !!}
				<p class="text-center">Resend OTP <button class="btn btn-link">click here</button></p>
			{!! Form::close() !!}
		</div> --}}
	</div>
</div>
@endsection