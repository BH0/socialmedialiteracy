<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>@yield('title')</title>

	
		<!-- Bulma CDN --> 
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.0/css/bulma.min.css" rel="stylesheet" type="text/css"> 
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" > 

		<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css"> 

		<!-- Fonts --  
		<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> 
		--> 

	</head>
	<body>
		@include('includes.header')
		<div class="container">
			@yield('content')
		</div>

		<!-- JQuery is only here for testing -->
		<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
   
		<script src="{{ URL::to('js/scripts.js') }}"></script>
	</body>
</html>
