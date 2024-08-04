<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/png">

    <title>{{ env('app.name','I-CAPS') }} :: Admin Panel</title>

    <!--switchery-->
    <link href="{{ asset('js/switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{ mix('css/admin.css') }}" rel="stylesheet" type="text/css" />
     <!--Data Table-->
    <link href="{{ asset('js/data-table/css/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('js/data-table/css/dataTables.tableTools.css') }}" rel="stylesheet">
    <link href="{{ asset('js/data-table/css/dataTables.colVis.min.css') }}" rel="stylesheet">
    <link href="{{ asset('js/data-table/css/dataTables.responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('js/data-table/css/dataTables.scroller.css') }}" rel="stylesheet">
       @stack('links')
    <!--common style-->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout-theme-two.css') }}" rel="stylesheet">
     <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ asset('js/html5shiv.js') }}"></script>
    <script src="{{ asset('js/respond.min.js') }}"></script>
    <![endif]-->
    <style type="text/css">
    fieldset {
    border: 1px groove #efefef !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  3px 3px 6px 2px #000;
            box-shadow:  3px 3px 6px 2px #aaa;
    }

    legend {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        border:none;
        padding: 0px 5px;
        width:auto;

    }
</style>
</head>

<body class="sticky-header">
@php $sn=0; @endphp
 <section >
   @include('admin.include.left-sidebar')
    <!-- body content start-->
    <div class="body-content" style="min-height: 1000px;">
        @include('admin.include.header')        
        @yield('content')
        @include('admin.include.footer')
    </div>
    <!-- body content end-->
</section>
<script src="{{ mix('js/admin.js') }}"></script>
<script src="{{ asset('js/modernizr.min.js') }}"></script>

<!--Nice Scroll-->
<script src="{{ asset('js/jquery.nicescroll.js') }}" type="text/javascript"></script>

<!--right slidebar-->
<script src="{{ asset('js/slidebars.min.js') }}"></script>

<!--switchery-->
<script src="{{ asset('js/switchery/switchery.min.js') }}"></script>
<script src="{{ asset('js/switchery/switchery-init.js') }}"></script>
<!--Data Table-->
<script src="{{ asset('js/data-table/js/jquery.dataTables.min.js') }}"></script> 
<script src="{{ asset('js/data-table/js/bootstrap-dataTable.js') }}"></script>
<script src="{{ asset('js/data-table/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/data-table/js/dataTables.scroller.min.js') }}"></script>
<!--data table init-->
<script src="{{ asset('js/data-table-init.js') }}"></script>
@stack('scripts')
<script src="{{ asset('js/scripts.js') }}"></script>
@include('components.alert.tostr')
</body>
</html>
