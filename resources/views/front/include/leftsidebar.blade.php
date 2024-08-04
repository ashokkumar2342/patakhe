		
			<!-- ================================== TOP NAVIGATION ================================== -->
<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>        
    <nav class="yamm megamenu-horizontal" role="navigation">
        <ul class="nav">
        	@foreach(DB::table('categories')->where(['parent'=>null,'type'=>0,'status'=>1])->get() as $mainMenu)
            <li class="dropdown menu-item">
                
                <a href="#" title="{{ $mainMenu->name }}" alt="{{ $mainMenu->name }}"  class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-{{ $mainMenu->icon }}" aria-hidden="true"></i>{{ $mainMenu->name }}</a>
	                <ul class="dropdown-menu mega-menu">
	                   @foreach( DB::table('categories')->where(['parent'=>$mainMenu->id,'status'=>1])->get() as $childMenu)
                            <div class="col-md-4">
                                <li><a title="{{ $childMenu->name }}" alt="{{ $childMenu->name }}" style="font-size:0.9em" href="{{ route('front.product.category',$childMenu->ukey) }}">{{ $childMenu->name }} &nbsp;&nbsp;<i class="fa fa-caret-right"></i></a></li>
                        		@foreach(DB::table('categories')->where(['parent'=>$childMenu->id,'status'=>1])->get() as $subChild)
                        			<li><a title="{{ $subChild->name }}" alt="{{ $subChild->name }}"  style="color:#00d; font-size:0.9em;margin-left:8px" href="{{ route('front.product.category',$subChild->ukey) }}">{{ $subChild->name }}</a></li>
                        		@endforeach
                            </div>
	                    
	                    @endforeach 
	                </ul><!-- /.dropdown-menu -->  
            </li><!-- /.menu-item -->
            @endforeach
		</ul><!-- /.nav -->
    </nav><!-- /.megamenu-horizontal -->
</div><!-- /.side-menu -->
<!-- ================================== TOP NAVIGATION : END ================================== -->


<!-- ============================================== SPECIAL OFFER ============================================== -->
<div class="sidebar-widget outer-bottom-small wow fadeInUp">
	<h3 class="section-title">Product Of The Month</h3>
	<div class="sidebar-widget-body outer-top-xs">
		<div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
	        <div class="item">
	        	<div class="products special-product">
		        	<div class="product">
						<div class="product-micro">
							<div class="row product-micro-row">
								<div class=" ">
									<div class="product-image">
										<div class="image">
											<a href="#">
												<img src="{{ asset('assets/images/promotion/dove.jpg') }}" alt="">
											</a>					
										</div><!-- /.image -->
									</div><!-- /.product-image -->
								</div><!-- /.col -->
								
							</div><!-- /.product-micro-row -->
						</div><!-- /.product-micro -->
      				</div>
		        </div>
	        </div>
	         <div class="item">
	        	<div class="products special-product">
		        	<div class="product">
						<div class="product-micro">
							<div class="row product-micro-row">
								<div class=" ">
									<div class="product-image">
										<div class="image">
											<a href="#">
												<img src="{{ asset('assets/images/promotion/product_of_the_month.jpg') }}" alt="">
											</a>					
										</div><!-- /.image -->
									</div><!-- /.product-image -->
								</div><!-- /.col -->
								
							</div><!-- /.product-micro-row -->
						</div><!-- /.product-micro -->
      				</div>
		        </div>
	        </div>
	    	
	    </div>
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<div class="sidebar-widget outer-bottom-small wow fadeInUp">
	<h3 class="section-title">Special Offer</h3>
	<div class="sidebar-widget-body outer-top-xs">
		<div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
	        <div class="item">
	        	<div class="products special-product">
		        	<div class="product">
						<div class="product-micro">
							<div class="row product-micro-row">
								<div class=" ">
									<div class="product-image">
										<div class="image">
											<a href="#">
												<img src="{{ asset('assets/images/promotion/big_discount_on_membership.jpg') }}" alt="">
											</a>					
										</div><!-- /.image -->
									</div><!-- /.product-image -->
								</div><!-- /.col -->
								
							</div><!-- /.product-micro-row -->
						</div><!-- /.product-micro -->
      				</div>
		        </div>
	        </div>
	    	
	    </div>
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== SPECIAL OFFER : END ============================================== -->
<!-- ============================================== 
Testimonials============================================== -->
@if(App\Review::count())
<div class="sidebar-widget  wow fadeInUp outer-top-vs ">
	<div id="advertisement" class="advertisement">
	 	@foreach(App\Review::orderBy('id','desc')->take(5)->get() as $review)
	 		@if($review->user)
		 	@php
	         	$profile = route('user.image.profile.view',$review->user->profile_pic);
	     	@endphp
		 	<div class="item">
		        <div class="avatar"><img width="100" height="100px" src="{{  ($review->user->profile_pic)? $profile : asset('profile-img/user.png') }}">
		        </div>
				<div class="testimonials"><em>"</em>{{ $review->comments }} <em>"</em></div>
				<div class="clients_author">{{ $review->user->first_name }}</div><!-- /.container-fluid -->
		    </div><!-- /.item -->
		    @endif
	    @endforeach
	</div><!-- /.owl-carousel -->
</div>
   @endif
<!-- ============================================== Testimonials: END ============================================== -->

