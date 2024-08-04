@extends('front.layout.main')
@section('breadcrumb')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('front.home') }}">Home</a></li>
                <li class='active'>Apply For Training</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2 col-sm-12 sign-in-page">
        <h4 class="checkout-subtitle">Training</h4>
        <hr>
        {{ Form::open(['route'=>'front.assistance.training.post','class'=>'cmxform']) }}
            <div class="form-group clearfix">
                {!! Form::label('apply_for', 'Apply For', ['class'=>'control-label col-lg-2']) !!}
                <div class="col-md-10">
                    {!! Form::select('apply_for',
                        [
                           'Full Stack Web Development' => 'Full Stack Web Development',
                           'Mobile App Development' => 'Mobile App Development',
                           'Sales &amp; Marketing' => 'Sales &amp; Marketing',
                           'Graphic Designer' => 'Graphic Designer',
                           'Call Centre Training/BPO' => 'Call Centre Training/BPO',
                           'MS Office' => 'MS Office',
                           'Retail Management' => 'Retail Management',
                           'MTS' => 'MTS',
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
@endsection

