@extends('front.layout.main')
@section('title')
{{$productItem->name or ''}}
@endsection
@section('keywords')
{{$productItem->keywords or ''}}
@endsection
@section('description')
{{$productItem->description or ''}}
@endsection
@push('links')
<link href="{{ asset('assets/css/lightbox.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="body-content outer-top-xs">
	<div class='container-fluid'>
		<div class='row single-product'>
			<div class='col-md-3 sidebar'>
			@include('front.include.leftsidebar')
			</div>
			<div class='col-md-9'>
            <div class="detail-block">
				<div class="row  wow fadeInUp">                
				     <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
					    <div class="product-item-holder size-big single-product-gallery small-gallery">
					        <div id="owl-single-product">
					        @foreach($product->image as $image)
					        	@php 
					        	    @$n = $n+1; 
					        	    $image = route('front.product.image.get',['600','600','90',$image->name]);
					        	@endphp
					            <div class="single-product-gallery-item " id="slide{{ $n }}">
					                <a data-lightbox="image-1" data-title="{{ $product->name }} ({{ $productItem->qty.' '.$productItem->unit->alias }})" href="{{ $image }} " class="text-center">
					                <img class="img-responsive" align="middle" 
					                	src="{{ $image }}" 
					                	title="{{ $product->name }} ({{ $productItem->qty.' '.$productItem->unit->alias }})"
					                	alt="{{ $product->name }} ({{ $productItem->qty.' '.$productItem->unit->alias }})" 
					                />		
					            </a>
					            </div><!-- /.single-product-gallery-item -->
					            
					        @endforeach
					        </div><!-- /.single-product-slider -->
					        <div class="single-product-gallery-thumbs gallery-thumbs">
					        	@foreach($product->image as $image)
					        	@php @$n = $n+1; @endphp
					            <div id="owl-single-product-thumbnails">
					                <div class="item">
					                    <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide{{ $n }}">
					                        <img class="img-responsive"  alt="" src="{{ route('front.product.image.get',['70','70','70',$image->name]) }}"  />
					                    </a>
					                </div>               
					            </div><!-- /#owl-single-product-thumbnails -->	
					            @endforeach
					        </div><!-- /.gallery-thumbs -->
					    </div><!-- /.single-product-gallery -->
					</div><!-- /.gallery-holder -->        			
					<div class='col-sm-6 col-md-7 product-info-block'>
						<div class="product-info">
							<h1 class="name">{{ $product->name }} ({{ $productItem->qty.' '.$productItem->unit->alias }})</h1>
							
							<div class="stock-container info-container m-t-10">
								<div class="row">
									<div class="col-sm-2">
										<div class="stock-box">
											<span class="label">Availability :</span>
										</div>	
									</div>
									<div class="col-sm-9">
										<div class="stock-box">
											@if(@$sellOnProduct)
											<span class="text-success">In Stock</span>
											@else
											<span class="value">Out Of Stock</span>
											@endif
										</div>	
									</div>
								</div><!-- /.row -->	
							</div><!-- /.stock-container -->
							<div class="description-container m-t-20">
								{{ ($productItem->description)?$productItem->description : $product->description or '' }}
							</div><!-- /.description-container -->
							@if(@$sellOnProduct)
							<div class="price-container info-container m-t-20">
								<div class="row">
									<div class="col-sm-12">
										<div class="price-box">
											@if($productItem->mrp)
	                                            <span class="price"><i class="fa fa-inr"></i> {{ $sellOnProduct->msp }}</span>
												&nbsp;&nbsp;&nbsp;&nbsp;
												<span class="price-before-discount"><i class="fa fa-inr"></i> {{ $productItem->mrp }}</span>
												@if($productItem->mrp>$sellOnProduct->msp)
	                                            @php
	                                                $discRate = $productItem->mrp-$sellOnProduct->msp;

	                                            @endphp
	                                            	&nbsp;&nbsp;
	                                            	<span style="color:#0a0">{{ round($discRate/$productItem->mrp*100) }} % off</span>
	                                            @endif
	                                        @else
                                            	<span class="price-before-discount"><i class="fa fa-inr"></i>{{ $sellOnProduct->msp }}</span>
                                        	@endif
										</div>
									</div>
								
								</div><!-- /.row -->
							</div><!-- /.price-container -->
							<div class="quantity-container info-container">
							@php 
								$oldCart = Session::get('cart');
								$cart = new App\Model\Catalog\Cart($oldCart);
								
							@endphp
								<div class="row">
								@if($productItem->saleUnit->weight)
									@if(@array_key_exists($productItem->id,$cart->items))
										@php
										 $prQty = $cart->items[$productItem->id]['qty'];
										@endphp
									@endif
									<div class="col-sm-2">
										<span class="label">Qty :</span>
									</div>
									{{ Form::open(['route'=>'front.cart.add','method'=>'put']) }}
								    <input type="hidden" name="puk" value="{{ encrypt($product->id) }}">
								    <input type="hidden" name="iid" value="{{ encrypt($productItem->id) }}">
								    <input type="hidden" name="sop" value="{{ encrypt($sellOnProduct->id) }}">
									<div class="col-md-10">
										<div class="row">
											<div class="col-md-4 col-xs-4">
												<div class="col-md-8">
													<div class="cart-quantity">
														<div class="quant-input">
											                <div class="arrows">
											                  	<div class="arrow kgPlus gradient"><span class="ir"><i class="icon fa fa-sort-asc "></i></span></div>
											                  	<div class="arrow kgMinus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
											                </div>
											                <input type="text" name="lv" value="{{ (count(@$prQty))?$prQty['lv']:1 }}">
										              	</div>
										            </div>
									            </div>
									            <div class="col-md-4"><h4 >{{collect(explode(',',$productItem->saleUnit->alias))->first()}}</h4></div>
											</div>
											<div class="col-md-5 col-xs-5">
												<div class="col-md-8">
													<div class="cart-quantity">
														<div class="quant-input" >
											                <div class="arrows" style="margin-right: -30px">
											                  	<div class="arrow gmPlus gradient"><span class="ir"><i class="icon fa fa-sort-asc "></i></span></div>
											                  	<div class="arrow gmMinus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
											                </div>
											                <input type="text" name="sv" value="{{ (count(@$prQty))?$prQty['sv']:0 }}">
										              	</div>
										            </div>
									            </div>
									            <div class="col-md-4"><h4 >@if($productItem->saleUnit->alias == 'kg') gm @elseif($productItem->saleUnit->alias == 'ltr') ml  @endif </h4></div>
											</div>
										</div>
										
									</div>
									<div class="clearfix"><br><br></div>
									<div class="col-md-12 col-md-offset-3 ">
											<br>
										@if(@!array_key_exists($productItem->id, $cart->items))
										 <button type="submit"  class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</button>
										@else
    									    <button type="submit"  class="btn btn-info"><i class="fa fa-shopping-cart inner-right-vs"></i> UPDATE CART</button>
    									@endif
									</div>
									{!! Form::close() !!}
									
								</div><!-- /.row -->
									@else
									<div class="col-sm-2">
										<span class="label">Qty :</span>
									</div>
									{{ Form::open(['route'=>'front.cart.add','method'=>'put']) }}
									<input type="hidden" name="puk" value="{{ encrypt($product->id) }}">
								    <input type="hidden" name="iid" value="{{ encrypt($productItem->id) }}">
								    <input type="hidden" name="sop" value="{{ encrypt($sellOnProduct->id) }}">
									<div class="col-md-4">
										<div class="col-md-8">
										<div class="cart-quantity">
											<div class="quant-input">
								                <div class="arrows">
								                  	<div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc "></i></span></div>
								                  	<div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
								                </div>
								                <input type="text" name="qt" value="{{  @(array_key_exists($productItem->id, $cart->items))? $cart->items[$productItem->id]['qty'] : 1}}">
							              	</div>
							            </div>
							            </div>
							            <div class="col-md-4"><h4 >{{ $productItem->saleUnit->alias or '' }}</h4></div>
									</div>
									<div class="col-md-6">
									    @if(@array_key_exists($productItem->id, $cart->items))
										 <button type="submit"  class="btn btn-info"><i class="fa fa-shopping-cart inner-right-vs"></i> UPDATE CART</button>
										 @else
										 <button type="submit"  class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</button>
    									
    									@endif
									</div>
									{!! Form::close() !!}
									
								</div><!-- /.row -->
									@endif
							</div><!-- /.quantity-container -->
							@else
								<div style="margin-top: 50%"></div>
							@endif

						</div><!-- /.product-info -->
					</div><!-- /.col-sm-7 -->
					<div>
						@foreach ($product->productItem as $productItem1)
							<a href="{{ route('front.product.details',[$product->name,$category->name,$category->ukey,$productItem1->ukey,$product->ukey]) }}" 
							style="border:1px dashed #ccc;padding: 10px;margin-left: 10px">{{ $productItem1->qty.' '.$productItem1->unit->alias }}</a>
						@endforeach
					</div>
				</div><!-- /.row -->
                </div>
							
				@if($reletedPrds->count())	
				<!-- ============================================== SCROLL TABS ============================================== -->
				<section class="section featured-product wow fadeInUp">
					<h3 class="section-title">{{ $reletedPrds->first()->cName }}</h3>
					<div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
						@foreach($reletedPrds as $reletedPrd)
						@php
							$imgname = ($reletedPrd->piImage)?$reletedPrd->piImage:$reletedPrd->pImage;
						@endphp
						<div class="item item-carousel">
							<div class="products">						
								<div class="product">		
									<div class="product-image">
										<div class="image">
											<a alt="{{ $reletedPrd->pName }} ({{ $reletedPrd->piQty.' '.$reletedPrd->piUnit }})" title="{{ $reletedPrd->pName }} ({{ $reletedPrd->piQty.' '.$reletedPrd->piUnit }})" href="{{ route('front.product.details',[$reletedPrd->pName,$reletedPrd->cName,$reletedPrd->cUkey,$reletedPrd->piUkey,$reletedPrd->pUkey]) }}">
												<img src="{{ route('front.product.image.get',['176','192','70',$imgname]) }}" alt="{{ $reletedPrd->pName }} ({{ $reletedPrd->piQty.' '.$reletedPrd->piUnit }})"
													title="{{ $reletedPrd->pName }} ({{ $reletedPrd->piQty.' '.$reletedPrd->piUnit }})" >
											</a>
										</div>			   
									</div><!-- /.product-image -->
									<div class="product-info text-left">

										<h3 class="name">
											<a title="{{ $reletedPrd->pName }} ({{ $reletedPrd->piQty.' '.$reletedPrd->piUnit }})" alt="{{ $reletedPrd->pName }} ({{ $reletedPrd->piQty.' '.$reletedPrd->piUnit }})" href="{{ route('front.product.details',[$reletedPrd->pName,$reletedPrd->cName,$reletedPrd->cUkey,$reletedPrd->piUkey,$reletedPrd->pUkey]) }}">{{ $reletedPrd->pName }} ({{ $reletedPrd->piQty.' '.$reletedPrd->piUnit }})</a>
										</h3>								
										<div class="product-price">	
				                                <span class="price"><i class="fa fa-inr"></i>{{ $reletedPrd->sopMsp }}</span>
				                                @if($reletedPrd->piMrp && $reletedPrd->piMrp > $reletedPrd->sopMsp)<span class="price-before-discount"><i class="fa fa-inr"></i>{{ $reletedPrd->piMrp }} </span>&nbsp;&nbsp;
				                                <span style="color:#0a0; margin-top: 5px">{{  round($reletedPrd->piMrp-$reletedPrd->sopMsp/$reletedPrd->piMrp*100) }} %</span>
				                                @endif
										</div><!-- /.product-price -->						
									</div><!-- /.product-info -->							
								</div><!-- /.product -->		      
							</div><!-- /.products -->
						</div><!-- /.item -->
						@endforeach 					
						</div><!-- /.home-owl-carousel -->
				</section><!-- /.section -->
				<!-- ============================================== SCROLL TABS : END ============================================== -->
				@endif
					<!-- ============================================== UPSELL PRODUCTS : END ============================================== -->
			</div><!-- /.col -->
			<div class="clearfix"></div>
		</div><!-- /.row -->
	</div><!-- /.container -->
</div><!-- /.body-content -->


</html>

@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('assets/js/lightbox.min.js') }}"></script>
<script>
    @if($errors->first())
        alert('please choose a valid quantity');
    @endif
</script>
@endpush