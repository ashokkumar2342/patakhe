@extends('seller.layout.master')
@section('content')

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
                              <li class="active"><a href="{{ route('seller.account.profile.information.view') }}"> <i class="fa fa-user"></i> Profile</a></li>
                              <li><a href="{{ route('seller.account.profile.picture.form') }}"> <i class="fa fa-calendar"></i> Profile Picture </a></li>
                              <li ><a href="{{ route('seller.account.profile.information.edit') }}"> <i class="fa fa-edit"></i> Edit profile</a></li>
                              <li><a href="{{ route('seller.changepassword.form') }}"> <i class="fa fa-calendar"></i> Change Password </a></li>
                          </ul>

                      </section>
                  </aside>
                  <aside class="profile-info col-lg-9">
                     
                      <section class="panel">
                          <div class="panel-body bio-graph-info">
                              <h1>Bio Graph</h1>
                              <div class="row">
                                  <div class="bio-row">
                                      <p><span>First Name </span>: &nbsp;&nbsp;&nbsp;&nbsp;{{ $seller->first_name }}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Last Name </span>: &nbsp;&nbsp;&nbsp;&nbsp;{{ $seller->last_name }}</p>
                                  </div>
                                   <div class="bio-row">
                                      <p><span>Birthday</span>: &nbsp;&nbsp;&nbsp;&nbsp;{{ $seller->dob }}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Email </span>: &nbsp;&nbsp;&nbsp;&nbsp;{{ $seller->email }}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Mobile </span>: &nbsp;&nbsp;&nbsp;&nbsp;{{ $seller->mobile }}</p>
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

