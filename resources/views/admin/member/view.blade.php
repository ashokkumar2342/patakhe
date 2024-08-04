@extends('admin.layout.master')
@section('content')
    <!-- page head start-->
    <div class="page-head">
        <h3>Member details</h3>
    </div>
    <!-- page head end-->

    <!--body wrapper start-->
    <div class="wrapper">
        <div class="row">
        <div class="col-md-12">
                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#details">Member Details</a></li>
                  <li><a data-toggle="tab" href="#subMember">Sub Members</a></li>
                  <li><a data-toggle="tab" href="#address">Address</a></li>
                </ul>

                <div class="tab-content panel">
                    <div id="details" class="tab-pane fade in active  panel-body">
                        <div class="col-md-12">
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4">Membership Type </div>
                                        <div class="col-md-8"> : &nbsp;&nbsp; 
                                            @if($user->member->member_type == 0)
                                                {{ 'Free' }}
                                            @elseif($user->member->member_type == 1)
                                                {{ 'Red' }}
                                            @elseif($user->member->member_type == 2)
                                                {{ 'Green' }}
                                            @elseif($user->member->member_type == 3)
                                                {{ 'Blue' }}
                                            @endif
                                         </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4">Registered Time </div>
                                        <div class="col-md-8"> : &nbsp;&nbsp; {{ $user->member->created_at }} </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"><br></div>
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4">First Name </div>
                                        <div class="col-md-8"> : &nbsp;&nbsp; {{ $user->first_name }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4">Last Name </div>
                                        <div class="col-md-8"> : &nbsp;&nbsp; {{ $user->last_name }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"><br></div>
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4">Mobile </div>
                                        <div class="col-md-8"> : &nbsp;&nbsp; {{ $user->mobile }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4">Email </div>
                                        <div class="col-md-8"> : &nbsp;&nbsp; {{ $user->email }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"><br></div>
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4">Gender </div>
                                        <div class="col-md-8"> : &nbsp;&nbsp; {{ ($user->gender==1)?'Male':($user->gender==2)?'Female':'' }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4">Date Of Birth </div>
                                        <div class="col-md-8"> : &nbsp;&nbsp; {{($user->dob)? date('d-m-Y',strtotime($user->dob)):'' }}</div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="clearfix"><br></div>
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4">Membership Card </div>
                                        <div class="col-md-8"> : &nbsp;&nbsp; {{ $user->membership_card_no }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4">Adhar Card </div>
                                        <div class="col-md-8"> : &nbsp;&nbsp; {{ $user->aadhar_card_no }}</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="clearfix"><br></div>
                        </div><!-- /* col -->
                    </div>
                    <div id="subMember" class="tab-pane fade ">
                        <section class="panel-body">
                            <div class="panel-heading clearfix">Sub Member List <a href="{{ route('admin.submember.form',$user->id) }}" class="btn btn-primary pull-right">Add More</a></div>
                            <table class="table responsive-data-table data-table">
                                <thead>
                                    <tr>
                                        <th>Sn &nbsp;&nbsp;</th>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Mobile</th>                                
                                        <th>Email</th>
                                        <th width="100px">Custom</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->member->subMembers as $subMember)
                                    <tr>
                                        <td>{{ @$sn2 +=1 }}</td>
                                        <td>{{ $subMember->created_at->format('d-M-Y') }}</td>
                                        <td>{{ $subMember->first_name.' '.$subMember->last_name }}</td>
                                        <td>{{ $subMember->mobile }}</td>
                                        <td>{{ $subMember->email }}</td>
                                        <td>
                                            <a href="{{ route('admin.submember.view',[$subMember->id]) }}"  title="view" class="btn btn-primary btn-xs tooltips"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('admin.submember.edit',[$subMember->id]) }}"  title="view" class="btn btn-info btn-xs tooltips"><i class="fa fa-pencil"></i></a>
                                            <a data-action="delete" title="Delete" data-parent="tr" data-url="{{ route('admin.submember.delete',$subMember->id) }}"  class="btn btn-danger btn-xs tooltips" ><i class="fa fa-trash-o"></i></a>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </section>
                    </div>
                    <div id="address" class="tab-pane fade">
                        @foreach($user->address as $address)
                            @php
                                @$sn +=1;
                            @endphp
                            <div class="panel-heading"> {{ ($user->address_id == $address->id)?'Default Address':'Address '.$sn }} </div>
                                <div class="panel-body">
                                    <div class="row">
                                    @if($address->address)
                                    <div class="col-md-12">
                                       {{ $address->address }}
                                    </div><!-- /* col -->
                                    @endif
                                    @if($address->street)
                                    <div class="col-md-12">
                                        Street: {{ $address->street }}
                                    </div><!-- /* col -->
                                    @endif
                                    @if($address->landmark)
                                    <div class="col-md-12">
                                        Landmark {{ $address->landmark }}
                                    </div><!-- /* col -->
                                    @endif
                                </div><!-- /* row -->
                            </div><!-- /* panel body -->
                        @endforeach
                    </div>
                </div>
            </div>
           
        </div><!-- /* row -->
    </div><!-- /* wrapper -->
@endsection
