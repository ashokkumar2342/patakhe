@extends('admin.layout.master')
@section('content')
   <!--body wrapper start-->
<div class="wrapper">
    @include('admin.include.message')
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  <aside class="profile-nav col-lg-3">
                      <section class="panel">
                          <div class="user-heading round">
                            @php
                                 $profile = route('admin.image.profile.view',[Auth::guard('admin')->user()->profile_pic]);
                            @endphp
                              <a href="#">
                                  <img src="{{  (Auth::guard('admin')->user()->profile_pic)? $profile : asset('admin_asset/img/user.png') }}" alt="">
                              </a>
                              <h1>{{ $admin->first_name}} {{ $admin->last_name }}</h1>
                              <p>{{ $admin->email }}</p>
                          </div>

                          <ul class="nav nav-pills nav-stacked">
                              <li ><a href="{{ route('admin.account.profile.information.view') }}"> <i class="fa fa-user"></i> Profile</a></li>
                              <li class="active"><a href="{{ route('admin.account.profile.picture.form') }}"> <i class="fa fa-picture-o"></i> Profile Picture </a></li>
                              <li ><a href="{{ route('admin.account.profile.information.edit') }}"> <i class="fa fa-edit"></i> Edit profile</a></li>
                              <li><a href="{{ route('admin.changepassword.form') }}"> <i class="fa fa-calendar"></i> Change Password </a></li>
                          </ul>

                      </section>
                  </aside>
                  <aside class="profile-info col-lg-9">
                     
                      <section class="panel">
                          <div class="panel-body bio-graph-info">
                          <div class="col-md-12">
                              {!! Form::open(['route'=>'admin.account.profile.picture.update','class'=>'form-horizontal','files'=>true]) !!}
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