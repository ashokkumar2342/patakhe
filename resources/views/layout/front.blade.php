<!DOCTYPE html>
<html>
<head>
	<title>@yield('title','i-caps')</title>
	@include('front.include.link')
	@stack('links')
</head>
<body>
@include('front.include.header')
@yield('content')
@include('front.include.script')
@stack('scripts')
@include('front.include.footer')
</body>
</html>