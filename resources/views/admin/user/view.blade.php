@extends('admin.layout.master')
@section('content')
    <!-- page head start-->
    <div class="page-head">
        <h3>
            User Details
        </h3>
      
    </div>
    <!-- page head end-->

    <!--body wrapper start-->
    <div class="wrapper">
        <div class="row">
            <div class="col-md-8  col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 ">
                                    <a class="btn btn-link  btn-sm pull-right" href="{{ route('admin.user.edit',[$user->id]) }}">Edit</a>
                            </div> 
                            <div class="clearfix"><br><br></div>
                            <div class="col-md-12 clearfix">
                                <table class="table">
                                    <tr>
                                        <th>First Name :</th><td>{{ $user->first_name }}</td>
                                        <th>Last Name :</th><td>{{ $user->last_name }}</td></tr>
                                    <tr>
                                         <th>Date Of Birth</th><td>{{ date('d-m-Y',strtotime($user->dob)) }}</td>
                                         <th>Gender</th><td>{{ ($user->gender == 1)?'Male':($user->gender == 0)?'Female':'' }}</td>
                                    </tr>
                                    <tr>
                                         <th>Mobile</th><td>{{ $user->mobile }}</td>
                                         <th>Email</th><td>{{ $user->email }}</td>
                                    </tr>
                                     
                                </table>
                                                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-warning">
                    @foreach($user->address as $address)
                        @php
                            @$sn +=1;
                        @endphp
                        <div class="panel-heading"> {{ ($user->address_id == $address->id)?'Default Address':'Address '.$sn }} </div>
                            <div class="panel-body">
                                <div class="row">
                                <div class="col-md-12">
                                    {{ $address->street }}
                                </div><!-- /* col -->
                            </div><!-- /* row -->
                        </div><!-- /* panel body -->
                    @endforeach
                </div><!-- /* col -->
            </div>
        </div>
    </div>
    <!--body wrapper end-->

@endsection