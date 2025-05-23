<!DOCTYPE html>
<html dir="{{ is_rtl() }}">
<head>
	@extends('api.partials._head')
</head>
<body>

	@yield('content')

	@extends('api.partials._js')
</body>
</html>