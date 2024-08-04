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
				<h3 style="margin-bottom: 25px;padding-bottom: 10px;border-bottom: 1px solid #c6c6c6;"><strong>	Account Information</strong></h3>
				<div class="row">
					<div class="col-md-6">
						<p style="font-size: 16px;"> <b>Contact Information</b> </p>
				 		<h5> {{ $user->first_name }}
				 		{{ $user->last_name }}</h5>
				 		<h5>{{ $user->email }}</h5>
				 		<p><a href="{{ route('user.profile.edit') }}">Edit</a> | <a href="{{ route('user.password.change') }}">Change Password</a></p>
					</div>
					@php
                     $profile = route('user.image.profile.view',[Auth::guard('user')->user()->profile_pic]);
                @endphp
					<div class="col-md-6">
						<div id="showImg">
							<p style="font-size: 16px;"><b>Profile Image</b></p>
							<div style="height: 100px; width: 100px; background-color: #eee;">
								<img width="100" height="100px" src="{{  (Auth::guard('user')->user()->profile_pic)? $profile : asset('profile-img/user.png') }}">
							</div>
							 
							<a href="javascript:;">Change Image</a>
						</div>
						<div id="changeImg" class="hidden">
							{!! Form::open(['route'=>'user.profilepic.update','files'=>true]) !!}
								<div class="col-md-7">
									{!! Form::file('profile_pic', ['class'=>'form-control']) !!}
									
								</div>
								<div class="col-md-5"><button type="submit" class="btn btn-primary">Change</button> </div>
								<p class="text-danger">{{ $errors->first('profile_pic') }}</p>
								<div class="col-md-12"><br><a href="javascript:;">Cancel</a></div>
								
							{!! Form::close() !!}
						</div>
					</div>
				</div>			
		 	</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		$('#showImg').on('click','a',function(){
			$('#showImg').hide();
			$('#changeImg').removeClass('hidden');
		});
		$('#changeImg').on('click','a',function(){
			$('#changeImg').addClass('hidden');
			$('#showImg').show();
		});
		@if($errors->has('profile_pic'))
		$('#showImg').hide();
		$('#changeImg').removeClass('hidden');
		@endif
	});
</script>
@endpush