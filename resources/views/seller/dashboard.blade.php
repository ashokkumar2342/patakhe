@extends('seller.layout.master')
@section('content')
<div class="page-head">
    <h3>
        Dashboard
    </h3>
    <span class="sub-title">Welcome to Seller dashboard</span>
    <div class="state-information">
        <div class="state-graph">
            <div id="balance" class="chart"></div>
            <div class="info">Total Order </div>
        </div>
        <div class="state-graph">
            <div id="item-sold" class="chart"></div>
            <div class="info">New Order </div>
        </div>
    </div>
</div>
<!-- page head end-->

<!--body wrapper start-->
<div class="wrapper">
    <!--state overview start-->
    <div class="row state-overview">
        <div class="col-lg-3 col-sm-6">
            <section class="panel purple">
                <div class="symbol">
                    <i class="fa fa-send"></i>
                </div>
                <div class="value white">
                    <h1 class="timer" data-from="0" data-to="320"
                        data-speed="1000">
                        <!--320-->
                    </h1>
                    <p>New Order</p>
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel ">
                <div class="symbol purple-color">
                    <i class="fa fa-tags"></i>
                </div>
                <div class="value gray">
                    <h1 class="purple-color timer" data-from="0" data-to="123"
                        data-speed="1000">
                        <!--123-->
                    </h1>
                    <p>Item Sold</p>
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel green">
                <div class="symbol ">
                    <i class="fa fa-cloud-upload"></i>
                </div>
                <div class="value white">
                    <h1 class="timer" data-from="0" data-to="432"
                        data-speed="1000">
                        <!--432-->
                    </h1>
                    <p>Item Upload</p>
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol green-color">
                    <i class="fa fa-bullseye"></i>
                </div>
                <div class="value gray">
                    <h1 class="green-color timer" data-from="0" data-to="2345"
                        data-speed="3000">
                        <!--2345-->
                    </h1>
                    <p>Unique Visit</p>
                </div>
            </section>
        </div>
    </div>
    <!--state overview end-->
</div>
<!--body wrapper end-->
@endsection
@push('scripts')
<script src="{{ asset('js/jquery-countTo/jquery.countTo.js') }}"  type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        //countTo
        $('.timer').countTo();    
    });
</script>
@endpush