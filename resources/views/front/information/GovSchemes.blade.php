@extends('layout.front')
@section('breadcrumb')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('front.home') }}">Home</a></li>
                <li class='active'>About Driving Licence</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
@endsection
@section('content')
<div class="container">
	<div class="row ">
		<div class="col-md-9">&nbsp;</div>
		<!-- Quick links  -->
		<div class="col-md-3  create-new-account">
				@include('front.information.quick_links')
			</div>
	</div><!-- /.row -->
</div><!-- /.container -->
@endsection