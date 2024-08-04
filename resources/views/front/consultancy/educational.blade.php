@extends('front.layout.main')
@section('breadcrumb')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('front.home') }}">Home</a></li>
                <li class='active'>Education Consultancy</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
@endsection
@section('content')
		
			<div class="row">
				<!-- create a new account -->
				<div class="col-md-8 col-md-offset-2 col-sm-12 ">
                    <div class="sign-in-page">
					<h4 class="checkout-subtitle">Education Consultancy</h4>
                    <hr>
					{{ Form::open(['route'=>'front.consultancy.educational.post','class'=>'cmxform']) }}
						<div class="form-group clearfix">
 							{!! Form::label('apply_for', 'Apply For', ['class'=>'control-label col-lg-2']) !!}
                            <div class="col-md-10">
                                {!! Form::select('apply_for',
                                	[
									   'Matric' => 'Matric',
									   'Intermediate' => 'Intermediate',
									   'Graduate ( BA, B.sc, BBA, BCA B.Tech, BE )' => 'Graduate ( BA, B.sc, BBA, BCA B.Tech, BE )',
									   'Post Graduate ( MA, M.Sc, MBA, MCA, M.Tech' => 'Post Graduate ( MA, M.Sc, MBA, MCA, M.Tech',
									 ]


                                 , null, ['class'=>'form-control','placeholder'=>'please pick a menu','required']) !!}
                                <p class="text-danger">{{ $errors->first('apply_for') }}</p>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            {{ Form::label('message','Message',['class'=>'col-lg-2 control-label']) }}
                            <div class="col-lg-10">
                               {!! Form::textarea('message', '', ['class'=>'form-control','rows'=>'5','style'=>'resize:none;']) !!}
                            {!!  $errors->has('message')?$errors->first('message'):'' !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary pull-right" type="submit">Submit</button>
                        </div>
                    {{ Form::close() }}
                    </div>
				</div>	

				<!-- create a new account -->
			</div><!-- /.row -->
 

@endsection