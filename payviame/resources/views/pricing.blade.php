

@extends('layouts.public')

@section('title', __('Online & Easy Invoice Software For Startup Companies'))

@push('stylesheets')
<style type="text/css">

  * {
    box-sizing: border-box;
  }

  .columns {
    float: left;
    width: 20%;
    padding: 8px;
  }

  .price {
    list-style-type: none;
    border: 1px solid #eee;
    margin: 0;
    padding: 0;
    -webkit-transition: 0.3s;
    transition: 0.3s;
  }

  .price:hover {
    box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
  }

  .price .header {
    background-color: #3C5898;
    color: white;
    font-size: 25px;
  }

  .price li {
    border-bottom: 1px solid #eee;
    padding: 20px;
    text-align: center;
  }

  .price .grey {
    background-color: #eee;
    font-size: 20px;
  }

  .price .white {
    background-color: #fff;
  }

  .button {
    background-color: #3C5898;
    border: none;
    color: white;
    padding: 10px 25px;
    text-align: center;
    text-decoration: none;
    font-size: 18px;
  }

  @media only screen and (max-width: 600px) {
    .columns {
      width: 100%;
    }
  }
</style>

@endpush

@section('content')


<header class="header-global">
  <nav class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light">
    
    @include('includes.public.navbar')
    
  </nav>
</header>

<main>  
  <header class="position-relative">
    <div class="top-section-lined"> 
      
      <div class="line line-style-1 inner-section-lined">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span> 
      </div>  
      <div class="container line-container d-flex">
        <!-- <div class="col px-0 text-white">
          <div class="row">
            <div class="col-lg-8">
              <h1 class="simple-text">
                <span class="for-free">{{__('Online & Easy Invoice Software For Startup Companies')}}</span>
              </h1>
              <p class="lead">{{__('Instantly create Quotes & Invoices and manage your customers. We help you save time and the amount spent on accounting services.')}}</p>
              <div class="btn-wrapper">
                @if (Auth::guest())
                <a class="btn btn-orange btn-icon mb-3 mb-sm-0" href="{{ route('register')}}">
                  <span class="btn-inner--icon">
                  <i class="ni ni-spaceship"></i></span>
                  <span class="btn-inner--text">{{__('14-day Free Trial')}}</span>
                </a>            
                
                @endif
              </div>
            </div>
          </div>
        </div> -->
      </div>

    </div>
  </header>
  <section class="section section-lg pt-lg-0" style="margin-top: -350px">
    <div>
      <h2 style="text-align:center; color: #fff;">PayViaMe Pricing</h2>
      <p style="text-align:center; color: #fff;">No credit card required to sign up!</p>

      <div class="columns">
        <ul class="price">
          <li class="header">Starter</li>
          <li class="grey">€ 10 / month</li>
          <li class="white">Single User</li>
          <li class="white">20 Clients</li>
          <li class="white">Unlimited Quotes & Invoices</li>
          <li class="grey"><a href="#" class="button">Try Free</a></li>
        </ul>
      </div>

      <div class="columns">
        <ul class="price">
          <li class="header">Small Team</li>
          <li class="grey">€ 15 / month</li>
          <li class="white">2 Team Members</li>
          <li class="white">50 Clients</li>
          <li class="white">Unlimited Quotes & Invoices</li>
          <li class="grey"><a href="#" class="button">Try Free</a></li>
        </ul>
      </div>

      <div class="columns">
        <ul class="price">
          <li class="header">Medium Team</li>
          <li class="grey">€ 22 / month</li>
          <li class="white">4 Team Members</li>
          <li class="white">100 Clients</li>
          <li class="white">Unlimited Quotes & Invoices</li>
          <li class="grey"><a href="#" class="button">Try Free</a></li>
        </ul>
      </div>

      <div class="columns">
        <ul class="price">
          <li class="header">Large Team</li>
          <li class="grey">€ 36 / month</li>
          <li class="white">8 Team Members</li>
          <li class="white">250 Clients</li>
          <li class="white">Unlimited Quotes & Invoices</li>
          <li class="grey"><a href="#" class="button">Try Free</a></li>
        </ul>
      </div>

      <div class="columns">
        <ul class="price">
          <li class="header">Enterprise</li>
          <li class="grey">€ 50 / month</li>
          <li class="white">4 Team Members</li>
          <li class="white">Unlimited Clients</li>
          <li class="white">Unlimited Quotes & Invoices</li>
          <li class="grey"><a href="#" class="button">Try Free</a></li>
        </ul>
      </div>
    </div>
  </section>

  <section class="section section-lg" style="margin-top: 350px">
    
    <footer class="footer has-cards">
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
    
  </section>

</main>



@endsection


