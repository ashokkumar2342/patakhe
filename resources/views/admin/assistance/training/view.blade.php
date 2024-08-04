@extends('admin.layout.master')
@section('content')
    <!-- page head start-->
    <div class="page-head">
        <h3>
            Training details
        </h3>
        
    </div>
    <!-- page head end-->

    <!--body wrapper start-->
    <div class="wrapper">
        <div class="row">
            <div class="col-md-10  col-md-offset-1">
                <div class="panel panel-info">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">Apply For </div>
                                            <div class="col-md-8">: &nbsp;&nbsp;  {{ $training->apply_for }}</div>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="clearfix"><br></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2">Message :</div>
                                            <div class="col-md-10">: {{ $training->message }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">Membership Type </div>
                                            <div class="col-md-8"> : &nbsp;&nbsp; 
                                                @if($training->user->member_type == 1)
                                                    {{ 'Red' }}
                                                @elseif($training->user->member_type == 2)
                                                    {{ 'Green' }}
                                                @elseif($training->user->member_type == 3)
                                                    {{ 'Blue' }}
                                                @endif
                                             </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">Reffered By </div>
                                            <div class="col-md-8"> : &nbsp;&nbsp; {{ $training->user->referred_by }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"><br></div>
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">First Name </div>
                                            <div class="col-md-8"> : &nbsp;&nbsp; {{ $training->user->first_name }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">Last Name </div>
                                            <div class="col-md-8"> : &nbsp;&nbsp; {{ $training->user->last_name }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"><br></div>
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">Mobile </div>
                                            <div class="col-md-8"> : &nbsp;&nbsp; {{ $training->user->mobile }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">Email </div>
                                            <div class="col-md-8"> : &nbsp;&nbsp; {{ $training->user->email }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"><br></div>
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">Membership Card </div>
                                            <div class="col-md-8"> : &nbsp;&nbsp; {{ $training->user->membership_card_no }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">Adhar Card </div>
                                            <div class="col-md-8"> : &nbsp;&nbsp; {{ $training->user->aadhar_card_no }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"><br></div>
                                <div class="row ">
                                <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">Gender </div>
                                            <div class="col-md-8"> : &nbsp;&nbsp; {{ ($training->user->gender==1)?'Male':($training->user->gender==2)?'Female':'' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">Date Of Birth </div>
                                            <div class="col-md-8"> : &nbsp;&nbsp; {{ date('d-m-Y',strtotime($training->user->dob)) }}</div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="clearfix"><br></div>
                                
                                
                            </div>
                        </div>
                       
                       

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--body wrapper end-->

@endsection