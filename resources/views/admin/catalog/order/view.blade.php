@extends('admin.layout.master')
@section('content')
    <!-- page head start-->
    <div class="page-head">
        <h3>
            order details
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
                               
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">Membership Type </div>
                                            <div class="col-md-8"> : &nbsp;&nbsp; 
                                                @if($order->user->member_type == 0)
                                                    {{ 'Free' }}
                                                @elseif($order->user->member_type == 1)
                                                    {{ 'Red' }}
                                                @elseif($order->user->member_type == 2)
                                                    {{ 'Green' }}
                                                @elseif($order->user->member_type == 3)
                                                    {{ 'Blue' }}
                                                @endif
                                             </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">Reffered By </div>
                                            <div class="col-md-8"> : &nbsp;&nbsp; {{ $order->user->referred_by }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"><br></div>
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">First Name </div>
                                            <div class="col-md-8"> : &nbsp;&nbsp; {{ $order->user->first_name }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">Last Name </div>
                                            <div class="col-md-8"> : &nbsp;&nbsp; {{ $order->user->last_name }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"><br></div>
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">Mobile </div>
                                            <div class="col-md-8"> : &nbsp;&nbsp; {{ $order->user->mobile }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">Email </div>
                                            <div class="col-md-8"> : &nbsp;&nbsp; {{ $order->user->email }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"><br></div>
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">Membership Card </div>
                                            <div class="col-md-8"> : &nbsp;&nbsp; {{ $order->user->membership_card_no }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">Adhar Card </div>
                                            <div class="col-md-8"> : &nbsp;&nbsp; {{ $order->user->aadhar_card_no }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"><br></div>
                                <div class="row ">
                                <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">Gender </div>
                                            <div class="col-md-8"> : &nbsp;&nbsp; {{ ($order->user->gender==1)?'Male':($order->user->gender==2)?'Female':'' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">Date Of Birth </div>
                                            <div class="col-md-8"> : &nbsp;&nbsp; {{($order->user->dob)? date('d-m-Y',strtotime($order->user->dob)):'' }}</div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="clearfix"><br></div>
                                
                                
                            </div><!-- col -->
                        </div><!-- end row -->
                        
                        
                    </div><!-- panel body -->
                </div><!-- panel -->
                    @foreach($order->user->address as $address)
                        @php
                            @$sn +=1;
                        @endphp
                        <div class="panel panel-warning">
                        <div class="panel-heading"> {{ ($order->user->address_id == $address->id)?'Default Address':'Address '.$sn }} </div>
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
                        </div>
                    @endforeach
                <div class="panel panel-info">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">                               
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
                                                $productItem =  App\Model\Catalog\ProductItem::find($orderItem->iid);
                                               
                                                $qty2 = $orderItem->qty;
                                                
                                                if($productItem->unit->alias == 'gm' && $productItem->saleUnit->alias == 'kg' || $productItem->unit->alias == 'ml' && $productItem->saleUnit->alias == 'ltr'){ 
                                                    $grandTotal = $orderItem->msp*(($orderItem->qty*1000)/ $productItem->qty);
                                                }
                                                elseif($productItem->unit->alias == 'pcs' && $productItem->saleUnit->alias == 'pcs'){
                                                    $grandTotal =($orderItem->msp/$productItem->qty)*$qty2 ;
                                                }
                                                else{
                                                    $grandTotal = $orderItem->msp*$qty2;
                                                }
                                                @$totalPrice += $grandTotal; 
                                            @endphp
                                                <tr>
                                                    <td>{{ @$sn=$sn+1 }}</td>
                                                    <td><img src="{{ (@$product->image)?route('front.product.image.get',['50','50','80',$product->image->first()->name]):'' }}"></td>
                                                    <td class="p-name">{{ @$product->name }} </td>
                                                    <td>{{ @$grandTotal }}</td>
                                                            
                                                        <td>{{ @$qty2 }} {{@$productItem->saleUnit->alias}} </td>
                                                    <td>
                                                        @if($orderItem->status == 2)
                                                            <label class="label label-danger">canceled</label>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($orderItem->status == 1)
                                                            <a href="{{ route('admin.product.order.item.cancel',$orderItem->id) }}">cancel</a>
                                                        @endif

                                                    </td>
                                                     
                                                </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if(@$totalPrice)<div class="col-md-12"><h3 class="text-warning">Total amount : <i class="fa fa-inr"></i> {{@round($totalPrice) }}</h3></div>@endif
                        </div>
                    </div><!-- panel body -->
                </div><!-- panel -->
            </div>
        </div>
    </div>
    <!--body wrapper end-->

@endsection