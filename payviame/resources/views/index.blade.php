@extends('layouts.public')

@section('title', __('Online & Easy Invoice Software For Startup Companies'))

@section('content')


<header class="header-global">
  <nav class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light">
    
    @include('includes.public.navbar')
  	
  </nav>
</header>

<main>	
  <header class="position-relative">
    <div class="top-section-lined">	
      
      @include('includes.public.mainheader')

    </div>
  </header>
  <section class="section section-lg pt-lg-0 mt--200">
    <div class="container">
      
      @include('includes.public.section1')
      
    </div>
  </section>
  <section class="section section-lg">
    <div class="container">
      
      @include('includes.public.section2')
      
    </div>
  </section>
  <section class="section bg-secondary">
    <div class="container">
      
      @include('includes.public.section3')
      
    </div>
  </section>
  <section class="section section-lg section-lined my-0 overflow-hidden">
    
    @include('includes.public.section4')
    
  </section>	
</main>

@endsection

