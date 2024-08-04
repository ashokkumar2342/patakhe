<!DOCTYPE html>
<html>
<head>
		<!-- SITE TITTLE -->
	  	<meta charset="utf-8">
	  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	  	<meta name="viewport" content="width=device-width, initial-scale=1">
	   	<meta name="keywords" content="@yield('keywords','ecommerce in rohtak, online shopping in rohtak, best online shopping in rohtak, free shipping in rohtak, medicine in rohtak')" >
		<meta name="description" content="@yield('description','ecommerce in rohtak, online shopping in rohtak, best online shopping in rohtak, free shipping in rohtak, medicine in rohtak')" >
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" >
		<meta name="Author" content="www.icaps.co.in" >
		
		<meta name="allow-search" content="yes" >
		<meta name="google-site-verification" content="ZHnpnuDSoBQH-y1P9cUD9PdiOq0J8HRsZmoa-RlyXBw" >
		<title>@yield('title','ICAPS - Best Online Shopping in Rohtak')</title>
		<link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/png">
		<script>
		     (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		     (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		     m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		     })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');	    
		     ga('create', 'UA-97382620-1', 'auto');
		     ga('send', 'pageview');    
	    </script>
	    <script>
	        window.Laravel = <?php echo json_encode([
	            'csrfToken' => csrf_token(),
	        ]); ?>
	    </script>
		<link rel="stylesheet" href="{{mix('css/app.css')}}">

		<!-- Customizable CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
		<link rel="stylesheet" href="{{asset('assets/css/blue.css')}}">
		<link rel="stylesheet" href="{{asset('assets/css/owl.carousel.css')}}">
		<link rel="stylesheet" href="{{asset('assets/css/owl.transitions.css')}}">
		<link rel="stylesheet" href="{{asset('assets/css/animate.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap-select.min.css')}}">
		<style>
           #searchResult li:hover{background:#eee; } .mega-dropdown { position: static !important; z-index:99999;} .mega-dropdown-menu {padding:2px 10px 20px 10px; width: 100%; box-shadow: none; -webkit-box-shadow: none; margin-top:-3px; } .menu-label-2 > a{color:#333; font-size:1em; } .menu-label-2 > a:hover{color:#00d; } .menu-label-3 > a:hover{color:#00d; } .menu-label-3  > a{font-size:1em; margin-left:5px; } .mega-dropdown-menu > li > ul {padding: 0; margin: 0; } .mega-dropdown-menu > li > ul > li { list-style: none; } .dropdown.mega-dropdown:hover > .dropdown-menu.mega-dropdown-menu.row { display: block; } .megamenu-headline { padding: 0px 5px ; } .pace {-webkit-pointer-events: none; pointer-events: none; -webkit-user-select: none; -moz-user-select: none; user-select: none; } .pace-inactive {display: none; } .pace .pace-progress {background: #f71; position: fixed; z-index: 2000; top: 0; right: 100%; width: 100%; height: 2px; }

        </style>

		@stack('links')
</head>
<body>
@include('front.include.header')
<div class="body-content outer-top-xs" style="min-height: 500px" id="top-banner-and-menu">
	<div class="container" id="app">
		@yield('content')
	</div>
</div>
@include('front.include.footer')
<script src="{{mix('js/app.js')}}"></script>
<script src="{{asset('js/progress.js')}}"></script>
<script src="{{asset('assets/js/bootstrap-hover-dropdown.min.js')}}"></script>
<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/js/echo.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.easing-1.3.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap-slider.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.rateit.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('assets/js/wow.min.js')}}"></script>
<script src="{{asset('assets/js/scripts.js')}}"></script>
<script type="text/javascript">
    $('#searchProduct').blur( function(){
        $('#searchResult').fadeOut();
    });
    $('#searchProduct').focus(function(){
        $('#searchResult').fadeIn();
    });
	$('body').keyup('#searchProduct',function(e){
	   
		axios.put('{{ route('front.product.search.put')}}',{name:$('#searchProduct').val()}).then(response => {
            $('#searchResult').find('li').remove();
	        if (response.data.status === 'OK' ) {
	        	for (var i = 0; i < response.data.jsonData.length; i++) {
	        	    var data = response.data.jsonData[i];
	        	    
	        		$('#searchResult').append('<li style="padding:1px;margin:3px"><a style="color:#555; display:block" href="http://www.icaps.co.in/search?name='+data.pName+'&category='+data.cName+'&cid='+data.cUkey+'&iid='+data.piUkey+'&pid='+data.pUkey+'">'+(data.pName+' ('+data.piQty+data.piUnit+') '+' in <span style="color:#00e">'+data.cName)+'</span></a></li>');
	        	}
	        }   
     	}).catch(error=> {
    	
     	});
	});
	
</script>
@include('components.alert.tostr')
@stack('scripts')


</body>
</html>