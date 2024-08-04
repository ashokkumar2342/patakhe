 <!-- sidebar left start-->
        <div class="sidebar-left">
            <!--responsive view logo start-->
            <div class="logo dark-logo-bg visible-xs-* visible-sm-*">
                <a href="{{ route('front.home') }}">
                    <!--<i class="fa fa-maxcdn"></i>-->
                    <span class="brand-name">Icaps</span>
                </a>
            </div>
            <!--responsive view logo end-->

            <div class="sidebar-left-info">
                <!-- visible small devices start-->
                <div class=" search-field">  </div>
                <!-- visible small devices end-->

                <!--sidebar nav start-->
                <ul class="nav nav-pills nav-stacked side-navigation">
                    <li>
                        <h3 class="navigation-title">Main</h3>
                    </li>
                    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li> 
                    <li>
                        <h3 class="navigation-title">Catalog</h3>
                    </li>
                    <li class="menu-list">
                        <a href="#"><i class="fa fa-list"></i><span>Catalog</span></a>
                        <ul class="child-list">
                            <li><a href="{{ route('admin.product.list') }}">Product</a></li> 
                            <li><a href="{{ route('admin.category.form') }}">Category</a></li> 
                            <li><a href="{{ route('admin.unit.form') }}">Unit</a></li> 
                            <li><a href="{{ route('admin.color.form') }}">Color</a></li>
                        </ul>
                    </li> 
                   
                    
                    <li>
                        <h3 class="navigation-title">Web Request</h3>
                    </li>
                    <li class="menu-list"><a href="#"><i class="fa fa-paper-plane-o text-info"></i> <span>Consultancy</span></a>
                        <ul class="child-list">
                            <li><a href="{{ route('admin.consultancy.construction') }}"> Construction @if(App\Construction::where('status','0')->count())<span class="badge noti-arrow bg-danger pull-right">{{ App\Construction::where('status','0')->count() }}</span>@endif  </a></li>
                            <li><a href="{{ route('admin.consultancy.educational') }}"> Educational @if(App\Educational::where('status','0')->count())<span class="badge noti-arrow bg-danger pull-right">{{ App\Educational::where('status','0')->count() }}</span>@endif</a></li>
                        </ul>
                    </li>
                    <li class="menu-list"><a href="#"><i class="fa fa-paper-plane-o text-primary"></i> <span>Assistance</span></a>
                        <ul class="child-list">
                            <li><a href="{{ route('admin.assistance.passport') }}"> Passport @if(App\Passport::where('status','0')->count())<span class="badge noti-arrow bg-danger pull-right">{{ App\Passport::where('status','0')->count() }}</span>@endif</a></li>

                            <li><a href="{{ route('admin.assistance.pancard') }}"> Pan Card @if(App\Pan::where('status','0')->count())<span class="badge noti-arrow bg-danger pull-right">{{ App\Pan::where('status','0')->count() }}</span>@endif</a></li>

                            <li><a href="{{ route('admin.assistance.training') }}"> Training @if(App\Training::where('status','0')->count())<span class="badge noti-arrow bg-danger pull-right">{{ App\Training::where('status','0')->count() }}</span>@endif</a></li>

                            <li><a href="{{ route('admin.assistance.placement') }}"> Placement @if(App\Placement::where('status','0')->count())<span class="badge noti-arrow bg-danger pull-right">{{ App\Placement::where('status','0')->count() }}</span>@endif</a></li>

                        </ul>
                    </li>
                    <li class="menu-list"><a href="#"><i class="fa fa-paper-plane-o text-warning"></i> <span>Product</span></a>
                        <ul class="child-list">
                            <li><a href="{{ route('admin.product.medicine') }}"> Medicine @if(App\Medicine::where('status','0')->count())<span class="badge noti-arrow bg-danger pull-right">{{ App\Medicine::where('status','0')->count() }}</span>@endif</a></li>   
                            <li><a href="{{ route('admin.product.order.list') }}">Order @if(App\Model\Catalog\Order::where('status','0')->count())<span class="badge noti-arrow bg-danger pull-right">{{ App\Model\Catalog\Order::where('status','0')->count() }}</span>@endif</a></li>  
                        </ul>
                    </li>
                    <li class="menu-list"><a href="#"><i class="fa fa-paper-plane-o text-success"></i> <span>Services</span></a>
                        <ul class="child-list">
                            <li><a href="{{ route('admin.services.taxiservice') }}"> Taxi Service @if(App\TaxiBooking::where('status','0')->count())<span class="badge noti-arrow bg-danger pull-right">{{ App\TaxiBooking::where('status','0')->count() }}@endif</span></a></li>

                            <li><a href="{{ route('admin.services.itreturn') }}"> It Return @if(App\ItReturn::where('status','0')->count())<span class="badge noti-arrow bg-danger pull-right">{{ App\ItReturn::where('status','0')->count() }}</span>@endif</a></li>

                            <li><a href="{{ route('admin.services.recharge') }}"> Recharge @if(App\Recharge::where('status','0')->count())<span class="badge noti-arrow bg-danger pull-right">{{ App\Recharge::where('status','0')->count() }}</span>@endif</a></li>

                            <li><a href="{{ route('admin.services.salestaxregistration') }}"> Sales Tax Registration @if(App\SalesTaxRegistration::where('status','0')->count())<span class="badge noti-arrow bg-danger pull-right">{{ App\SalesTaxRegistration::where('status','0')->count() }}</span>@endif</a></li>

                            <li><a href="{{ route('admin.services.servicetaxregistration') }}"> Service Tax Registration @if(App\ServiceTaxRegistration::where('status','0')->count())<span class="badge noti-arrow bg-danger pull-right">{{ App\ServiceTaxRegistration::where('status','0')->count() }}</span>@endif</a></li>

                            <li><a href="{{ route('admin.services.dthservice') }}"> DTH Recharge @if(App\Dth::where('status','0')->count())<span class="badge noti-arrow bg-danger pull-right">{{ App\Dth::where('status','0')->count() }}@endif</span></a></li>

                            <li><a href="{{ route('admin.services.utilitybillpayment') }}"> Utility Bill Payment @if(App\UtilityBillPayment::where('status','0')->count())<span class="badge noti-arrow bg-danger pull-right">{{ App\UtilityBillPayment::where('status','0')->count() }}@endif</span></a></li>                            

                        </ul>
                    </li>

                    <li>
                        <h3 class="navigation-title">User Managment</h3>
                    </li>
                  


                   <li class="menu-list"><a href="#"><i class="fa fa-user text-danger"></i> <span>Users</span></a>
                        <ul class="child-list">
                            <li><a href="{{ route('admin.user.new.form') }}"> New</a></li>
                            <li><a href="{{ route('admin.user.lists') }}"> List</a></li>

                        </ul>
                    </li>

                    <li class="menu-list"><a href="#"><i class="fa fa-user text-success"></i> <span>Seller</span></a>
                        <ul class="child-list">
                            <li><a href="{{ route('admin.seller.new.form') }}"> New</a></li>
                            <li><a href="{{ route('admin.seller.lists') }}"> List</a></li>

                        </ul>
                    </li>
                    <li class="menu-list"><a href="#"><i class="fa fa-user text-primary"></i> <span>Members</span></a>
                        <ul class="child-list">
                            <li><a href="{{ route('admin.member.new.form') }}"> New</a></li>
                            <li><a href="{{ route('admin.member.lists') }}"> List</a></li>
                            <li><a href="{{ route('admin.member.request') }}"> Request</a></li>

                        </ul>
                    </li>
                </ul>
                <!--sidebar nav end-->

               
            </div>
        </div>
        <!-- sidebar left end-->
