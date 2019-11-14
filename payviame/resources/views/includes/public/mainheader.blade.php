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
<div class="col px-0 text-white">
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
    </div>
</div>