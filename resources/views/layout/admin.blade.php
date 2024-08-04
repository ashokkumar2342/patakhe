<!DOCTYPE html>
<html>
<head>
	<title>@yield('title','I-caps :: Admin-panel')</title>
	@include('admin.include.link')
	@stack('links')
</head>
<body>
@yield('content')
@include('admin.include.script')
@stack('sctipts')
</body>
</html>