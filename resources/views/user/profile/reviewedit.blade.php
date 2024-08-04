@extends('front.layout.main')
@push('links')
 <!--bootstrap picker-->
<link rel="stylesheet" type="text/css" href="{{ asset('js/bootstrap-datepicker/css/datepicker.css') }}"/>
@endpush
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-3 " style="min-height: 300px">
			@include('user.include.side_menu')
		</div>
		<div class="col-md-9" style="background-color: white; padding:30px">
			@include('user.include.member_request')	
			
			<div class="col-md-12" >
				<h3 style="margin-bottom: 25px;padding-bottom: 10px;border-bottom: 1px solid #c6c6c6;"><strong>Comments</strong></h3>
				<div class="row">
					<div class="col-md-12  ">						 
						{{ Form::open(['route'=>['user.profile.review.update',$review->id],'method'=>'put']) }}
		               		   <div class="form-group clearfix"> 
		                   	       <div class="col-lg-12">
		                       		 {{ Form::textarea('comments',$review->comments,['class'=>'form-control required','rows'=>'2',]) }}
		                        		<p class="text-danger">{{ $errors->first('comments') }}</p>
		                   		    </div>
		                		</div>	               
		                		<div class="form-group clearfix">
		                    		<button class="btn btn-primary pull-right" type="submit">Update</button>
		                		</div>
            			{{ Form::close() }}
					</div>
				</div>					
		 	</div>
		 	 
		</div>
		 
	
	</div>
</div>
@endsection

           
@push('scripts')
<!--picker initialization-->
<script src="{{ asset('js/picker-init.js') }}"></script>
<!--bootstrap picker-->
<script type="text/javascript" src="{{ asset('js/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
@endpush