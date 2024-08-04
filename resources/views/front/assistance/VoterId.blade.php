@extends('front.layout.main')
@section('content')
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="index.php">Home</a></li>
				<li class='active'>Apply For Visa</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
				<!-- Sign-in -->

				<!-- create a new account -->
				<div class="col-md-12 col-sm-12 create-new-account">
					<h4 class="checkout-subtitle">Apply For Voter Id</h4>
					{{ Form::open(['route'=>'front.assistance.VoterId.post','class'=>'cmxform']) }}
                                <div class="form-group clearfix">
                                    {{ Form::label('first_name','First Name',['class'=>'col-lg-2 control-label']) }}
                                    <div class="col-lg-10">
                                        {{ Form::text('first_name','',['class'=>'form-control required']) }}
                                        <p class="text-danger">{{ $errors->first('first_name') }}</p>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    {{ Form::label('last_name','Last Name',['class'=>'col-lg-2 control-label']) }}
                                    <div class="col-lg-10">
                                        {{ Form::text('last_name','',['class'=>'form-control required']) }}
                                        <p class="text-danger">{{ $errors->first('last_name') }}</p>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    {{ Form::label('mobile','Mobile',['class'=>'col-lg-2 control-label']) }}
                                    <div class="col-lg-10">
                                        {{ Form::text('mobile','',['class'=>'form-control required']) }}
                                        <p class="text-danger">{{ $errors->first('mobile') }}</p>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    {{ Form::label('email','Email',['class'=>'col-lg-2 control-label']) }}
                                    <div class="col-lg-10">
                                        {{ Form::email('email','',['class'=>'form-control required']) }}
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                    </div>
                                </div>
                                 <div class="form-group clearfix">
                                    {{ Form::label('address','Address',['class'=>'col-lg-2 control-label']) }}
                                    <div class="col-lg-10">
                                        {{ Form::text('address','',['class'=>'form-control required']) }}
                                        <p class="text-danger">{{ $errors->first('address') }}</p>
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

				<!-- create a new account -->
			</div><!-- /.row -->
		</div><!-- /.sigin-in-->
 
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
</div><!-- /.body-content -->

@endsection