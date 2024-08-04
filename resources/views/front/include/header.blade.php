<header class="header-style-1 app-vue">

	<!-- ============================================== TOP MENU ============================================== -->
<div class="top-bar animate-dropdown">
	<div class="container">
		<div class="header-top-inner">
			<div class="cnt-account">
				<ul class="list-unstyled">
					<li><a href="{{ route('front.cart.list') }}"><i class="fa fa-shopping-cart"></i> Cart</a></li> 
					<li><a href="{{ route('front.cart.checkout.form') }}"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Checkout</a></li>
					@if(Auth::guard('user')->check())
						<li class="dropdown ">
							<a href="Javascript:;" id="account" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle">{{ Auth::guard('user')->user()->first_name }} <span class="caret"></span></a>
						    <ul class="dropdown-menu " role="menu" >
						      <li style="display: block;"><a href="{{ route('user.profile.get') }}"><i class="fa fa-picture-o "></i> Profile</a></li>
						      <li style="display: block;"><a href="{{ route('user.password.change') }}"><i class="fa fa-cog "></i> Setting</a></li>
						      <li style="display: block;">
						      	<a href="{{ route('user.logout.get') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out "></i> Log Out</a>
						      </li>
						    </ul>
						</li>
					@else
						<li><a href="{{route('user.login.form')}}"><i class=" fa fa-lock"></i>Login</a></li>
					@endif
				</ul>
			</div><!-- /.cnt-account -->
			<form id="logout-form" action="{{ route('user.logout.post') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
			<div class="clearfix"></div>
		</div><!-- /.header-top-inner -->
	</div><!-- /.container -->
</div><!-- /.header-top -->
<!-- ============================================== TOP MENU : END ============================================== -->
	<div class="main-header">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
					<!-- =========== LOGO =========================== -->
					<div class="logo">
						<a href="{{ route('front.home') }}">
							<img src="{{asset('assets/images/logo.png')}}" alt="i-caps">
						</a>
					</div><!-- /.logo -->
					<!-- ============= LOGO : END ======================= -->				
				</div><!-- /.logo-holder -->
				<div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
					<!-- /.contact-row -->
				<!-- ================================ SEARCH AREA =================================== -->
					<div class="search-area">
					    <form action="{{ route('front.product.search.get')}}" >
					        <div class="control-group">
					            <input autocomplete="off" required class="search-field" name="name" id="searchProduct" placeholder="Search here..." />
					            <button class="search-button" type="submit"  ></button>  
					        </div>
					    </form>
					    <div style="position:absolute;border:1px solid #ccc;width:calc(100% - 30px);box-shadow:2px 2px 2px #ccc;z-index:1000;background:#fff;" >
					        <ul id="searchResult">
					            
					        </ul>
					    </div>
					    </ul>
					</div><!-- /.search-area -->
				<!-- =========================== SEARCH AREA : END ================================ -->				
				</div><!-- /.top-search-holder -->
				<div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
				@php 
					$oldCart2 = Session::get('cart');
					$cart2 = new App\Model\Catalog\Cart($oldCart2);
					if(is_array($cart2)){
    					foreach($cart2->items as $itemCart){
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
                            $grandTotal =($sopCart->msp/$productItemCart->qty)*$qtyCart2;
                        }
                        else{
                            $grandTotal = $sopCart->msp*$qtyCart2;
                        }
                        @$totalPriceCart1+=$grandTotal;
                     }
                }
                @endphp
				<!-- =======================   SHOPPING CART DROPDOWN =============================== -->
				<div class="dropdown dropdown-cart">						
					
					<a href="{{ route('front.cart.list') }}" class="lnk-cart">
						<div class="items-cart-inner">
			            <div class="basket">
								<i class="glyphicon glyphicon-shopping-cart"></i>
							</div>
							<div class="basket-item-count"><span class="count"> 
								@if (is_array($cart2))
									{{ count($cart2->items) }} 
								@endif
								
							</span></span></div>
							<div class="total-price-basket">
								<span class="lbl">cart</span>
								<span class="total-price">
									<span class="sign"><i class="fa fa-inr"></i> </span><span class="value">{{ @($totalPriceCart1)?round($totalPriceCart1):0 }}</span>
								</span>
							</div>
					    </div>
					</a>
				</div><!-- /.dropdown-cart -->
				<!-- ================================= SHOPPING CART DROPDOWN : END =================================== -->				
				</div><!-- /.top-cart-row -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /.main-header -->
	<!-- ============================================== NAVBAR ============================================== -->
<div class="header-nav animate-dropdown">
    <div class="container">
        <div class="yamm navbar navbar-default"  role="navigation" >
            <div class="navbar-header">
                <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="nav-bg-class"  >
                <div class="navbar-collapse collapse"  id="mc-horizontal-menu-collapse">
					<div class="nav-outer" >
						<ul class="nav navbar-nav">
							<li ><a href="{{route('front.home')}}">Home</a></li>		 
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Information</a>
								<ul class="dropdown-menu pages">
									<li>
										<div class="yamm-content">
											<div class="row">
												<div class="col-xs-12 col-menu">
					                                 <ul class="links">
														<li><a href="{{route('front.information.passport')}}" title="make passport">Passport </a></li>
														<li><a href="{{route('front.information.BerthCertificate')}}" title="make birth certificate">Birth Certificate </a></li>
														<li><a href="{{route('front.information.DrivingLicence')}}" title="make driving licence">Driving Licence </a></li>
														<li><a href="{{route('front.information.PanCard')}}" title="make pan card">Pan Card </a></li>
														<li><a href="{{route('front.information.AdharCard')}}" title="make Aadhaar card">Aadhaar Card </a></li>
														<li><a href="{{route('front.information.VoterId')}}" title="make voter id card">Voter Id Card </a></li>
					                                 </ul>
												</div>	
											</div>
										</div>
									</li> 
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Consultancy</a>
								<ul class="dropdown-menu pages">
									<li>
										<div class="yamm-content">
											<div class="row">
												<div class="col-xs-12 col-menu">
					                                <ul class="links">
															<li><a href="{{route('front.consultancy.construction')}}" title="construction consultancy">Construction </a></li>
															<li><a href="{{route('front.consultancy.educational')}}" title="Educational consultancy">Educational </a></li>
					                                </ul>
												</div>	
											</div>
										</div>
									</li>  
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Assistance</a>
								<ul class="dropdown-menu pages">
									<li>
										<div class="yamm-content">
											<div class="row">
												<div class="col-xs-12 col-menu">
					                                  <ul class="links">
															<li><a href="{{route('front.assistance.passport')}}">Passport</a></li>
															<li><a href="{{route('front.assistance.PanCard')}}">Pan Card </a></li>
															<li><a href="{{route('front.assistance.training')}}">Training</a></li>
															<li><a href="{{route('front.assistance.placement')}}">Placement</a></li>
					                                  </ul>
												</div>	
											</div>
										</div>
									</li>  
								</ul>
							</li>
							<li class="dropdown yamm mega-menu">
								<a href="javascript:;" data-toggle="collapse" data-target="#productMenuCat">Products</a>
				                
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Services</a>
								<ul class="dropdown-menu pages">
									<li>
										<div class="yamm-content">
											<div class="row">
												<div class="col-xs-12 col-menu">
				                                  <ul class="links">
				                                  <li><a href="{{route('front.services.TaxiBooking')}}">Taxi Services </a></li>
													<li><a href="{{route('front.services.ItReturns')}}">IT Returns </a></li>
													<li><a href="{{route('front.services.recharge')}}">Recharge </a></li>
													<li><a href="{{route('front.services.SalesTaxRegistration')}}">Sales Tax Registration </a></li>
													<li><a href="{{route('front.services.ServiceTaxRegistration')}}">Service Tax Registration </a></li>
													<li><a href="{{route('front.services.dth')}}">DTH Recharge</a></li>
													<li><a href="{{route('front.services.UtilityBillPayment')}}">Utility Bill Payment</a></li>
				                                  </ul>
												</div>		
											</div>
										</div>
									</li>
								</ul>
							</li>
						</ul><!-- /.navbar-nav -->
						<div class="clearfix"></div>				
					</div><!-- /.nav-outer -->
				</div><!-- /.navbar-collapse -->
            </div><!-- /.nav-bg-class -->
        </div><!-- /.navbar-default -->
       
    </div><!-- /.container-class -->
</div><!-- /.header-nav -->
<!-- ============================================== NAVBAR : END ============================================== -->
</header>
 <div class="container collapse" id="productMenuCat">
     <div class="row">
            <div class="col-md-12" >
                <ul id="mainMenuCat" class="list-inline" style="background:#fff;box-shadow:2px 2px 2px #ccc">
                    <li ><a style="font-size: 1em; margin:5px 0px;  padding: 15px 5px" href ="{{ route('front.product.medicine') }}">Medicine</a></li>
                    @foreach(DB::table('categories')->where(['status'=>1,'parent'=> null,'type'=>'!= 1'])->get() as $category)
                    <li class="dropdown mega-dropdown" style="padding: 15px 0px"> <a href="javascript:;" style="font-size: 1em; margin:5px 0px;  padding: 15px 5px" class="dropdown-toggle" data-toggle="">{{$category->name}}<span class="glyphicon glyphicon-chevron-down pull-right"></span></a>
                      <ul class="dropdown-menu mega-dropdown-menu row list-unstyle">
                        @php
                            $collection = DB::table('categories')->where(['status'=>1,'parent'=>$category->id ,'type'=>'!= 1'])->get();
                        @endphp
                        <div class="megamenu-headline">
                          <h4>{{$category->name}}</h4>
                          
                        </div>
                        <li class="divider"></li>
                            @foreach($collection as $category2)
                            <div class="col-md-3">
                                <li class="dropdown-header menu-label-2"><a href ="{{ route('front.product.category',$category2->ukey) }}">{{$category2->name}}</a> &nbsp;&nbsp;<i class="fa fa-caret-right"></i></li>
                                @foreach(DB::table('categories')->where(['status'=>1,'parent'=>$category2->id ,'type'=>'!= 1'])->get() as $category3)
                                <li class="dropdown-header menu-label-3"><a href ="{{ route('front.product.category',$category3->ukey) }}">{{$category3->name}}</a></li>
                                @endforeach
                            </div>
                            @endforeach
                         </ul>
                        
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
 </div>



