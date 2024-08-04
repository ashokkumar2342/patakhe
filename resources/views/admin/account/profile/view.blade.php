@extends('admin.layout.master')
@section('content')
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
                              <li class="active"><a href="{{ route('admin.account.profile.information.view') }}"> <i class="fa fa-user"></i> Profile</a></li>
                              <li><a href="{{ route('admin.account.profile.picture.form') }}"> <i class="fa fa-calendar"></i> Profile Picture </a></li>
                              <li ><a href="{{ route('admin.account.profile.information.edit') }}"> <i class="fa fa-edit"></i> Edit profile</a></li>
                              <li><a href="{{ route('admin.changepassword.form') }}"> <i class="fa fa-calendar"></i> Change Password </a></li>
                          </ul>

                      </section>
                  </aside>
                  <aside class="profile-info col-lg-9">
                     
                      <section class="panel">
                          <div class="panel-body bio-graph-info">
                              <h1>Bio Graph</h1>
                              <div class="row">
                                  <div class="bio-row">
                                      <p><span>First Name </span>: &nbsp;&nbsp;&nbsp;&nbsp;{{ $admin->first_name }}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Last Name </span>: &nbsp;&nbsp;&nbsp;&nbsp;{{ $admin->last_name }}</p>
                                  </div>
                                   <div class="bio-row">
                                      <p><span>Birthday</span>: &nbsp;&nbsp;&nbsp;&nbsp;{{ $admin->dob }}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Email </span>: &nbsp;&nbsp;&nbsp;&nbsp;{{ $admin->email }}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Mobile </span>: &nbsp;&nbsp;&nbsp;&nbsp;{{ $admin->mobile }}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Country </span>: &nbsp;&nbsp;&nbsp;&nbsp;</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Occupation </span>: &nbsp;&nbsp;&nbsp;&nbsp;</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Phone </span>: &nbsp;&nbsp;&nbsp;&nbsp;</p>
                                  </div>
                              </div>
                          </div>
                      </section>
                  </aside>
              </div>

              <!-- page end-->
          </section>
      </section>
      <!--main content end-->

</div>
<!--body wrapper end-->

@endsection

