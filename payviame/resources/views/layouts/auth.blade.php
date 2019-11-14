<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name') }} - @yield('title')</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
  <link rel="stylesheet" href="https://d3j9byh24fqslb.cloudfront.net/assets/redesign/vendor/nucleo/css/nucleo-06307e5fb5202d5657ede5f3566de1cb56dd9be9ddf9ee0586db7cf08d9a7277.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">

   @stack('stylesheets')
   
</head>
<body>
  <header class="header-global">
<nav class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light">
  <div class="container">
  <a class="navbar-brand" href="{{config('app.url')}}">
    <div class="logo">
      <img src="{{ asset('frontend/images/logo.png') }}">
    </div>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropbtn" href="#">Features</a>
        <div class="dropdown-content">
					<a href="">{{__('Invoicing')}}</a>
					<a href="">{{__('Quoting')}}</a>
					<a href="">{{__('Reporting')}}</a>
					<a href="">{{__('Team Management')}}</a>
					<a href="">{{__('Client Management')}}</a>
				</div>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="{{ route('pricing')}}">Pricing</a>
      </li>  
    </ul>
    <ul class="navbar-nav align-items-lg-center ml-lg-auto">
      <li class="nav-item d-none d-lg-block ml-lg-4">
         <a class="btn btn-neutral btn-icon" href="{{ route('register')}}">
            <span class="btn-inner--icon">
               <i class="ni ni-spaceship"></i>
            </span>
            <span class="nav-link-inner--text">Try Free</span>
         </a>    
      </li>
    </ul>
  </div>  
  </div>
</nav>
</header>

    @yield('content')
                
<footer class="footer has-cards" style="margin-top: 50px;">
  <div class="container">
 
    <hr>
    <div class="row align-items-center justify-content-md-between">
      <div class="col-md-6">
        <div class="copyright">
          © 2019
          <a href="https://payvia.me/payviame" target="_blank">PayViaMe</a>
        </div>
      </div>
      <div class="col-md-6">
        <ul class="nav nav-footer justify-content-end">
          <li class="nav-item">
            <a class="nav-link" target="_blank" href="blog.php">Blog</a>
          </li>
     
          <li class="nav-item">
            <a class="nav-link" target="_blank" href="pricing">Pricing</a>
          </li>
             <li class="nav-item">
            <a class="nav-link" target="_blank" href="privacy.php">Privacy Policy</a>
          </li>
           <li class="nav-item">
            <a class="nav-link" target="_blank" href="terms.php">Terms of Service</a>
          </li>
        </ul>
      </div>
    </div>
   
    </div>
  </div>
</footer>

</body>
</html>