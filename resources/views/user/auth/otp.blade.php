@extends('front.layout.main')
@section('content')
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
      
        <div class="sign-in-page col-md-4 col-sm-4 col-md-offset-4">
            <div class="row">
                <!-- Sign-in -->            
                <div class="col-md-12 sign-in">
                
                    <h4 class="">Otp  </h4>
                    
                   <form action="{{ route('user.send.otp') }}" method="get" accept-charset="utf-8"> 
                        <div class="form-group">
                            {!!form::text('otp','',['class'=>'form-control unicase-form-control text-input','placeholder'=>'Otp', 'autofocus'])!!}
                            <div class="text-danger">{!!$errors->first('Otp')!!}</div>
                        </div>
                  
                        
                            <button class="btn-upper btn-block btn btn-primary checkout-page-button" type="submit">LOGIN</button>

                    {!!Form::close()!!} 
                    
                    
                </div>
                <!-- Sign-in -->
    
             </div><!-- /.row -->
        </div><!-- /.sigin-in-page-->

    </div><!-- /.container -->
    <div class="clearfix"><br><br></div>
</div><!-- /.body-content -->

@endsection