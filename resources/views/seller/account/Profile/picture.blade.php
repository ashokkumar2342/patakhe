@extends('seller.layout.master')
@section('content')
   <!--body wrapper start-->
<div class="wrapper">
    @include('seller.include.message')
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  <aside class="profile-nav col-lg-3">
                      <section class="panel">
                          <div class="user-heading round">
                            @php
                                 $profile = route('seller.image.profile.view',[Auth::guard('seller')->user()->profile_pic]);
                            @endphp
                              <a href="#">
                                  <img src="{{  (Auth::guard('seller')->user()->profile_pic)? $profile : asset('seller_asset/img/user.png') }}" alt="">
                              </a>
                              <h1>{{ $seller->first_name}} {{ $seller->last_name }}</h1>
                              <p>{{ $seller->email }}</p>
                          </div>

                          <ul class="nav nav-pills nav-stacked">
                              <li ><a href="{{ route('seller.account.profile.information.view') }}"> <i class="fa fa-user"></i> Profile</a></li>
                              <li class="active"><a href="{{ route('seller.account.profile.picture.form') }}"> <i class="fa fa-picture-o"></i> Profile Picture </a></li>
                              <li ><a href="{{ route('seller.account.profile.information.edit') }}"> <i class="fa fa-edit"></i> Edit profile</a></li>
                              <li><a href="{{ route('seller.changepassword.form') }}"> <i class="fa fa-calendar"></i> Change Password </a></li>
                          </ul>

                      </section>
                  </aside>
                  <aside class="profile-info col-lg-9">
                     
                      <section class="panel">
                          <div class="panel-body bio-graph-info">
                          <div class="col-md-12">
                              {!! Form::open(['route'=>'seller.account.profile.picture.update','class'=>'form-horizontal','files'=>true]) !!}
                              <div class="form-group">
                                  {!! Form::label('file', 'Picture :', ['class'=>'control-label col-md-2']) !!}
                                  <div class="col-md-8">
                                      {!! Form::file('file', ['class'=>'form-control']) !!}
                                      @if($errors->has('file'))<p class="text-danger">{{ $errors->first('file') }}</p>@endif
                                  </div>
                                  <button class="btn btn-info " type="submit">Change Picture</button>
                              </div>
                              {!! Form::close() !!}
                          </div>
                          </div>
                        </section>
                    </aside>

    </div>
    <!--body wrapper end-->

@endsection