@extends('front.layout.main')
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
					        	@php @$n = $n+1; @endphp
					            <div class="single-product-gallery-item text-center" id="slide{{ $n }}">
					                <a data-lightbox="image-1" data-title="Gallery" href="{{ route('front.product.image.get',['880','600','100',$image->name]) }} ">
					                    <img class="img-responsive"  src="{{ route('front.product.image.get',['300','322','100',$image->name]) }}" alt="{{ $product->name }}" data-echo="{{ route('front.product.image.get',['300','322','100',$image->name]) }}"  />					                </a>
					            </div><!-- /.single-product-gallery-item -->
					            
					        @endforeach
					        </div><!-- /.single-product-slider -->
					        <div class="single-product-gallery-thumbs gallery-thumbs">
					        	@foreach($product->image as $image)
					        	@php @$n = $n+1; @endphp
					            <div id="owl-single-product-thumbnails">
					                <div class="item">
					                    <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide{{ $n }}">
					                        <img class="img-responsive" width="85" alt="" src="{{ route('front.product.image.get',['70','70','90',$image->name]) }}" data-echo="{{ route('front.product.image.get',['70','70','90',$image->name]) }}" />
					                    </a>
					                </div>               
					            </div><!-- /#owl-single-product-thumbnails -->	
					            @endforeach
					        </div><!-- /.gallery-thumbs -->
					    </div><!-- /.single-product-gallery -->
					</div><!-- /.gallery-holder -->        			
					<div class='col-sm-6 col-md-7 product-info-block'>
						<div class="product-info">
							<h1 class="name">{{ $product->name }}</h1>
							
							<div class="stock-container info-container m-t-10">
								<div class="row">
									<div class="col-sm-2">
										<div class="stock-box">
											<span class="label">Availability :</span>
										</div>	
									</div>
									<div class="col-sm-9">
										<div class="stock-box">
											<span class="value">{{ $product->sellOnProduct->stock }}</span>
										</div>	
									</div>
								</div><!-- /.row -->	
							</div><!-- /.stock-container -->
							<div class="description-container m-t-20">
								{{ $product->description }}
							</div><!-- /.description-container -->

							<div class="price-container info-container m-t-20">
								<div class="row">
									
								{{-- @if($sellOnProduct = App\Model\Catalog\SellOnProduct::where('pid',$product->id)) --}}
									<div class="col-sm-12">
										<div class="price-box">
											<span class="price"><i class="fa fa-inr"></i> {{ $product->sellOnProduct->msp }}</span>
											<span class="price-strike"><i class="fa fa-inr"></i> {{ $product->mrp }}</span>
										</div>
									</div>
								{{-- @endif --}}
									{{-- <div class="col-sm-6">
										<div class="favorite-button m-t-10">
											<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="#">
											    <i class="fa fa-heart"></i>
											</a>
											<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Add to Compare" href="#">
											   <i class="fa fa-signal"></i>
											</a>
											<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="E-mail" href="#">
											    <i class="fa fa-envelope"></i>
											</a>
										</div>
									</div>
 --}}
								</div><!-- /.row -->
							</div><!-- /.price-container -->

							<div class="quantity-container info-container">
								<div class="row">
									
									<div class="col-sm-2">
										<span class="label">Qty :</span>
									</div>
									{{ Form::open(['route'=>'front.cart.add','method'=>'put']) }}
									<input type="hidden" name="spr" value="{{ $product->sellOnProduct->msp }}">
								    <input type="hidden" name="puk" value="{{ encrypt($product->id) }}">

									<div class="col-sm-2">
										<div class="cart-quantity">
											<div class="quant-input">
								                <div class="arrows">
								                  <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
								                  <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
								                </div>
								                <input type="text" name="qt" value="1">
								                
							              </div>
							            </div>
									</div>

									<div class="col-sm-7">
											
										<button type="submit"  class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</button>
									</div>
									{!! Form::close() !!}
									
								</div><!-- /.row -->
							</div><!-- /.quantity-container -->

							

							

							
						</div><!-- /.product-info -->
					</div><!-- /.col-sm-7 -->
				</div><!-- /.row -->
                </div>
				
				<div class="product-tabs inner-bottom-xs  wow fadeInUp">
					<div class="row">
						<div class="col-sm-3">
							<ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
								<li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
								<li><a data-toggle="tab" href="#review">REVIEW</a></li>
								<li><a data-toggle="tab" href="#tags">TAGS</a></li>
							</ul><!-- /.nav-tabs #product-tabs -->
						</div>
						<div class="col-sm-9">

							<div class="tab-content">
								
								<div id="description" class="tab-pane in active">
									<div class="product-tab">
										<p class="text">{{ $product->description }}</p>
									</div>	
								</div><!-- /.tab-pane -->

								

								
							</div><!-- /.tab-content -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.product-tabs -->
             
	


			</div><!-- /.col -->
			<div class="clearfix"></div>
		</div><!-- /.row -->
	</div><!-- /.container -->
</div><!-- /.body-content -->


</html>

@endsection
@push('scripts')
<script src="{{ asset('assets/js/jquery.rateit.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/lightbox.min.js') }}"></script>
@endpush