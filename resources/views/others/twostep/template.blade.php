<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<link rel="icon" href="{{ URL::asset('images/favicon.ico') }}">
	<title>@yield('title')SIC</title>
	<meta name="description" content="Student Information Center is a locally hosted web portal designed for Graphic Era Hill University, Bhimtal Campus">
    <meta name="author" content="Utkarsh Vishnoi">
	<link rel="stylesheet" type="text/css" href="{{ elixir('css/all.css') }}">
	<!-- Designed and developed by Utkarsh Vishnoi [https://utkarsh-vishnoi.github.io] -->
    <style type="text/css">
    	@yield('styles')
    </style>
	<script type="text/javascript">
		var app_url = "{{ url('/') }}";
		@yield('pre-scripts')
	</script>
</head>
<body>
<!-- Preloader -->
<div id="preloader">
    <div id="status">&nbsp;</div>
</div>
<!-- Header Start -->
@include('others.twostep.partials.header')
<!-- Header End -->
<!-- Content Start -->
@yield('content')
<!-- Content end -->
<!-- Footer Start -->
@include('templates.partials.footer')
<!-- Footer End -->
<script type="text/javascript" src="{{ elixir('js/all.js') }}"></script>
@include('templates.partials.notify')
<!-- Scripts Start -->
<script type="text/javascript">
	@yield('post-scripts')
</script>
<!-- Scripts end -->
</body>
</html>