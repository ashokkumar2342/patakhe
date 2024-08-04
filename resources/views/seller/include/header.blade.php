 <!-- header section start-->
            <div class="header-section bg-danger light-color">

                <!--logo and logo icon start-->
                <div class="logo theme-logo-bg hidden-xs hidden-sm">
                    <a href="{{ route('front.home') }}">
                        <img src="{{ asset('seller_asset/img/logo-icon.png') }}" alt="I-CAPS">
                        <!--<i class="fa fa-maxcdn"></i>-->
                        <span class="brand-name">I-CAPS</span>
                    </a>
                </div>

                <div class="icon-logo theme-logo-bg hidden-xs hidden-sm">
                    <a href="{{ route('front.home') }}">
                        <img src="{{ asset('seller_asset/img/logo-icon.png') }}" alt="i-CAPS">
                        <!--<i class="fa fa-maxcdn"></i>-->
                    </a>
                </div>
                <!--logo and logo icon end-->

                <!--toggle button start-->
                <a class="toggle-btn"><i class="fa fa-outdent"></i></a>
                <!--toggle button end-->
                 <div class="notification-wrap">
                <!--left notification start-->
                <div class="left-notification">
                    <ul class="notification-menu">
                    </ul>
                </div>

              
                @php
                     $profile = route('seller.image.profile.view',[Auth::guard('seller')->user()->profile_pic]);
                @endphp

                <!--right notification start-->
                <div class="right-notification">
                    <ul class="notification-menu">
                        
                        <li>

                            <a href="javascript:;" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <img src="{{  (Auth::guard('seller')->user()->profile_pic)? $profile : asset('seller_asset/img/user.png') }}" alt="">{{ Auth::guard('seller')->user()->first_name }}
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu purple pull-right">
                                <li><a href="{{ route('seller.account.profile.information.view') }}">  Profile</a></li>
                                <li>
                                    <a href="javascript:;">
                                        <span>Settings</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('seller.changepassword.form') }}">
                                        Change Password
                                    </a>
                                </li>
                                <li><a href="{{ route('seller.logout.get') }}"
                                         onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out pull-right"></i> 
                                        Log Out
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('seller.logout.post') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                            </ul>
                        </li>
                        <li>
                            <div class="sb-toggle-right">
                                <i class="fa fa-indent"></i>
                            </div>
                        </li>

                    </ul>
                </div>
                <!--right notification end-->
                </div>

            </div>
            <!-- header section end-->