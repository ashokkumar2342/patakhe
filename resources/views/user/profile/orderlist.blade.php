@extends('front.layout.main')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-3 " style="min-height: 300px">
			@include('user.include.side_menu')
		</div>
		<div class="col-md-9" style="background-color: white; padding:30px">
			@include('user.include.member_request')	
			
			<div class="col-md-12 table-responsive" >
				<h3 style="margin-bottom: 25px;padding-bottom: 10px;border-bottom: 1px solid #c6c6c6;"><strong>	Order Details</strong></h3>
				 
				 <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>                            
                                <th>Item</th>
                                <th>Amount</th>
                                <th>slot</th>
                                <th width="70px">Status</th>
                                <th width="120px">Custom</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $data)
                                @if($data->user && $data->user->id == Auth::guard('user')->user()->id)
                                    <tr>                                     
                                        <td>{{ $data->created_at }}</td>
                                        <td>{{ count($data->orderItems) }}</td>
                                        <td class="p-name"> {{ $data->amount }}</td>
                                        <td class="p-name"> {{ $data->slot }}</td>
                                        <td><span  class="label label-danger  label-xs">{{ $data->orderStatus->name or 'pending'  }}</span>
                                        </td>
                                        <td>
                                            <a class="btn btn-xs btn-primary" title="cancel" href="{{ route('user.order.view',[$data->ukey]) }}" class="icon"><i class="fa fa-eye"></i></a>
                                            @if($data->status == 1)
                                                <a onclick="return confirm('Are you sure to cancel this order ?')" class="btn btn-danger btn-xs" title="cancel" href="{{ route('user.order.cancel',[$data->ukey]) }}"><i class="fa fa-times"></i></a>   
                                            @endif                                      
                                        </td>                                 
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
            <div class="col-md-12">
              
                {{ $orders->links() }}
               
            </div>
        </div>			
		 	</div>

		</div>
	</div>
</div>
@endsection