@extends('front.layout.main')
@section('breadcrumb')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('front.home') }}">Home</a></li>
                <li class='active'>Request for Dth Service</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
@endsection
@section('content')
<div class="row">
	<div class="col-md-4 col-md-offset-4">
		{{ Form::open(['route'=>'front.services.ItReturns.post']) }}
		<div class="form-group">
			<h3>Hello ! {{ Auth::guard('user')->user()->first_name . ' '. Auth::guard('user')->user()->last_name }}</h3>
		</div>
		<div class="form-group">
			For request <button class="btn btn-link" type="submit">Click Here</button>
		</div>
		{{ Form::close() }}
	</div>
</div>
@endsection