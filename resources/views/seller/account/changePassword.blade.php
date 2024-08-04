@extends('seller.layout.master')
@push('links')
<link rel="stylesheet" type="text/css" href="{{ asset('js/bootstrap-datepicker/css/datepicker.css') }}"/>
@endpush
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
                              <li><a href="{{ route('seller.account.profile.picture.form') }}"> <i class="fa fa-calendar"></i> Profile Picture </a></li>
                              <li ><a href="{{ route('seller.account.profile.information.edit') }}"> <i class="fa fa-edit"></i> Edit profile</a></li>
                              <li class="active"><a href="{{ route('seller.changepassword.form') }}"> <i class="fa fa-calendar"></i> Change Password </a></li>
                          </ul>

                      </section>
                  </aside>
                  <aside class="profile-info col-lg-9">
                     <section class="panel">
                          <div class="bio-graph-heading">
                              Change Your Password
                          </div>
                          <div class="panel-body bio-graph-info">
                            {!! Form::open(['route'=>'seller.changepassword.post','method'=>'put']) !!}
                                <div class="form-group">
                                    {!! Form::label('current_password', 'Old Password', ['class'=>'control-label']) !!}
                                    {!! Form::password('current_password', ['class'=>'form-control']) !!}
                                    @if($errors->has('current_password'))<p class="text-danger">{{ $errors->first('current_password') }}</p>@endif
                                </div>
                                <div class="form-group">
                                    {!! Form::label('new_password', 'New Password', ['class'=>'control-label']) !!}
                                    {!! Form::password('new_password', ['class'=>'form-control']) !!}
                                    @if($errors->has('new_password'))<p class="text-danger">{{ $errors->first('new_password') }}</p>@endif
                                </div>
                                <div class="form-group">
                                    {!! Form::label('new_password_confirmation', 'New Password Confirm', ['class'=>'control-label']) !!}
                                    {!! Form::password('new_password_confirmation', ['class'=>'form-control']) !!}
                                    @if($errors->has('new_password_confirmation'))<p class="text-danger">{{ $errors->first('new_password_confirmation') }}</p>@endif
                                </div>
                                <div class="form-group">
                                   <button class="btn btn-primary" type="submit">Change Password</button>
                                </div>
                            {!! Form::close() !!}
                          </div>
                    </section>
                </aside>
            </div>
        </section>
    </section>
</div>

   

@endsection