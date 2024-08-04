 <!-- sidebar left start-->
        <div class="sidebar-left">
            <!--responsive view logo start-->
            <div class="logo dark-logo-bg visible-xs-* visible-sm-*">
                <a href="{{ route('front.home') }}">
                    {{-- <i class="fa fa-maxcdn"></i> --}}
                    <span class="brand-name">I-CAPS</span>
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
                        <h3 class="navigation-title">Navigation</h3>
                    </li>
                    <li><a href="{{ route('seller.dashboard') }}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                                       
                    <li class="menu-list">
                        <a href="#"><i class="fa fa-list"></i>  <span>Product</span></a>
                        <ul class="child-list">
                            <li><a href="{{ route('seller.product.add') }}">Add</a></li>
                            <li><a href="{{ route('seller.product.list') }}">list</a></li>                            
                        </ul>
                    </li>
                </ul>
                <!--sidebar nav end-->
            </div>
        </div>
        <!-- sidebar left end-->
