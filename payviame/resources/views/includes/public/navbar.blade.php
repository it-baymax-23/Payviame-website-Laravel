<div class="container">
  <a class="navbar-brand" href="{{config('app.url')}}">
		<div class="logo">
			<img src="{{asset('frontend/images/logo.png')}}">
		</div>
	</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <!--<li class="nav-item">-->
      <!--  <a class="nav-link" href="#">Features</a>-->
      <!--</li>-->
			<li class="nav-item dropdown">
				<a class="nav-link dropbtn" href="#">{{__('Features')}}</a>
				<div class="dropdown-content">
					<a href="">{{__('Invoicing')}}</a>
					<a href="">{{__('Quoting')}}</a>
					<a href="">{{__('Reporting')}}</a>
					<a href="">{{__('Team Management')}}</a>
					<a href="">{{__('Client Management')}}</a>
				</div>
			</li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('pricing')}}">{{__('Pricing')}}</a>
      </li>  
    </ul>
		<ul class="navbar-nav align-items-lg-center ml-lg-auto">
      @if (Auth::guest())
      <li class="nav-item d-none d-lg-block ml-lg-4">
         <a class="btn btn-neutral btn-icon" href="{{ route('register')}}">
            <span class="btn-inner--icon">
               <i class="ni ni-calendar-grid-58"></i>
            </span>
            <span class="nav-link-inner--text">{{__('TRY FREE')}}</span>
				 </a>    
			</li>
			<li class="nav-item d-none d-lg-block ml-lg-4">
        <a class="btn btn-neutral btn-icon" href="{{ route('login') }}">
          <span class="btn-inner--icon">
             <i class="ni ni-single-02"></i>
          </span>
          <span class="nav-link-inner--text">{{__('Sign In')}}</span>
    		</a>
			</li>
      @else
      <li class="nav-item d-none d-lg-block ml-lg-4">
        <a class="btn btn-neutral btn-icon" href="{{ route('report.index') }}">
          <span class="btn-inner--icon">
             <i class="ni ni-single-02"></i>
          </span>
          <span class="nav-link-inner--text">{{__('Dashboard')}}</span>
        </a>
      </li>
      <li class="nav-item d-none d-lg-block ml-lg-4">
        <a class="btn btn-neutral btn-icon" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
          <span class="btn-inner--icon">
             <i class="ni ni-single-02"></i>
          </span>
          <span class="nav-link-inner--text">{{__('Log Out')}}</span>
        </a>
        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none">
            @csrf
        </form>
      </li>
      @endif
    </ul>
  </div>  
</div>