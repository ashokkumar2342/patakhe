@extends('admin.layout.master')
@section('content')
<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
	    <div class="col-sm-12">
	        <section class="panel">
	            <header class="panel-heading ">
	                Seller List
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
		                    <th>Mobile</th>
		                    <th>Email</th>
		                    <th width="100px">Status</th>
		                    <th width="100px">Custom</th>
		                </tr>
		            </thead>
		            <tbody>
		            @foreach($sellers as $seller)
		                <tr>
		                	<td>{{ @$sn=$sn+1}}</td>
		                    <td>{{ $seller->created_at }}</td>
		                    <td class="p-name">{{ $seller->first_name }}  {{ $seller->last_name }}</td>
		                    <td >{{ $seller->mobile }}</td>
		                    <td >{{ $seller->email }}</td>
		                    <td>
		                        <button data-action="btnStatus" data-url="{{ route('admin.seller.status',$seller->id) }}"  class="label btn {{ ($seller->status == 1) ?'btn-success':'btn-danger'}}">{{ ($seller->status == 1)? 'Active' : 'Inactive' }}</button>
		                    </td>
		                    <td>
		                        <a href="" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>  </a>
		                        <a href="{{ route('admin.seller.edit',[$seller->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i>  </a>
		                       	<a data-action='reset-password' data-url="{{ route('admin.seller.password.reset',$seller->id) }}"  class="btn btn-warning btn-xs"><i class="fa fa-key"></i></a>
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
