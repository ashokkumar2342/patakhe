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
						{!! Form::open(['route'=>'user.profile.review.post']) !!}
								<div class="form-group clearfix">
                                    
                                    <div class="col-lg-12">
                                       {!! Form::textarea('comments', '', ['class'=>'form-control','rows'=>'2','style'=>'resize:none;']) !!}
                                    <p class="text-danger">{{ $errors->first('comments') }}</p>
                                     
                                    </div>
                                </div>	
								<div class="clearfix">
									<div class="form-group clearfix  text-right">
										<button class="btn btn-primary">Post</button>
									</div>
								</div>
								
							
						{!! Form::close() !!}
					</div>
				</div>					
		 	</div>
		 	<section class="panel">
	    <header class="panel-heading ">
	         
	    </header>
		    <table class="table">
		        <thead>
		            <tr>
		                <th>Date/Time</th>
		                <th>User Name</th>                                                                

		                <th>Review</th>                                
		                
		                <th colspan="2">Action</th>
		                 
		            </tr>
		        </thead>
		        <tbody>
		            @foreach($review as $data)
		                @if($data->user)
		                    <tr>
		                        <td>{{ $data->created_at}}</td>
		                        <td>{{ $data->first_name}}</td>
		                        <td>{{ $data->comments }}</td>		                        
		                        <td class="romove-item">
			                        @if($data->user->id == Auth::guard('user')->user()->id)
				                        <div class="dropdown">
										    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog ">
										    <span class="caret"></span>
										    </i></a>
										    <ul class="dropdown-menu">							       
										      <li><a href="{{ route('user.profile.review.edit',[$data->id]) }}"  ><i class="fa fa-pencil"></i> Edit</a> </a></li>
										      <li><a href="{{ route('user.profile.review.delete',$data->id) }}"><i class="fa fa-trash-o"></i> Delete</a>
		                                        </li>
										    </ul>
										</div>
									@endif                                        
                                </td>

		                                                      
		                    </tr>
		                @endif
		            @endforeach
		        </tbody>
		    </table>
		</section>
		</div>
		 
	
	</div>
</div>
@endsection

