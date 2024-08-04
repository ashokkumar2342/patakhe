@extends('front.layout.main')
@section('breadcrumb')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('front.home') }}">Home</a></li>
                <li class='active'>Checkout</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

@endsection
@section('content')
<!-- ============================================== HEADER : END ============================================== -->
<div class="checkout-box ">
    <div class="row">
        <div class="col-md-8">
            <div class="panel-group checkout-steps" id="accordion">
               
                <div class="panel panel-default checkout-step-01">
                    <!-- panel-heading -->
                        <div class="panel-heading">
                        <h4 class="unicase-checkout-title">
                            <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
                              <span>1</span>Shipping Information
                            </a>
                         </h4>
                    </div>
                    <!-- panel-heading -->
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <!-- panel-body  -->
                        <div class="panel-body">
                            <div class="row"> 
                                <div class="col-md-12">
                                    {{ Auth::guard('user')->user()->default_address->address }}
                                </div>
                                <div class="col-md-12">
                                    {{ Auth::guard('user')->user()->default_address->street }}
                                </div>
                                <div class="col-md-12">
                                    {{ Auth::guard('user')->user()->default_address->landmark  }}
                                </div>
                            </div>          
                        </div>
                        <!-- panel-body  -->

                    </div><!-- row -->
                </div>
                <!-- checkout-step-01  -->
                <!-- checkout-step-05  -->
                <div class="panel panel-default checkout-step-05">
                    <div class="panel-heading">
                      <h4 class="unicase-checkout-title">
                        <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseFive">
                            <span>2</span>Payment Information
                        </a>
                      </h4>
                    </div>
                    <div id="collapseFive" class="panel-collapse collapse">
                      <div class="panel-body">
                       <div class="row">
                           <div class="col-md-2">
                               <ul class="nav nav-pills ">
                                  <li class="active"><a data-toggle="pill" href="#home">COD</a></li>
                                </ul>
                           </div>
                           <div class="col-md-10">
                               <div class="tab-content">
                                  <div id="home" class="tab-pane fade in active">
                                    <h3>Only cash on delivery are avilable</h3>
                                  </div>
                                 
                                </div>
                           </div>
                       </div>



                      </div>
                    </div>
                </div>
               
            </div><!-- /.checkout-steps -->

    	
    	        @php
                if(Session::has('cart')){
                    $oldCart2 = Session::get('cart');
                    $cart = new App\Model\Catalog\Cart($oldCart2);
            		if($cart->items){
                		foreach($cart->items as $itemCart){
                    		$sopCart = App\Model\Catalog\SellOnProduct::find($itemCart['sop']);
                    		$productCart = App\Model\Catalog\Product::find($itemCart['pid']);
                    		$productItemCart = App\Model\Catalog\ProductItem::find($itemCart['iid']);
                    		if($productItemCart->saleUnit->weight){
                    		$qtyCart1 = implode('.',$itemCart['qty']);
                    		$itemCart['qty']['sv'] = str_pad($itemCart['qty']['sv'], 3, '0', STR_PAD_LEFT);
                    		$qtyCart2 = implode('.',$itemCart['qty']);
                    		}else{
                    			$qtyCart1 = $itemCart['qty'];
                    			$qtyCart2 = $itemCart['qty'];
                    		}
                            if($productItemCart->unit->alias == 'gm' && $productItemCart->saleUnit->alias == 'kg' || $productItemCart->unit->alias == 'ml' && $productItemCart->saleUnit->alias == 'ltr'){ 
                                $grandTotal = $sopCart->msp*(($qtyCart2*1000)/$productItemCart->qty);
                            }
                            elseif($productItemCart->unit->alias == 'pcs' && $productItemCart->saleUnit->alias == 'pcs'){
                                $grandTotal =($sopCart->msp/$productItemCart->qty)*$qtyCart2 ;
                            }
                            else{
                                $grandTotal = $sopCart->msp*$qtyCart2;
                            }
                            @$totalPriceCart2+=$grandTotal;
                        }
                     }
                 }
                 @endphp
                <div class="col-md-12">
                    @if(Session::has('cart'))
                    {!! Form::open(['route'=>'front.cart.checkout.order','method'=>'put']) !!}
                     <!-- checkout-step-05  -->
                    <br>                  
                    <div class="col-md-12 col-sm-12 sign-in-page">
                        <h4 class="checkout-subtitle">Delivering time for next day</h4>                                            
                        <div class="form-group clearfix">                 
                            <div class="col-md-12">
                                {!! Form::select('slot',['morning' => 'Morning 9-12','evening' => 'Evening 5-8', ], null, ['class'=>'form-control','placeholder'=>'Select','required']) !!}
                                <p class="text-danger">{{ $errors->first('slot') }}</p>
                            </div>
                        </div> 
                    </div>  
                    <div class="clearfix"><br></div>
                        <input type="hidden" name="at" value="{{ encrypt(round ($totalPriceCart2))}}">
                        <button class="btn btn-primary pull-right">Process order</button>
                        <div class="clearfix"><br></div>
                        <div class="clearfix"><br></div>
                    {!! Form::close() !!}
                    @else
                        <a class="btn btn-info" href="{{ route('front.home') }}">Continue Shopping</a>
                        <div class="clearfix"><br></div>
                        <div class="clearfix"><br></div>
                    @endif
                </div>
        </div>
        <div class="col-md-4">
            <!-- checkout-progress-sidebar -->
            <div class="checkout-progress-sidebar ">
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="unicase-checkout-title">Price Details</h4>
                        </div>
                        <div class="panel-body">
                            <ul class="nav nav-checkout-progress list-unstyled">
                                @if(@$carts = Session::has('cart'))
                                    <li>Price ( {{ count(@Session::get('cart')->items) }} item) 
                                        <span class="pull-right">   <i class="fa fa-inr"></i> 
                                            {{ round($totalPriceCart2) }}
                                        </span>
                                    </li>
                                    <li><br></li>
                                    <li>Delivery Charges <span class="pull-right text-success"><b>FREE</b></span></li>
                                @else
                                    <li class="text-danger">No items</li>
                                @endif
                            </ul>   
                            <br><br><br><br>    
                        </div>
                        <div class="panel-footer">
                            <b>Ammount Payable</b><span class="pull-right"><i class="fa fa-inr"></i> {{ round($totalPriceCart2)  }}</span>
                        </div>
                    </div>
                </div>
            </div> 
        <!-- checkout-progress-sidebar -->              
        </div>
    </div><!-- /.row -->
</div><!-- /.checkout-box -->

@endsection