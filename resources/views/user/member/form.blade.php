@extends('front.layout.main')
@push('links')
<style type="text/css">
	.user-sidebar li{
		padding: 4px 2px
	}
	.user-sidebar li a{
		padding: 5px 2px;
	}
</style>
@endpush
@section('content')
<div class="body-content outer-top-xs" id="top-banner-and-menu">
	<div class="container">
		<div class="row">
			<div class="col-md-3 " style="min-height: 300px">
				@include('user.include.side_menu')
			</div>
			<div class="col-md-9">
						<div class="col-md-8 col-md-offset-2">
						<div class="panel panel-info">
							<div class="panel-heading">MemberShip Registration Form</div>
							<div class="panel-body">
								{{ Form::open(['route'=>'user.member.registration.post']) }}
							<div class="col-md-6">
								{{ Form::bsText('first_name','First Name',['class'=>'control-label'],$user->user()->first_name,['class'=>'form-control']) }}
							</div>
							<div class="col-md-6">
								{{ Form::bsText('last_name','Last Name',['class'=>'control-label'],$user->user()->last_name,['class'=>'form-control']) }}
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('dob','Date Of Birth',['class'=>'control-label']) }}
									{{ Form::date('dob',$user->user()->dob,['class'=>'form-control']) }}
									<div class="text-danger">{{$errors->first('dob')}}</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('gender','Gender',['class'=>'control-label ']) }}<br>
									{{ Form::radio('gender', 'male',($user->user()->gender == 'male')?true:'') }} Male
									{{ Form::radio('gender', 'female',($user->user()->gender == 'female')?true:'') }} Female
									<div class="text-danger">{{$errors->first('gender')}}</div>
								</div>
							</div>
							
							<div class="col-md-12">
								{{ Form::bsText('mobile','Mobile',['class'=>'control-label'],$user->user()->mobile,['class'=>'form-control']) }}
								<div class="text-danger">{{$errors->first('mobile')}}</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									{{ Form::label('address','Address',['class'=>"control-label"]) }}
									{{ Form::textarea('address',$user->user()->address,['class'=>'form-control','rows'=>5,'style'=>'resize:none']) }}
									<div class="text-danger">{{$errors->first('address')}}</div>
								</div>
							</div>
							<div class="col-md-12">
								<button type="submit" class="btn btn-primary">Send Request</button>
							</div>

						{{ Form::close() }}
							</div>
						</div>
						
				</div>
			</div>
		</div>
	</div>
</div>
@endsection