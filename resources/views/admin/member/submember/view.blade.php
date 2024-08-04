@extends('admin.layout.master')
@section('content')
    <!-- page head start-->
    <div class="page-head">
        <h3>View Sub Member details</h3>
    </div>
    <!-- page head end-->

    <!--body wrapper start-->
    <div class="wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="clearfix"><br></div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">First Name </div>
                            <div class="col-md-8"> : &nbsp;&nbsp; {{ $subMember->first_name }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">Last Name </div>
                            <div class="col-md-8"> : &nbsp;&nbsp; {{ $subMember->last_name }}</div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"><br></div>
                <div class="row ">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">Mobile </div>
                            <div class="col-md-8"> : &nbsp;&nbsp; {{ $subMember->mobile }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">Email </div>
                            <div class="col-md-8"> : &nbsp;&nbsp; {{ $subMember->email }}</div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"><br></div>
                <div class="row ">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">Gender </div>
                            <div class="col-md-8"> : &nbsp;&nbsp; {{ ($subMember->gender==1)?'Male':($subMember->gender==2)?'Female':'' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">Date Of Birth </div>
                            <div class="col-md-8"> : &nbsp;&nbsp; {{ date('d-m-Y',strtotime($subMember->dob)) }}</div>
                        </div>
                    </div>
                    
                </div>
                <div class="clearfix"><br></div>
                <a class="btn btn-info pull-right" href="{{ URL::previous() }}"><i class="fa fa-arrow-left"></i> Go back</a>
            </div>
        </div>
    </div>
    <!--body wrapper end-->

@endsection