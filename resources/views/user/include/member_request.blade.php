@if(!Auth::guard('user')->user()->member)
	{!! Form::open(['route'=>'user.member.request.post']) !!}
		<div class="text-danger text-center">Currently you are not of icaps member. Merbership request <button class="btn btn-link">Click Here</button></div>
	{!! Form::close() !!}
@endif