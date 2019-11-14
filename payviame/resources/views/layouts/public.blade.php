<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  	<title>{{config('app.name')}} - @yield('title')</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta name="description" content="Online & Easy Invoice Software For Startup Companies. Instantly create Quotes & Invoices and manage your customers. We help you save time and amount spent on accounting services. ">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
	<link rel="stylesheet" href="https://d3j9byh24fqslb.cloudfront.net/assets/redesign/vendor/nucleo/css/nucleo-06307e5fb5202d5657ede5f3566de1cb56dd9be9ddf9ee0586db7cf08d9a7277.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">

   	@stack('stylesheets')
</head>
<body>

	@yield('content')

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>