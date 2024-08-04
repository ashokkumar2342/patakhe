@extends('front.layout.main')
@section('title')
{{$category->name or ''}}
@endsection
@section('keywords')
{{$category->keywords or ''}}
@endsection
@section('description')
{{$category->description or ''}}
@endsection
@section('content')
<div class="body-content outer-top-xs">
    <div class='container-fluid'>
        <div class='row'>
            <div class="clearfix  col-md-3 sidebar">
                @include('front.include.leftsidebar')
            </div><!-- /.sidemenu-holder -->
            <div class='col-md-9'>
				@if($products->count())
				<div class="search-result-container ">
					<div id="myTabContent" class="tab-content category-list">
						<div class="tab-pane active " id="grid-container">
							<div class="category-product">
								<div class="row">		
									@foreach($products as $product)
									@php
										$imgname = ($product->piImage)?$product->piImage:$product->pImage;
									@endphp
									<div class="col-sm-6 col-md-4 wow fadeInUp">
										<div class="products">											
											<div class="product">		
												<div class="product-image">
													<div class="image">
														<a title="{{ $product->pName }} ({{ $product->piQty.' '.$product->piUnit }})" alt="{{ $product->pName }} ({{ $product->piQty.' '.$product->piUnit }})"  href="{{ route('front.product.details',[$product->pName,$product->cName,$product->cUkey,$product->piUkey,$product->pUkey]) }}">
															<img src="{{ route('front.product.image.get',['176','192','70',$imgname]) }}" alt="{{ $product->pName }} ({{ $product->piQty.' '.$product->piUnit }})"
																title="{{ $product->pName }} ({{ $product->piQty.' '.$product->piUnit }})" >
														</a>
													</div>			   
												</div><!-- /.product-image -->
												<div class="product-info text-left">

													<h3 class="name">
														<a title="{{ $product->pName }} ({{ $product->piQty.' '.$product->piUnit }})" alt="{{ $product->pName }} ({{ $product->piQty.' '.$product->piUnit }})" href="{{ route('front.product.details',[$product->pName,$product->cName,$product->cUkey,$product->piUkey,$product->pUkey]) }}">{{ $product->pName }} ({{ $product->piQty.' '.$product->piUnit }})</a>
													</h3>								
													<div class="product-price">	
							                                <span class="price"><i class="fa fa-inr"></i>{{ $product->sopMsp }}</span>
							                                @if($product->piMrp && $product->piMrp > $product->sopMsp)<span class="price-before-discount"><i class="fa fa-inr"></i>{{ $product->piMrp }} </span>&nbsp;&nbsp;
							                                <span style="color:#0a0; margin-top: 5px">{{  round($product->piMrp-$product->sopMsp/$product->piMrp*100) }} %</span>
							                                @endif
													</div><!-- /.product-price -->						
												</div><!-- /.product-info -->							
											</div><!-- /.product -->		      
										</div><!-- /.products -->
									</div><!-- /.item -->
									@endforeach 					
								</div><!-- /.row -->
							</div><!-- /.category-product -->
						</div><!-- /.tab-pane -->
					</div><!-- /.tab-content -->
					<div class="clearfix filters-container">
						<div class="text-right">
							{{ $products->links() }}			    
						</div><!-- /.text-right -->
					</div><!-- /.filters-container -->
				</div><!-- /.search-result-container -->
				@else
                    <h3 class="text-danger text-center"><b>There have no any product in this category</b></h3>
                    @if($products2->count())	
					<!-- ============================================== SCROLL TABS ============================================== -->
					<section class="section featured-product wow fadeInUp">
						<h3 class="section-title">{{ $products2->first()->cName }}</h3>
						<div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                   	@foreach($products2 as $product2)
					@php
						$imgname = ($product2->piImage)?$product2->piImage:$product2->pImage;
					@endphp
					<div class="item item-carousel">
						<div class="products">						
							<div class="product">		
								<div class="product-image">
									<div class="image">
										<a title="{{ $product2->pName }} ({{ $product2->piQty.' '.$product2->piUnit }})" alt="{{ $product2->pName }} ({{ $product2->piQty.' '.$product2->piUnit }})" href="{{ route('front.product.details',[$product2->pName,$product2->cName,$product2->cUkey,$product2->piUkey,$product2->pUkey]) }}">
											<img src="{{ route('front.product.image.get',['176','192','70',$imgname]) }}" alt="{{ $product2->pName }} ({{ $product2->piQty.' '.$product2->piUnit }})"
												title="{{ $product2->pName }} ({{ $product2->piQty.' '.$product2->piUnit }})" >
										</a>
									</div>			   
								</div><!-- /.product-image -->
								<div class="product-info text-left">

									<h3 class="name">
										<a title="{{ $product2->pName }} ({{ $product2->piQty.' '.$product2->piUnit }})" alt="{{ $product2->pName }} ({{ $product2->piQty.' '.$product2->piUnit }})"  href="{{ route('front.product.details',[$product2->pName,$product2->cName,$product2->cUkey,$product2->piUkey,$product2->pUkey]) }}">{{ $product2->pName }} ({{ $product2->piQty.' '.$product2->piUnit }})</a>
									</h3>								
									<div class="product-price">	
			                                <span class="price"><i class="fa fa-inr"></i>{{ $product2->sopMsp }}</span>
			                                @if($product2->piMrp && $product2->piMrp > $product2->sopMsp)<span class="price-before-discount"><i class="fa fa-inr"></i>{{ $product2->piMrp }} </span>&nbsp;&nbsp;
			                                <span style="color:#0a0; margin-top: 5px">{{  round($product2->piMrp-$product2->sopMsp/$product2->piMrp*100) }} %</span>
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
				@endif
			</div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div>
@endsection