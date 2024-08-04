 @extends('admin.layout.master')
@push('links')
<link rel="stylesheet" type="text/css" href="{{ asset('js/bootstrap-datepicker/css/datepicker.css') }}"/>
@endpush
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
                              <li><a href="{{ route('admin.account.profile.picture.form') }}"> <i class="fa fa-calendar"></i> Profile Picture </a></li>
                              <li class="active"><a href="{{ route('admin.account.profile.information.edit') }}"> <i class="fa fa-edit"></i> Edit profile</a></li>
                              <li><a href="{{ route('admin.changepassword.form') }}"> <i class="fa fa-calendar"></i> Change Password</a> </li>
                          </ul>

                      </section>
                  </aside>
                  <aside class="profile-info col-lg-9">
                     <section class="panel">
                          <div class="bio-graph-heading">
                              Edit your profile
                          </div>
                          <div class="panel-body bio-graph-info">
                              <h1> Profile Info</h1>
                              {!! Form::open(['route'=>'admin.account.profile.information.update','class'=>'form-horizontal','role'=>'form']) !!}
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">First Name</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" name="first_name" value="{{ $admin->first_name or old('first_name') }}" id="f-name" placeholder=" ">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Last Name</label>
                                      <div class="col-lg-6">
                                          <input type="text" name="last_name" class="form-control" value="{{ $admin->last_name or old('last_name') }}" id="l-name" placeholder=" ">
                                      </div>
                                  </div>
                                 
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Birthday</label>
                                      
                                      <div class="col-lg-6">
                                        <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{{ ($admin->dob)? date('d-m-Y', strtotime($admin->dob))  : date('d-m-Y')  }}"  class="input-append date dpYears">
                                            <input type="text" value="{{ ($admin->dob)? date('d-m-Y', strtotime($admin->dob))  : old('birthday') }}" readonly="" name="dob"  size="16" class="form-control">
                                            <span class="input-group-btn add-on">
                                                <button class="btn btn-primary" type="button" style="padding:6px 10px"><i class="fa fa-calendar"></i></button>
                                            </span>
                                        </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                          <button type="submit" class="btn btn-success">Save</button>
                                          <button type="button" class="btn btn-default">Cancel</button>
                                      </div>
                                  </div>
                              {!! Form::close() !!}
                          </div>
                      </section>                    
                  </aside>
              </div>

              <!-- page end-->
          </section>
      </section>
      <!--main content end-->

</div>

@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('js/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<!--picker initialization-->
<script src="{{ asset('js/picker-init.js') }}"></script>

<script src="{{ asset('js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/form-validation-init.js')}}" type="text/javascript"></script>

@endpush