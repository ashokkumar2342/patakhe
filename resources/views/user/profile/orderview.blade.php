@extends('front.layout.main')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-3 " style="min-height: 300px">
			@include('user.include.side_menu')
		</div>
		<div class="col-md-9" style="background-color: white; padding:30px">
			@include('user.include.member_request')	
			
			<div class="col-md-12" >
				<h3 style="margin-bottom: 25px;padding-bottom: 10px;border-bottom: 1px solid #c6c6c6;"><strong>	Order Details</strong></h3>
				 
				 <table class="table responsive-data-table data-table">
                    <thead>
                        <tr>
                            <th>Sn &nbsp;&nbsp;</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Custom</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItems as $orderItem)
                            @php
                                $product = App\Model\Catalog\Product::find($orderItem->pid);
                                $productItem = App\Model\Catalog\ProductItem::find($orderItem->iid);
                                $qty2 = $productItem->qty;
                                if($productItem->unit->alias == 'gm' && $productItem->saleUnit->alias == 'kg' || $productItem->unit->alias == 'ml' && $productItem->saleUnit->alias == 'ltr'){ 
                                    $grandTotal = $orderItem->msp*(($orderItem->qty*1000)/ $productItem->qty);
                                }
                                elseif($productItem->unit->alias == 'pcs' && $productItem->saleUnit->alias == 'pcs'){
                                    $grandTotal =($orderItem->msp/$qty2)*$orderItem->qty ;
                                }
                                else{
                                    $grandTotal = $orderItem->msp*$orderItem->qty;
                                }
                                @$totalPrice += $grandTotal;
                            @endphp
                                <tr>
                                    <td>{{ @$sn=$sn+1 }}</td>
                                    <td><img src="{{ route('front.product.image.get',['50','50','80',$product->image->first()->name]) }}"></td>
                                    <td class="p-name">{{ $product->name }} ({{ $productItem->qty.' '.$productItem->unit->alias}})</td>
                                    <td>{{ $grandTotal }}</td>
                                    <td>{{ $orderItem->qty }} {{ $productItem->saleUnit->alias }}</td>
                                    <td>
                                        @if($orderItem->status == 2)
                                            <label class="label label-danger">cancelled</label>
                                        @endif                                       
                                    </td>
                                    <td>
                                        @if($orderItem->status == 1)
                                            <a onclick="return confirm('Are you sure to cancel this order ?')" href="{{ route('user.order.item.cancel',$orderItem->ukey) }}">Cancel</a>
                                        @endif                                       
                                    </td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>	
                <h3 class="text-info">Total Amount : <span class="text-warning"><i class="fa fa-inr"></i> {{ @$totalPrice }}</span></h3>		
		 	</div>
            

		</div>
	</div>
</div>
@endsection
