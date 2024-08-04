@extends('admin.layout.master')
@section('content')
    <!-- page head start-->
    <div class="page-head">
        <h3>
            Member Request List
        </h3>
        <span class="sub-title">Welcome to Icaps User List</span>
        <div class="state-information">
            <div class="state-graph">
                <div id="balance" class="chart"></div>
                <div class="info">New Request {{ $members->count() }} </div>
            </div>
            <div class="state-graph">
                <div id="item-sold" class="chart"></div>
                <div class="info">Total Member {{ App\Member::where(['status'=>'1'])->count()  }} </div>
            </div>
        </div>
    </div>
    <!-- page head end-->

    <!--body wrapper start-->
    <div class="wrapper">

        <header class="panel-heading">
          All Member List
          <span class="pull-right">
              <button type="button" id="loading-btn" class="btn btn-warning btn-xs"><i class="fa fa-refresh"></i> Refresh</button>
          </span>
        </header>
        <div class="panel-body">
            <div class="row">
              <div class="col-md-12">
                  <div class="input-group"><input type="text" placeholder="Search Here" class="input-sm form-control"> <span class="input-group-btn">
                  <button type="button" class="btn btn-sm btn-success"> Go!</button> </span></div>
              </div>
          </div>
        </div>
        <table class="table table-hover p-table table-responsive">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>User Name</th>
                    <th>Mobile</th>
                    <th width="100px">Status</th>
                    <th width="100px">Custom</th>
                </tr>
            </thead>
            <tbody>
            @foreach($members as $member)
            @if($member->UserDetails)
                <tr>
                    <td>{{ $member->created_at }}</td>
                    <td>{{ $member->UserDetails->first_name or ' ' }} {{ $member->UserDetails->last_name or ' '  }}</td>
                    <td class="p-name"> {{ $member->UserDetails->mobile or ' ' }}</td>
                    <td>
                        <span class="label label-{{ ($member->userDetails->status == 1)?'success':'danger' }}">{{ ($member->userDetails->status == 1)? 'Active' : 'Inactive' }}</span>
                    </td>
                    <td>
                        <a href="{{ route('admin.user.view',$member->user_id) }}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>  </a>
                        <a href="{{ route('admin.user.edit',[$member->user_id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> </a>
                        <a href="javascript:;"  onclick="event.preventDefault(); document.getElementById('delete{{ $member->id }}').submit();" class="btn btn-danger btn-xs", ><i class="fa fa-trash-o"></i>  </a>
                        {!! Form::open(['route'=>['admin.member.request.delete',$member->user_id],'method'=>'delete','class'=>'hidden',  'id'=>'delete'.$member->user_id]) !!}

                        {!! Form::close() !!}
                    </td>
                </tr>
            @endif
            @endforeach
            </tbody>
        </table> 
        <div class="row">
            <div class="col-md-12">
                {{ $members->links() }}
            </div>
        </div>
    </div>
    <!--body wrapper end-->

@endsection