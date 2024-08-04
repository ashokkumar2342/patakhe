@extends('user.layout.login')
@section('content')

    <body class="cnt-home">
        <!-- ============================================== HEADER ============================================== -->


<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('front.home') }}">Home</a></li>
                <li class='active'>Login</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="sign-in-page col-md-6 col-sm-6 col-md-offset-3">
            <div class="row">
                <!-- Sign-in -->            
                

                <!-- create a new account -->
                <div class="col-md-12 create-new-account">

                    <h4 class="checkout-subtitle">Create a new account</h4>
                    {!!form::open(['route'=>'user.register.post','class'=>'register-form outer-top-xs','role'=>'form'])!!}
                        {{Form::bsText('first_name','First Name  <span>*</span>',['class'=>'info-title'],'',['class'=>'form-control unicase-form-control text-input'])}}
                        {{Form::bsText('last_name','Last Name  <span>*</span>',['class'=>'info-title'],'',['class'=>'form-control unicase-form-control text-input'])}}
                        {{Form::bsText('mobile','Phone Number  <span>*</span>',['class'=>'info-title'],'',['class'=>'form-control unicase-form-control text-input'])}}
                        {{Form::bsEmail('email','Email Address ',['class'=>'info-title'],'',['class'=>'form-control unicase-form-control text-input'])}}
                        {{Form::bsPassword('password','Password <span>*</span>',['class'=>'info-title'],['class'=>'form-control unicase-form-control text-input'])}}
                         {{Form::bsPassword('password_confirmation','Confirm Password <span>*</span>',['class'=>'info-title'],['class'=>'form-control unicase-form-control text-input'])}}
                          <p class="pull-right">Already have an account ? <a href="{{route('user.login.form')}}">Click here</a></p>
                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
                    {!!form::close()!!}
                </div>  
                <!-- create a new account -->          
             </div><!-- /.row -->
        </div><!-- /.sigin-in-->
    </div><!-- /.container -->
    <div class="clearfix"><br><br></div>
</div><!-- /.body-content -->

@endsection