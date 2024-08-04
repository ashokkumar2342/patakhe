@extends('user.layout.auth')

<!-- Main Content -->
@section('content')
<div class="container" id="app">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active">
                            <a data-toggle="tab" href="#clock">
                                <i class="icon-clock"></i>
                            </a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#heart">
                                <i class="icon-heart"></i>
                            </a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#music">
                                <i class="icon-music-tone-alt"></i>
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content">
                            <div id="clock" class="tab-pane active">
                                <div class="media">
                                    <a class="media-left media-middle" href="#">
                                        <img class="img-circle" alt="" src="img/img4.jpg" data-holder-rendered="true" style="width: 80px; height: 80px;">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading text-uppercase">kayne west</h4>
                                        <span class="text-muted">Product Designer </span>
                                        <div class="s-l"><i class="icon-arrow-right"></i> <a href="#" class="">  http://thevectorlab.net/</a></div>
                                    </div>
                                </div>
                            </div>
                            <div id="heart" class="tab-pane">
                                <div class="media fav-list">
                                    <a class="media-left media-middle" href="#">
                                        <img class="img-circle" alt="" src="img/img1.jpg" data-holder-rendered="true" >
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading text-uppercase">Carlos Beltron</h4>
                                        <div class="text-muted space-i">
                                            <span><i class="fa fa-map-marker"></i>St. Louise, NY </span>
                                            <span><i class="fa fa-briefcase"></i>Student</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="media fav-list">
                                    <a class="media-left media-middle" href="#">
                                        <img class="img-circle" alt="" src="img/img4.jpg" data-holder-rendered="true">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading text-uppercase">kayne west</h4>
                                        <div class="text-muted space-i">
                                            <span><i class="fa fa-map-marker"></i>New England </span>
                                            <span><i class="fa fa-briefcase"></i>Briefcase</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="music" class="tab-pane">
                                <ul class="w-m-list">
                                    <li><i class="fa fa-music"></i>  Holloween Parade <small class="text-muted"> - Lou Reed 3:29</small></li>
                                    <li>
                                        <i class="fa fa-music"></i>  The Goo Goo Dolls <small class="text-muted"> - Iris 2:59</small>
                                    </li>
                                    <li>
                                        <i class="fa fa-music"></i>  In Liverpool  <small class="text-muted">- Suzanne Vega 3:01</small>
                                    </li>
                                    <li>
                                        <i class="fa fa-music"></i>  Brothers In Arms <small class="text-muted">- Dire Straits 3:19</small>
                                    </li>
                                </ul>

                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
