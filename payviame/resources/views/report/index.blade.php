@extends('layouts.dashboard')

@section('title', __('Dashboard'))

@push('stylesheets')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />

@endpush

@section('content')
	
<div id="main">
	<div>
		<div id="page-head">
			<div class="page-title">
    	<div class="container">
      <h1>
        <a href="javascript:;">{{ __('Dashboard') }}</a>
        <!-- <i class="fa fa-angle-right"></i>
        Project Budgets -->
      </h1>
    </div>
  </div>
	<div class="clear"></div>
		</div>
	<div class="page-links">
   <div class="container">
    <div class="left-penal">
      <span style=" font-size: 15px; color: #fff"> Filter by currency </span>
      &nbsp;&nbsp;&nbsp;
      <select id="js-example-basic-single" class="form-20 js-example-basic-single" name="business_name" required>
        <option value="0" <?php echo ($current_currencyID == 0) ? 'selected' : '' ?>>Any currency</option>
        @foreach($currencies as $currency)
        <option value="{{ $currency->id }}" <?php echo ($currency->id == $current_currencyID) ? 'selected' : '' ?>>{{ $currency->currency_description }} ({{ $currency->currency_code }}&nbsp;{{ $currency->currency_symbol }})</option>
        @endforeach
      </select>
    </div>
    <div class="right-penal">
    	<div style="position: relative; top: -19px;"> 
      	<ul class="nav nav-tabs page-tab">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home">{{__('Overview')}}</a>
          </li>
         
        </ul>
    	</div>
    </div>
   </div>
  </div>
  <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class="container tab-pane active"><br>
      <div class="row mt-4">
        <div class="col-sm-1">
          
        </div>
        <div class="col-sm-5">
          <h2>{{__('Quotes')}}</h2>
          <hr>
          @if(!count($quotes))
          <span class="grey">{{__('No current quotes')}}</span>
          <hr class="space">
          @else
          <div class="row">
            <div class="col-sm-3">
              <h2>Drafted</h2><br>
              <h2>Sent</h2><br>
              <h2>Accepted</h2><br>
              <h2>Declined</h2><br>
              <h2>Total</h2><br>
            </div>
            <div class="col-sm-1">
              <h2>:</h2><br>
              <h2>:</h2><br>
              <h2>:</h2><br>
              <h2>:</h2><br>
              <h2>:</h2><br>
            </div>
            <div class="col-sm-8">
              <h2><span class="currency-summary"> {{$current_currency->currency_symbol}} {{$draft_total_sum}}<small class="grey"> {{$current_currency->currency_code}} </small></h2><br>
              <h2><span class="currency-summary"> {{$current_currency->currency_symbol}} {{$sent_total_sum}}<small class="grey"> {{$current_currency->currency_code}} </small></h2><br>
              <h2><span class="currency-summary"> {{$current_currency->currency_symbol}} {{$accepted_total_sum}}<small class="grey"> {{$current_currency->currency_code}} </small></h2><br>
              <h2><span class="currency-summary"> {{$current_currency->currency_symbol}} {{$declined_total_sum}}<small class="grey"> {{$current_currency->currency_code}} </small></h2><br>
              <h2><span class="currency-summary"> {{$current_currency->currency_symbol}} {{$total_quote_sum}}<small class="grey"> {{$current_currency->currency_code}} </small></h2><br>
            </div>
          </div>
          @endif
          <p class="grey">
            <a href="{{ route('quote.index') }}">{{__('View Quotes')}}</a>
          </p>
        </div>
        <div class="col-sm-5">
          <h2>{{__('Invoices')}}</h2>
          <hr>
          @if(!count($invoices))
          <span class="grey">{{__('No current invoices')}}</span>
          <hr class="space">
          @else
          <div class="row">
            <div class="col-sm-3">
              <h2>Paid</h2><br>
              <h2>Owing</h2><br>
              <h2>Overdue</h2><br>
              <h2>Total</h2><br>
            </div>
            <div class="col-sm-1">
              <h2>:</h2><br>
              <h2>:</h2><br>
              <h2>:</h2><br>
              <h2>:</h2><br>
            </div>
            <div class="col-sm-8">
              <h2><span class="currency-summary"> {{$current_currency->currency_symbol}} {{$paid}}<small class="grey"> {{$current_currency->currency_code}} </small></h2><br>
              <h2><span class="currency-summary"> {{$current_currency->currency_symbol}} {{$owing}}<small class="grey"> {{$current_currency->currency_code}} </small></h2><br>
              <h2><span class="currency-summary"> {{$current_currency->currency_symbol}} {{$overdue}}<small class="grey"> {{$current_currency->currency_code}} </small></h2><br>
              <h2><span class="currency-summary"> {{$current_currency->currency_symbol}} {{$total_invoice_sum}}<small class="grey"> {{$current_currency->currency_code}} </small></h2><br>
              <h2><span class="currency-summary">
            </div>
          </div>
          @endif
          <p class="grey">
            <a href="{{ route('invoice.index') }}">{{__('View Invoices')}}</a>
          </p>
        </div>
        <div class="col-sm-1">
          <!-- <h2>{{__('Unbilled')}}</h2>
          <hr>
          <span class="currency">$</span>
          <span class="amount">0</span>
          <br>
          <span class="grey">
            USD
            {{__('unbilled')}}
          </span>
          <hr class="space">
          <p class="grey">
            <a href="#">{{__('Full Report')}}</a>
          </p> -->
        </div>
      </div>
    </div>
    <!-- <div id="menu2" class="container tab-pane fade"><br>
      <div class="report-contents">
				<div class="info">
					<p class="text-center mb-0">
					You don't have any projects with an estimated duration. Here's an example of what this report would look like if you did:
					</p>
				</div>
				<img style="max-width: 950px; display: block; margin: 0 auto;" src="images/project-budgets1.png">
			 </div>
    </div> -->
  </div>


	</div>
</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

<script>

  $(document).ready(function() {
    $('#js-example-basic-single').select2();
  });

  $('#js-example-basic-single').change(function(){
    var currency_id = $('option:selected', this).val();
    console.log(currency_id);
    if (currency_id != 0) {
      url = '{{config('app.url')}}' + '/dashboard?currency_id=' + currency_id;
    }else {
      url = '{{config('app.url')}}' + '/dashboard';
    }
      window.location.href = url;

  });

</script>
@endpush