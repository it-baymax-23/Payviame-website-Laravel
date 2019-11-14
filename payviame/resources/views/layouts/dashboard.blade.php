<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
  	<title>{{ config('app.name') }} - @yield('title')</title>
  	<meta name="csrf-token" content="{{ csrf_token() }}">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://d3j9byh24fqslb.cloudfront.net/assets/redesign/vendor/nucleo/css/nucleo-06307e5fb5202d5657ede5f3566de1cb56dd9be9ddf9ee0586db7cf08d9a7277.css">
 	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">
  	<link href="{{asset('frontend/plugins/bootstrap-colorpicker/bootstrap-colorpicker.css')}}" rel="stylesheet" type="text/css"/>
  	<link href="{{asset('frontend/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="{{asset('frontend/css/styleee.css')}}">
  	

  	@stack('stylesheets')

</head>
<body class="app standard">
	<div id="header">
		<div class="edges" id="primary_nav">
			<div class="container">
				@include('includes.dashboard.navbar')
			</div>
		</div>
	</div>

	@yield('content')


	<div class="foot">
		<div class="edges">
			<div class="container">
				@include('includes.dashboard.footer')
			</div>
		</div>
	</div>	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="{{asset('frontend/plugins/bootstrap-colorpicker/bootstrap-colorpicker.js')}}"></script>
	<!-- <script src="{{asset('frontend/plugins/bootstrap-colorpicker/colorpicker-component.js')}}"></script> -->
	<script src="{{asset('frontend/plugins/bootstrap-toastr/toastr.min.js')}}"></script>
	@stack('scripts')

	@if ($message = Session::get('success'))
	    <!-- <script>toastr('Success', '{{ $message }}', 'success')</script> -->
	    <script>toastr['success']('{{ $message }}','Success')</script>
	@endif

	@if ($message = Session::get('error'))
	    <!-- <script>toastr('Error', '{{ $message }}', 'error')</script> -->
	    <script>toastr['error']('{{ $message }}','Error')</script>
	@endif
</body>
</html>
