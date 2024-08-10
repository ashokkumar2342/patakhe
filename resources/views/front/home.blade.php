@extends('front.layout.main')
@section('content')
<div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
	<div class="item" >
		<img src="{{ asset('assets/images/sliders/01.jpg') }}">
	</div><!-- /.item -->
	<div class="item">
		<img src="{{ asset('assets/images/sliders/02.jpg') }}">
	</div><!-- /.item -->					
	
</div><!-- /.owl-carousel -->

@php
$categorys = App\Model\Catalog\Category::where('status',1)->get();
@endphp
@foreach($categorys as $category)
@php
$fruits =  App\Model\Catalog\ProductOnCategory::where('product_on_categories.cid',$category->id)
    ->join('categories', 'product_on_categories.cid','=', 'categories.id')
    ->join('products', 'product_on_categories.pid', '=', 'products.id')
    ->leftJoin('product_images','products.id','=','product_images.pid')
    ->join('product_items', 'products.id', '=', 'product_items.pid')
    ->leftJoin('product_item_images','product_item_images.iid','=','product_items.id')
    ->join('sell_on_products', 'product_items.id', '=', 'sell_on_products.iid')
    ->where(['product_on_categories.deleted_at'=>null,'categories.deleted_at'=>null,'products.deleted_at'=>null,'product_images.deleted_at'=>null,'product_items.deleted_at'=>null,'product_item_images.deleted_at'=>null,'sell_on_products.deleted_at'=>null,])
    ->select('products.name as pName','products.ukey as pUkey','product_images.name as pImage', 'product_items.qty as piQty','product_items.unit_id as piUnit','product_items.ukey as piUkey','product_items.mrp as piMrp','sell_on_products.msp as sopMsp','categories.ukey as cUkey','categories.name as cName','product_item_images.name as piImage')
    ->get(); 
@endphp
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
				<div class="product" style="box-shadow: 2px 2px #eee;">		
					<div class="product-image" >
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
@endforeach






















		</div><!-- /.homebanner-holder -->
		<!-- ============================================== CONTENT : END ============================================== -->
	</div><!-- /.row -->

	</div><!-- /.container -->
</div><!-- /#top-banner-and-menu -->



@endsection
@push('scripts')
<script type="text/javascript">
// if(getCookie('modal') == ''){
// 	$(document).ready(function(){
// 		$('#myModal').modal(true);
// 	});
// 	setCookie("modal", 'add', 1);
// }
</script>
@endpush