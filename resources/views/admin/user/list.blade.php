@extends('admin.layout.master')
@section('content')
<!--body wrapper start-->

<div class="wrapper">
    <div class="row">
	    <div class="col-sm-12">
	        <section class="panel">
	            <header class="panel-heading ">
	                User List
	                <span class="tools pull-right">
	                    <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
	                    <a class="t-close fa fa-times" href="javascript:;"></a>
	                </span>
	            </header>
	            <table class="table responsive-data-table data-table">
		            <thead>
		                <tr>
		                    <th>Sn &nbsp;&nbsp;</th>
		                    <th>Date</th>
		                    <th>Name</th>
		                    <th>Email</th>
		                    <th>Mobile</th>
		                    <th>Member</th>
		                    <th width="100px">Status</th>
		                    <th width="120px">Custom</th>
		                </tr>
		            </thead>
		            <tbody>
		            @foreach($users as $user)
		                <tr>
		                    <td>{{ @$sn=$sn+1}}</td>
		                    <td>{{ $user->created_at }}</td>
		                    <td class="p-name">{{ $user->first_name }}  {{ $user->last_name }}</td>
		                    <td >{{ $user->email }}</td>
		                    <td >{{ $user->mobile }}</td>
		                    <td>{!! ($user->member_status == 1)? '<span class="label label-success">Member</span>' :'<a href="'.route('admin.member.request.edit',$user->id).'" class="label label-danger btn btn-xs">Non Member</a>' !!}</td>
		                    <td>
		                        <button data-action="btnStatus" data-url="{{ route('admin.user.status',$user->id) }}"  class="label btn {{ ($user->status == 1) ?'btn-success':'btn-danger'}}">{{ ($user->status == 1)? 'Active' : 'Inactive' }}</button>
		                    </td>
		                    <td>
		                        <a href="{{ route('admin.user.view',[$user->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>
		                        <a href="{{ route('admin.user.edit',[$user->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
		                        <a data-action='reset-password' data-url="{{ route('admin.user.password.reset',$user->id) }}"  class="btn btn-warning btn-xs"><i class="fa fa-key"></i></a>
		                    </td>
		                </tr>
		            @endforeach
		            </tbody>
	            </table>
	        </section>
	    </div>

	</div>
</div>

@endsection
