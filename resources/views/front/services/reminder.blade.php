@extends('front.layout.main')
@push('links')
<link rel="stylesheet" type="text/css" href="{{ asset('admin/js/bootstrap-datepicker/css/datepicker.css') }}"/>
@endpush
@section('content')
<div class="container" style="min-height: 300px; margin-top: 50px;">
	<div class="row">
		<div class="col-md-6 col-md-offset-3" >
			{{-- <ul class="nav nav-tabs">
			  <li data-toggle="tab" class="active"><a href="#free">Home</a></li>
			  <li  data-toggle="tab"><a href="#paid">Menu 2</a></li>
			  <li  data-toggle="tab"><a href="#">Menu 3</a></li>
			</ul> --}}
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Reminder Services</h3>
				</div>
				<div class="panel-body">
					{{ Form::open(['route'=>'front.services.reminder.post']) }}
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									{{ Form::label('type','Type',['class'=>'control-label']) }}
									{{ Form::select('type', ['1' => 'Free', '2' => 'Paid'], null, ['placeholder' => 'Pick a choice...','class'=>'form-control']) }}
									<p class="text-danger">{{ $errors->first('type') }}</p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group" style="margin-bottom: -20px">
									{{ Form::label('Date','Date of Reminder',['class'=>'control-label']) }}
									<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{{ date('d-m-Y') }} "  class="input-append date dpYears">
			                            <input type="text" value="{{ date('d-m-Y') }}" readonly="" name="date"  size="16" class="form-control col-md-8">
			                            <span class="input-group-btn add-on " style="position: relative; left:85%; top: -34px;  " >
			                                <button class="btn btn-primary" style="padding: 9px 10px;" type="button"><i class="fa fa-calendar"></i></button>
			                            </span>
			                        </div>
			                        <p class="text-danger">{{ $errors->first('date') }}</p>
								</div>
							</div>
						</div>
						
						
						<div class="form-group">
							{{ Form::label('name','Reminder For ',['class'=>'control-label']) }}
							{{ Form::text('name','', ['class'=>'form-control','placeholder'=>'Enter Reminder person name ...']) }}
							<p class="text-danger">{{ $errors->first('name') }}</p>
						</div>
						<div class="form-group">
							{{ Form::label('event','Event',['class'=>'control-label']) }}
							{{ Form::text('event','', ['class'=>'form-control','placeholder'=>'Enter your event name ...']) }}
							<p class="text-danger">{{ $errors->first('event') }}</p>
						</div>
						
						<div class="form-group">
							{{ Form::label('description','Description',['class'=>'control-label']) }}
							{{ Form::textarea('description','',['class'=>'form-control','style'=>'resize:none','rows'=>'4','placeholder'=>'Description about this event ...']) }}
							<p class="text-danger">{{ $errors->first('description') }}</p>
						</div>
						 

						<div class="form-group">
							<button class="btn btn-info">Submit</button>
						</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
		
	</div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('admin/js/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<!--picker initialization-->
<script src="{{ asset('admin/js/picker-init.js') }}"></script>


@endpush