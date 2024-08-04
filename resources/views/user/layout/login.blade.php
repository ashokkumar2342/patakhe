<!DOCTYPE html>
<html>
<head>
	<title>@yield('title','i-caps')</title>
	@include('front.include.link')
	<link href="{{ asset('js/toastr-master/toastr.css') }}" rel="stylesheet" type="text/css" />
	@stack('links')
</head>
<body>
@include('front.include.header')
@yield('content')
@include('front.include.script')
@stack('scripts')
    <script src="{{asset('js/toastr-master/toastr.js') }}"></script>
    @include('components.alert.tostr')
@include('front.include.footer')
</body>
</html>