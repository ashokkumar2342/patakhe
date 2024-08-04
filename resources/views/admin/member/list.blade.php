@extends('admin.layout.master')
@section('content')
    <!--body wrapper start-->
<div class="wrapper">
    <div class="row">
	    <div class="col-sm-12">
	        <section class="panel">
	            <header class="panel-heading ">
	                Member List
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
		                    <th>Customer Id</th>
		                    <th>Name</th>
		                    <th>Type</th>                        
		                    <th>Mobile</th>
		                    <th>DOB</th>
		                    <th width="100px">Status</th>
		                    <th width="130px">Custom</th>
		                </tr>
		            </thead>
		            <tbody>
			            @foreach($members as $member)
			            @if($member->user)
	                    <tr>
	                        <td>{{ @$sn=$sn+1}}</td>
	                        <td>{{$member->user->created_at}}</td>
	                        <td>{{ $member->user->customer_id }}</td>
	                        <td class="p-name">{{ $member->user->first_name }}  {{ $member->user->last_name }}</td>
	                        <td>@if($member->member_type == 0){{ 'free'  }}@elseif($member->member_type == 1){{ 'Red'  }}@elseif($member->member_type == 2){{ 'Green' }}@elseif($member->member_type == 1){{ 'Blue' }}@endif</td>
	                        <td >{{ $member->user->mobile }}</td>
	                        <td>{{ ($member->user->dob)?date('d-m-Y',strtotime($member->user->dob)):'' }}</td>
	                        
	                        <td>
	                            <button data-action="btnStatus" data-url="{{ route('admin.member.status',$member->user->id) }}" data-parent="tr" class="label {{ ($member->user->status == 1) ?'btn-success':'btn-danger'}} btn btn-xs">{{ ($member->user->status == 1)? 'Active' : 'Inactive' }}</button>
	                        </td>
	                        <td>
	                            <a href="{{ route('admin.member.view',[$member->user->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>
	                            <a href="{{ route('admin.member.edit',[$member->user->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
	                            <a data-action='reset-password' data-url="{{ route('admin.member.password.reset',$member->user->id) }}"  class="btn btn-warning btn-xs"><i class="fa fa-key"></i></a>
	                            @if(Auth::guard('admin')->user()->permission == 1)
	                            <button data-action="delete" data-parent="tr" data-url="{{ route('admin.member.delete',$member->id) }}"  class="btn btn-danger btn-xs" ><i class="fa fa-trash-o"></i></button>
	                            @endif  
	                        </td>
	                    </tr>
	                    @endif
	                	@endforeach
	               	</tbody>
	            </table>
	        </section>
	    </div>

	</div>
</div>


@endsection
@push('scripts')
<script type="text/javascript">
function deleteData(url){
	alert(url);
}
</script>
@endpush
