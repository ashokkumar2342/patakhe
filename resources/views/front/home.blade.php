@extends('front.layout.main')
@section('content')
<div class="body-content outer-top-xs" id="top-banner-and-menu">
	<div class="container-fluid">
		<div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <img style="width:100%" src="{{asset('image/icaps_add.jpg')}}">
              </div>
             
            </div>
        
          </div>
        </div>
	<div class="row">
	<!-- ============================================== SIDEBAR ============================================== -->	
		{{-- <div class="col-xs-12 col-sm-12 col-md-3 sidebar">
			@include('front.include.leftsidebar')
		</div> --}}<!-- /.sidemenu-holder -->
		<!-- ============================================== SIDEBAR : END ============================================== -->

		<!-- ============================================== CONTENT ============================================== -->
		<div class="col-xs-12 col-sm-12 col-md-12 homebanner-holder">
			<!-- ========================================== SECTION – HERO ========================================= -->
			
			<div id="hero">
				<div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
					<div class="item" >
						<img src="{{ asset('assets/images/sliders/01.jpg') }}">
					</div><!-- /.item -->
					<div class="item">
						<img src="{{ asset('assets/images/sliders/03.jpg') }}">
					</div><!-- /.item -->					
					
				</div><!-- /.owl-carousel -->
			</div>
						
			<!-- ========================================= SECTION – HERO : END ========================================= -->	

						<!-- ============================================== INFO BOXES ============================================== -->
			<div class="info-boxes wow fadeInUp">
				<div class="info-boxes-inner">
					<div class="row">
						
						<div class="hidden-md col-sm-4 col-lg-6">
							<div class="info-box">
								<div class="row">
									
									<div class="col-xs-12">
										<h4 class="info-box-heading green">free shipping</h4>
									</div>
								</div>
							</div>
						</div><!-- .col -->

						<div class="col-md-6 col-sm-4 col-lg-6">
							<div class="info-box">
								<div class="row">
									
									<div class="col-xs-12">
										<h4 class="info-box-heading green">No minimum order required</h4>
									</div>
								</div>
							</div>
						</div><!-- .col -->
					</div><!-- /.row -->
				</div><!-- /.info-boxes-inner -->
				
			</div><!-- /.info-boxes -->
			<!-- ============================================== INFO BOXES : END ============================================== -->
			<!-- ============================================== SCROLL TABS ============================================== -->

<!-- ============================================== SCROLL TABS : END ============================================== -->

@if($fruits->count())	
<!-- ============================================== SCROLL TABS ============================================== -->
<section class="section featured-product wow fadeInUp">
	<h3 class="section-title">{{ $fruits->first()->cName }}</h3>
	<div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs" data-item="4">
		@foreach($fruits as $fruit)
		@php
			$imgname = ($fruit->piImage)?$fruit->piImage:$fruit->pImage;
		@endphp
		<div class="item item-carousel">
			<div class="products">						
				<div class="product">		
					<div class="product-image">
						<div class="image">
							<a href="{{ route('front.product.details',[$fruit->pName,$fruit->cName,$fruit->cUkey,$fruit->piUkey,$fruit->pUkey]) }}">
								<img style="min-height:176px" src="{{ route('front.product.image.get',['176','192','70',$imgname]) }}" alt="{{ $imgname }}"
									 
									title="{{ $imgname }}" >
							</a>
						</div>			   
					</div><!-- /.product-image -->
					<div class="product-info text-left">

						<h3 class="name">
							<a href="{{ route('front.product.details',[$fruit->pName,$fruit->cName,$fruit->cUkey,$fruit->piUkey,$fruit->pUkey]) }}">{{ $fruit->pName }} ({{ $fruit->piQty.' '.DB::table('units')->find($fruit->piUnit)->alias }})</a>
						</h3>								
						<div class="product-price">	
                                <span class="price"><i class="fa fa-inr"></i>{{ $fruit->sopMsp }}</span>
                                @if($fruit->piMrp && $fruit->piMrp > $fruit->sopMsp)<span class="price-before-discount"><i class="fa fa-inr"></i>{{ $fruit->piMrp }} </span>&nbsp;&nbsp;
                                <span style="color:#0a0; margin-top: 5px">{{  round(($fruit->piMrp-$fruit->sopMsp)/$fruit->piMrp*100) }} %</span>
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
			<!-- ============================================== WIDE PRODUCTS ============================================== -->
<div class="wide-banners wow fadeInUp outer-bottom-xs">
	<div class="row">
<div class="col-md-7 col-sm-7">
<div class="wide-banner cnt-strip">
<div class="image">
<img class="img-responsive" src="{{asset('images/home-banner rakhi.jpg')}}" alt="">
</div>

</div><!-- /.wide-banner -->
</div><!-- /.col -->
<div class="col-md-5 col-sm-5">
<div class="wide-banner cnt-strip">
<div class="image">
<img class="img-responsive" src="{{asset('images/mdh.jpg')}}" alt="">
</div>

</div><!-- /.wide-banner -->
</div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.wide-banners -->

<!-- ============================================== WIDE PRODUCTS : END ============================================== -->
@if($vegetables->count() )	
<!-- ============================================== Category Product ============================================== -->
<section class="section wow fadeInUp new-arriavls">
	<h3 class="section-title">{{ $vegetables->first()->cName }}</h3>
	<div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs" data-item="4">
		@foreach($vegetables as $vegetable)
		@php
			$imgname2 = ($vegetable->piImage)?$vegetable->piImage:$vegetable->pImage;
		@endphp
		<div class="item item-carousel">
			<div class="products">						
				<div class="product">		
					<div class="product-image">
						<div class="image">
							<a href="{{ route('front.product.details',[$vegetable->pName,$vegetable->cName,$vegetable->cUkey,$vegetable->piUkey,$vegetable->pUkey]) }}">
								<img style="min-height:176px" src="{{ route('front.product.image.get',['176','192','70',$imgname2]) }}" alt="{{ $imgname2 }}"
									 
									title="{{ $imgname2 }}" >
							</a>
						</div>			   
					</div><!-- /.product-image -->
					<div class="product-info text-left">

						<h3 class="name">
							<a href="{{ route('front.product.details',[$vegetable->pName,$vegetable->cName,$vegetable->cUkey,$vegetable->piUkey,$vegetable->pUkey]) }}">{{ $vegetable->pName }} ({{ $vegetable->piQty.' '.DB::table('units')->find($vegetable->piUnit)->alias }})</a>
						</h3>								
						<div class="product-price">	
                                <span class="price"><i class="fa fa-inr"></i>{{ $vegetable->sopMsp }}</span>
                                @if($vegetable->piMrp && $vegetable->piMrp > $vegetable->sopMsp)
                                <span class="price-before-discount"><i class="fa fa-inr"></i>{{ $vegetable->piMrp }} </span>&nbsp;&nbsp;
                                <span style="color:#0a0; margin-top: 5px">{{  round((($vegetable->piMrp-$vegetable->sopMsp)/$vegetable->piMrp)*100) }} %</span>
                                @endif
						</div><!-- /.product-price -->						
					</div><!-- /.product-info -->							
				</div><!-- /.product -->		      
			</div><!-- /.products -->
		</div><!-- /.item -->
		@endforeach 					
	</div><!-- /.home-owl-carousel -->
</section><!-- /.section -->
<!-- ============================================== Category Product : END ============================================== --> 	
@endif
@if($newArrivals->count() )	
<!-- ============================================== Category Product ============================================== -->
<section class="section wow fadeInUp new-arriavls">
	<h3 class="section-title">{{ $newArrivals->first()->cName }}</h3>
	<div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs" data-item="4">
		@foreach($newArrivals as $newArrival)
		@php
			$imgname3 = ($newArrival->piImage)?$newArrival->piImage:$newArrival->pImage;
		@endphp
		<div class="item item-carousel">
			<div class="products">						
				<div class="product">		
					<div class="product-image">
						<div class="image">
							<a href="{{ route('front.product.details',[$newArrival->pName,$newArrival->cName,$newArrival->cUkey,$newArrival->piUkey,$newArrival->pUkey]) }}">
								<img style="min-height:176px" src="{{ route('front.product.image.get',['176','192','70',$imgname3]) }}" alt="{{ $newArrival->pName }}"
									 
									title="{{ $newArrival->pName }}" >
							</a>
						</div>
						<div class="tag sale"><span>new</span></div>   
					</div><!-- /.product-image -->
					<div class="product-info text-left">

						<h3 class="name">
							<a href="{{ route('front.product.details',[$newArrival->pName,$newArrival->cName,$newArrival->cUkey,$newArrival->piUkey,$newArrival->pUkey]) }}">{{ $newArrival->pName }} ({{ $newArrival->piQty.' '.DB::table('units')->find($newArrival->piUnit)->alias }})</a>
						</h3>								
						<div class="product-price">	
                                <span class="price"><i class="fa fa-inr"></i>{{ $newArrival->sopMsp }}</span>
                                @if($newArrival->piMrp && $newArrival->piMrp > $newArrival->sopMsp)
                                <span class="price-before-discount"><i class="fa fa-inr"></i>{{ $newArrival->piMrp }} </span>&nbsp;&nbsp;
                                <span style="color:#0a0; margin-top: 5px">{{  round((($newArrival->piMrp-$newArrival->sopMsp)/$newArrival->piMrp)*100) }} %</span>
                                @endif
						</div><!-- /.product-price -->						
					</div><!-- /.product-info -->							
				</div><!-- /.product -->		      
			</div><!-- /.products -->
		</div><!-- /.item -->
		@endforeach 					
	</div><!-- /.home-owl-carousel -->
</section><!-- /.section -->
<!-- ============================================== Category Product : END ============================================== --> 	
@endif




















		</div><!-- /.homebanner-holder -->
		<!-- ============================================== CONTENT : END ============================================== -->
	</div><!-- /.row -->

	</div><!-- /.container -->
</div><!-- /#top-banner-and-menu -->



@endsection
@push('scripts')
<script type="text/javascript">
if(getCookie('modal') == ''){
	$(document).ready(function(){
		$('#myModal').modal(true);
	});
	setCookie("modal", 'add', 1);
}
</script>
@endpush