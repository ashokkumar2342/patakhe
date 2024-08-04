@extends('front.layout.main')
@section('breadcrumb')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('front.home') }}">Home</a></li>
                <li class='active'>Meidcine</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
@endsection
@section('content')
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Medicine</h3>
			</div>
			<div class="panel-body">
				{{ Form::open(['route'=>'front.product.medicine.post','files'=>true]) }}
					<div class="form-group">
						{{ Form::label('name','Name',['class'=>'control-label']) }}
						{{ Form::text('name', Auth::guard('user')->user()->first_name.' '.Auth::guard('user')->user()->last_name,['class'=>'form-control']) }}
						<p class="text-danger">{{ $errors->first('name') }}</p>
					</div>
					<div class="form-group">
						{{ Form::label('mobile','Mobile',['class'=>'control-label']) }}
						{{ Form::text('mobile', @Auth::guard('user')->user()->mobile ,['class'=>'form-control']) }}
						<p class="text-danger">{{ $errors->first('mobile') }}</p>
					</div>
					<div class="form-group">
						{{ Form::label('prescription','Prescription',['class'=>'control-label']) }}
						{{ Form::file('prescription') }}
						<p class="text-danger">{{ $errors->first('prescription') }}</p>
					</div>
					<div class="form-group">
						<button class="btn btn-info" type="submit">Upload</button>
					</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>
@endsection