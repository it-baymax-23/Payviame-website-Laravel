@extends('layouts.dashboard')

@section('title', __('Quotes'))

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
              <a href="{{ route('quote.index') }}">{{__('Quotes')}}</a>
            </h1>
          </div>
      </div>
      <div class="clear"></div>
    </div>
    <div class="page-links">
      <div class="container">
        <div class="left-penal">   
          <div id="new-in">  
            <div id="flip"><button class="flip-in">New Quote</button></div>
            <div id="panel">
              <form class="dropdown_inline_form" method="POST" action="{{route('quote.store')}}">
                @csrf
                <span style="color: #fff; font-size: 18px;"> New Quote </span>
                &nbsp;&nbsp;&nbsp;
                <select id="js-example-basic-single" class="form-20 js-example-basic-single" name="business_name" required>
                  <option></option>
                  @foreach($clients as $client)
                  <option value="{{ $client->business_name }}">{{ $client->business_name }}</option>
                  @endforeach
                </select>
                &nbsp;&nbsp;&nbsp;
                <button class="btn btn-success" type="submit" style="background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#3b768e), to(#33677c)); border: 1px solid #2d5b6e;">
                    Draft Blank Quote
                </button>
              </form>
            </div>
            <div class="clear"></div>
          </div>
          <!-- <div>
            <button id="new-creat" class="flip-in" data-toggle="modal" data-target="#myModal" style="display: none;">Create a Recurring Quote</button>
          </div> -->
        </div>
        <!-- <div class="right-penal">   
          <div style="position: relative;top: -32px;"> 
            <ul class="nav nav-tabs page-tab">
              <li class="nav-item" onclick="myCX2()">
                <a class="nav-link active" data-toggle="tab" href="#home">Invoices</a>
              </li>
              <li class="nav-item" onclick="myCX()">
                <a class="nav-link" data-toggle="tab" href="#menu2">Recurring</a>
              </li>
            </ul>
          </div>
        </div> -->
      </div>
    </div>
    <!-- <div class="page-links">
        <div class="container">
            <div style="position: relative;">
                <ul class="nav nav-tabs page-tab">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home">Overview</a>
                       </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu2">Project Budgets</a>
                    </li>
                </ul>
            </div>
        </div>
    </div> -->
    <!-- Tab panes -->
    <div class="tab-content container">
      <div id="home" class="container tab-pane invoice-tab-1 active  ">
        <div class="mb-3 mt-5">
          <select id="status" name="status" class="custom-select" style="width:170px;float: left; margin-right: 10px;">
            <option value="current" <?php echo ($status == 'current') ? 'selected' : '' ?>>Current Quotes</option>
            <option value="accepted" <?php echo ($status == 'accepted') ? 'selected' : '' ?>>Accepted Quotes</option>
            <option value="declined" <?php echo ($status == 'declined') ? 'selected' : '' ?>>Declined Quotes</option>
            <option value="all" <?php echo ($status == 'all') ? 'selected' : '' ?>>All Quotes</option>
          </select>
          <p style="float: left; padding-top:10px; margin-right: 10px; color: #919191;">that were</p>
          <select id="by" name="by" class="custom-select" style="width:120px;float: left; margin-right: 10px;">
            <option value="issued_at" <?php echo ($by == 'issued_at') ? 'selected' : '' ?>>Issued</option>
            <option value="accepted_at" <?php echo ($by == 'accepted_at') ? 'selected' : '' ?>>Accepted</option>
            <option value="declined_at" <?php echo ($by == 'declined_at') ? 'selected' : '' ?>>Declined</option>
          </select>
          <p style="float: left; padding-top:10px; margin-right: 10px;     color: #919191;">in</p>
          <select id="range" name="range" class="custom-select" style="width:120px;float: left; margin-right: 10px;">
            <option value="week" <?php echo ($range == 'week') ? 'selected' : '' ?>>Week</option>
            <option value="month" <?php echo ($range == 'month') ? 'selected' : '' ?>>Month</option>
            <option value="quarter" <?php echo ($range == 'quarter') ? 'selected' : '' ?>>Quarter</option>
            <option value="year" <?php echo ($range == 'year') ? 'selected' : '' ?>>Year</option>
            <option value="custom" <?php echo ($range == 'custom') ? 'selected' : '' ?>>Custom</option>
            <option value="all-time" <?php echo ($range == 'all-time') ? 'selected' : '' ?>>All time</option>
          </select>
          <div id="display_date" style="padding-top: 5px; <?php echo ($range == 'all-time' || $range == 'custom') ? 'display: none;' : '' ?>">
            <span class="display_date1" style="float: left; border-radius: .25rem; height: 37px; line-height: 31px; padding: 0 10px; background: rgba(0,0,0,0.05); box-shadow: inset 0 0 1px rgba(0,0,0,0.1); display: inline-block; padding: .375rem .75rem .375rem .75rem;"></span>&nbsp;&nbsp;<span class="display_date2" style=" height: 37px; line-height: 31px; padding: 0 10px; display: inline-block; padding: .375rem .75rem .375rem .75rem;"></span>
          </div>
          <div id="custom_range" style="padding-top: 15px; <?php echo ($range != 'custom') ? 'display: none;' : '' ?>">
            <input type="date" name="date_issued" class="datepic-im" id="start" style="border: 0;" value="{{$start}}">
            <span style="padding-left: 10px; padding-right: 10px;">to</span>
            <input type="date" name="date_issued" class="datepic-im" id="end" style="border: 0;" value="{{$end}}">
          </div>
          
          <!-- <button class="btn" style="float: right;  margin-right: 10px;"><i class="fa fa-chevron-right"></i></button>
          <button class="btn" style="float: right;  margin-right: 10px;"><i class="fa fa-home"></i></button>
          <button class="btn" style="float: right;  margin-right: 10px;"><i class="fa fa-chevron-left"></i></button> -->
        </div>
        <div class="clear"></div>
        <div class="mb-3 mt-1">
          <a href="javascript:;" id="flip_filter" style="color: #919191; text-decoration: none; float: left;" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-cog"></i>&nbsp;&nbsp;More Filters</a>
          <!-- <a href="javascript:;" style="color: #919191; text-decoration: none; float: right;"><i class="fa fa-file"></i>&nbsp;&nbsp;Download CSV</a>
          <a href="javascript:;" style="color: #919191; text-decoration: none; float: right; margin-right: 15px;"><i class="fa fa-download"></i>&nbsp;&nbsp;Download PDFs</a> -->
        </div>
        <div class="clear"></div>
        <div class="collapse" id="collapseExample">
          <div class="card card-body mt-3">
            <div class="row">
              <div class="col-sm-5" style="margin-top: 5px">
                <span style=" font-size: 15px;"> Filter by client </span>
                &nbsp;&nbsp;&nbsp;
                <select id="js-example-basic-single1" class="form-20 js-example-basic-single" name="business_name" required>
                  <option value="0" <?php echo ($clientID == 0) ? 'selected' : '' ?>>Any client</option>
                  @foreach($clients as $client)
                  <option value="{{ $client->id }}" <?php echo ($client->id == $clientID) ? 'selected' : '' ?>>{{ $client->business_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-sm-5" style="margin-top: 5px">
                <span style=" font-size: 15px;"> Filter by currency </span>
                &nbsp;&nbsp;&nbsp;
                <select id="js-example-basic-single2" class="form-20 js-example-basic-single" name="business_name" required>
                  <option value="0" <?php echo ($current_currencyID == 0) ? 'selected' : '' ?>>Any currency</option>
                  @foreach($currencies as $currency)
                  <option value="{{ $currency->id }}" <?php echo ($currency->id == $current_currencyID) ? 'selected' : '' ?>>{{ $currency->currency_description }} ({{ $currency->currency_code }}&nbsp;{{ $currency->currency_symbol }})</option>
                  @endforeach
                </select>
              </div>
              <div class="col-sm-2 text-center">
                <button class="btn more_filters" >Filter</button>
              </div>
            </div>
          </div>
        </div>
        <div class="clear"></div>
        <div class="summary-row mb-3 mt-4">
          @if(!$current_currency)
          <div class="row">
            <div class="col-2">
              <div class="summary-heading">DRAFTED</div>
              <div class="currency-summary">{{config('app.currency_symbol')}} {{$draft_total_sum}}<small class="grey"> {{config('app.currency_code')}} </small></div>
            </div>
            <div class="col-3">
              <div class="summary-heading">SENT</div>
              <div class="currency-summary">{{config('app.currency_symbol')}} {{$sent_total_sum}}<small class="grey"> {{config('app.currency_code')}} </small></div>
            </div>
            <div class="col-2">
              <div class="summary-heading">ACCEPTED</div>
              <div class="currency-summary">{{config('app.currency_symbol')}} {{$accepted_total_sum}}<small class="grey"> {{config('app.currency_code')}} </small></div>
            </div>
            <div class="col-3">
              <div class="summary-heading">DECLINED</div>
              <div class="currency-summary">{{config('app.currency_symbol')}} {{$declined_total_sum}}<small class="grey"> {{config('app.currency_code')}} </small></div>
            </div>
            <div class="col-2">
              <div class="summary-heading">TOTAL</div>
              <div class="currency-summary">{{config('app.currency_symbol')}} {{$total_sum}}<small class="grey"> {{config('app.currency_code')}} </small></div>
            </div>
          </div>
          @else
          <div class="row">
            <div class="col-2">
              <div class="summary-heading">DRAFTED</div>
              <div class="currency-summary">{{$current_currency->currency_symbol}} {{$draft_total_sum}}<small class="grey"> {{$current_currency->currency_code}} </small></div>
            </div>
            <div class="col-3">
              <div class="summary-heading">SENT</div>
              <div class="currency-summary">{{$current_currency->currency_symbol}} {{$sent_total_sum}}<small class="grey"> {{$current_currency->currency_code}} </small></div>
            </div>
            <div class="col-2">
              <div class="summary-heading">ACCEPTED</div>
              <div class="currency-summary">{{$current_currency->currency_symbol}} {{$accepted_total_sum}}<small class="grey"> {{$current_currency->currency_code}} </small></div>
            </div>
            <div class="col-3">
              <div class="summary-heading">DECLINED</div>
              <div class="currency-summary">{{$current_currency->currency_symbol}} {{$declined_total_sum}}<small class="grey"> {{$current_currency->currency_code}} </small></div>
            </div>
            <div class="col-2">
              <div class="summary-heading">TOTAL</div>
              <div class="currency-summary">{{$current_currency->currency_symbol}} {{$total_sum}}<small class="grey"> {{$current_currency->currency_code}} </small></div>
            </div>
          </div>
          @endif
        </div>
        
        <div class="mb-3 mt-4">
          @foreach($quotes as $quote)
          <a href="{{ route('quote.show', $quote->id) }}">
          <div class="grid invoice">
            <div class="invoice_client_details">
              @if(!isset($quote->client->client_logo))
              <div class="badge " style="background-color: {{ $quote->client->monogram_color }}">{{ $quote->client->monogram_name}}</div>
              @else
              <img src="{{asset($quote->client->client_logo)}}" width="40" height="40">
              @endif
              <span class="number">{{ $quote->id }}</span>
            </div>
              <!-- <div class="btn-group invoice-actions">
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                  <i class="icon-caret-down"></i>
                </a>
                <ul class="dropdown-menu pull-right">
                  <li>
                    <a target="_blank" href="javascript:;"><i class="fa fa-print"></i>&nbsp;&nbsp; Print</a>
                  </li>
                  <li>
                    <a target="_blank" href="javascript:;"><i class="fa fa-download"></i>&nbsp;&nbsp; Get PDF</a>
                  </li>
                  <li>
                    <a target="_blank" href="javascript:;"><i class="fa fa-history"></i>&nbsp;&nbsp; Billed Time</a>
                  </li>
                  <li>
                    <a target="_blank" href="javascript:;"><i class="fa fa-globe"></i>&nbsp;&nbsp; View Online</a>
                  </li>
                </ul>
              </div> -->
            @if($quote->status == 0)
            <div class="draft tag">
              Draft
            </div>
            @elseif($quote->status == 1)
            <div class="draft tag" style="background-color: #6c757d;">
              Sent
            </div>
            @elseif($quote->status == 2)
            <div class="draft tag" style="background-color: #6f42c1;">
              Accepted
            </div>
            @else
            <div class="draft tag" style="background-color: #dc3545;">
              Declined
            </div>
            @endif
            <div class="description">
              No description
            </div>
            <div class="total">
              <span class="currency">{{$quote->currency->currency_symbol}}</span><span class="amount">{{ $quote->sum_total }}</span>
            </div>
            <div class="currency_code">{{$quote->currency->currency_code}}</div>
            <!-- <a class="overlay" data-behaviour="backbone_link" href="#"></a> -->
          </div>
          </a>
          @endforeach
        </div>
      </div>

      <div id="menu2" class="container tab-pane fade">
        <div class="container mt-5">
          <div class="box empty t-center">
            <h2>Do you bill your clients at regular intervals?</h2>
            <p>With Recurring Invoices you can automatically generate invoices according to a schedule. When a new invoice is generated we'll email you to let you know.</p>
            <p>
              You'll have a chance to review and edit the drafted invoice before sending it to your client. Generated invoices are
              <u>not</u>
              sent to your client automatically.
            </p>
            <p>
              <a class="button_link dismiss grey" href="#" data-remote="">Ok, got it!</a>
            </p>
          </div>
          <div class="current_invoices_list mt-2">
            <div class="box empty">
              <p class="t-center">
                You haven't created any recurring invoices.
                <a href="#" target="_blank">Learn how to create a recurring invoice</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script>

  $(document).ready(function() {
    $('#js-example-basic-single').select2();
    $('#js-example-basic-single1').select2();
    $('#js-example-basic-single2').select2();

    $("#flip").click(function(){
      $("#panel").slideToggle("slow");
    });

    $("#flip_filter").click(function(){
      $("#panel_filter").slideToggle("slow");
    });
    $('.display_date1').html(window.sessionStorage.getItem('html1'));
    $('.display_date2').html(window.sessionStorage.getItem('html2'));
  });

  var start = window.sessionStorage.getItem('start');
  if (!start)
    start = '';
  var end = window.sessionStorage.getItem('end');
  if (!end)
    end = '';
  var months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
  var date= new Date();
  var current_date = date.getFullYear() + '-'  + (date.getMonth()+1) + '-' + date.getDate();
  $('#status').change(function(){
    var status = $('option:selected', '#status').val();
    var by = $('option:selected', '#by').val();
    var range = $('option:selected', '#range').val();
    url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by;

    var client_id = $('option:selected', '#js-example-basic-single1').val();
    var currency_id = $('option:selected', '#js-example-basic-single2').val();

    if (client_id != 0 || currency_id != 0) {
      if (client_id != 0) {
        if (currency_id != 0) {
          url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&client_id=' + client_id + '&currency_id=' + currency_id;
          // console.log(url);
        } else {
          url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&client_id=' + client_id;
          // console.log(url);
        }
      } else {
        if (currency_id != 0) {
          url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&currency_id=' + currency_id;
          // console.log(url);
        }
      }
    }
    console.log(url);
    window.location.href = url;
  });

  $('#by').change(function(){
    var status = $('option:selected', '#status').val();
    var by = $('option:selected', '#by').val();
    var range = $('option:selected', '#range').val();
    url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by;

    var client_id = $('option:selected', '#js-example-basic-single1').val();
    var currency_id = $('option:selected', '#js-example-basic-single2').val();

    if (client_id != 0 || currency_id != 0) {
      if (client_id != 0) {
        if (currency_id != 0) {
          url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&client_id=' + client_id + '&currency_id=' + currency_id;
          // console.log(url);
        } else {
          url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&client_id=' + client_id;
          // console.log(url);
        }
      } else {
        if (currency_id != 0) {
          url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&currency_id=' + currency_id;
          // console.log(url);
        }
      }
    }
    console.log(url);
    window.location.href = url;
  });

  $('#range').change(function(){
    var status = $('option:selected', '#status').val();
    var by = $('option:selected', '#by').val();
    var range = $('option:selected', '#range').val();
    if (range == 'custom')
    {
      $('#display_date').hide();
      $('#custom_range').show();
    } else if (range == 'week') {
      $('#custom_range').hide();
      $('#display_date').show();
      var first = date.getDate() - date.getDay();
      var last = first + 6;
      var firstday = new Date(date.setDate(first));
      var lastday = new Date(date.setDate(last));
      var fm = firstday.getMonth()+1;
      if (fm < 10)
        fm = '0' + fm;
      var fd = firstday.getDate();
      if (fd < 10)
        fd = '0' + fd;
      start = firstday.getFullYear() + '-'  + fm + '-' + fd;
      var lm = lastday.getMonth()+1;
      if (lm < 10)
        lm = '0' + lm;
      var ld = lastday.getDate();
      if (ld < 10)
        ld = '0' + ld;
      end = lastday.getFullYear() + '-'  + lm + '-' + ld;
      window.sessionStorage.setItem('start', start);
      window.sessionStorage.setItem('end', end);
      html1 = fd + ((firstday.getMonth() == lastday.getMonth()) ? '' : ' ' + months[firstday.getMonth()]) + ' to ' + ld + ' ' + months[lastday.getMonth()] + ', ' + lastday.getFullYear();
      html2 = '(this week)';
      window.sessionStorage.setItem('html1', html1);
      window.sessionStorage.setItem('html2', html2);
      console.log('today:' + current_date + ', start of week:' + start + ', end of week:' + end);
      url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by;

      var client_id = $('option:selected', '#js-example-basic-single1').val();
      var currency_id = $('option:selected', '#js-example-basic-single2').val();

      if (client_id != 0 || currency_id != 0) {
        if (client_id != 0) {
          if (currency_id != 0) {
            url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&client_id=' + client_id + '&currency_id=' + currency_id;
            // console.log(url);
          } else {
            url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&client_id=' + client_id;
            // console.log(url);
          }
        } else {
          if (currency_id != 0) {
            url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&currency_id=' + currency_id;
            // console.log(url);
          }
        }
      }
      console.log(url);
      window.location.href = url;
    } else if (range == 'month') {
      $('#custom_range').hide();
      $('#display_date').show();
      var firstday = new Date(date.getFullYear(), date.getMonth(), 1);
      var lastday = new Date(date.getFullYear(), date.getMonth() + 1, 0);
      var fm = firstday.getMonth()+1;
      if (fm < 10)
        fm = '0' + fm;
      var fd = firstday.getDate();
      if (fd < 10)
        fd = '0' + fd;
      start = firstday.getFullYear() + '-'  + fm + '-' + fd;
      var lm = lastday.getMonth()+1;
      if (lm < 10)
        lm = '0' + lm;
      var ld = lastday.getDate();
      if (ld < 10)
        ld = '0' + ld;
      end = lastday.getFullYear() + '-'  + lm + '-' + ld;
      html1 = fd + ' to ' + ld + ' ' + months[lastday.getMonth()] + ', ' + lastday.getFullYear();
      html2 = '(this month)';
      window.sessionStorage.setItem('html1', html1);
      window.sessionStorage.setItem('html2', html2);
      window.sessionStorage.setItem('start', start);
      window.sessionStorage.setItem('end', end);
      console.log('today:' + current_date + ', start of month:' + start + ', end of month:' + end);
      url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by;

      var client_id = $('option:selected', '#js-example-basic-single1').val();
      var currency_id = $('option:selected', '#js-example-basic-single2').val();

      if (client_id != 0 || currency_id != 0) {
        if (client_id != 0) {
          if (currency_id != 0) {
            url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&client_id=' + client_id + '&currency_id=' + currency_id;
            // console.log(url);
          } else {
            url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&client_id=' + client_id;
            // console.log(url);
          }
        } else {
          if (currency_id != 0) {
            url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&currency_id=' + currency_id;
            // console.log(url);
          }
        }
      }
      console.log(url);
      window.location.href = url;
    } else if (range == 'quarter') {
      $('#custom_range').hide();
      $('#display_date').show();
      var quarter = Math.floor((date.getMonth() / 3));
      var firstday = new Date(date.getFullYear(), quarter * 3, 1);
      var lastday = new Date(firstday.getFullYear(), firstday.getMonth() + 3, 0);
      var fm = firstday.getMonth()+1;
      if (fm < 10)
        fm = '0' + fm;
      var fd = firstday.getDate();
      if (fd < 10)
        fd = '0' + fd;
      start = firstday.getFullYear() + '-'  + fm + '-' + fd;
      var lm = lastday.getMonth()+1;
      if (lm < 10)
        lm = '0' + lm;
      var ld = lastday.getDate();
      if (ld < 10)
        ld = '0' + ld;
      end = lastday.getFullYear() + '-'  + lm + '-' + ld;
      html1 = fd + ' ' + months[firstday.getMonth()] + ' to ' + ld + ' ' + months[lastday.getMonth()] + ', ' + lastday.getFullYear();
      html2 = '(this quarter)';
      window.sessionStorage.setItem('html1', html1);
      window.sessionStorage.setItem('html2', html2);
      window.sessionStorage.setItem('start', start);
      window.sessionStorage.setItem('end', end);
      console.log('today:' + current_date + ', start of quarter:' + start + ', end of quarter:' + end);
      url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by;

      var client_id = $('option:selected', '#js-example-basic-single1').val();
      var currency_id = $('option:selected', '#js-example-basic-single2').val();

      if (client_id != 0 || currency_id != 0) {
        if (client_id != 0) {
          if (currency_id != 0) {
            url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&client_id=' + client_id + '&currency_id=' + currency_id;
            // console.log(url);
          } else {
            url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&client_id=' + client_id;
            // console.log(url);
          }
        } else {
          if (currency_id != 0) {
            url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&currency_id=' + currency_id;
            // console.log(url);
          }
        }
      }
      console.log(url);
      window.location.href = url;
    } else if (range == 'year') {
      $('#custom_range').hide();
      $('#display_date').show();
      var firstday = new Date(date.getFullYear(), 0, 1);
      var lastday = new Date(date.getFullYear(), 11, 31);
      var fm = firstday.getMonth()+1;
      if (fm < 10)
        fm = '0' + fm;
      var fd = firstday.getDate();
      if (fd < 10)
        fd = '0' + fd;
      start = firstday.getFullYear() + '-'  + fm + '-' + fd;
      var lm = lastday.getMonth()+1;
      if (lm < 10)
        lm = '0' + lm;
      var ld = lastday.getDate();
      if (ld < 10)
        ld = '0' + ld;
      end = lastday.getFullYear() + '-'  + lm + '-' + ld;
      html1 = fd + ' ' + months[firstday.getMonth()] + ' to ' + ld + ' ' + months[lastday.getMonth()] + ', ' + lastday.getFullYear();
      html2 = '(this year)';
      window.sessionStorage.setItem('html1', html1);
      window.sessionStorage.setItem('html2', html2);
      window.sessionStorage.setItem('start', start);
      window.sessionStorage.setItem('end', end);
      console.log('today:' + current_date + ', start of year:' + start + ', end of year:' + end);
      url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by;

      var client_id = $('option:selected', '#js-example-basic-single1').val();
      var currency_id = $('option:selected', '#js-example-basic-single2').val();

      if (client_id != 0 || currency_id != 0) {
        if (client_id != 0) {
          if (currency_id != 0) {
            url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&client_id=' + client_id + '&currency_id=' + currency_id;
            // console.log(url);
          } else {
            url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&client_id=' + client_id;
            // console.log(url);
          }
        } else {
          if (currency_id != 0) {
            url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&currency_id=' + currency_id;
            // console.log(url);
          }
        }
      }
      console.log(url);
      window.location.href = url;
    } else if (range == 'all-time') {
      $('#custom_range').hide();
      $('#display_date').hide();
      start = '';
      end = '';
      window.sessionStorage.setItem('start', start);
      window.sessionStorage.setItem('end', end);
      console.log('today:' + current_date + ', start date:' + start + ', end date:' + end);
      url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by;

      var client_id = $('option:selected', '#js-example-basic-single1').val();
      var currency_id = $('option:selected', '#js-example-basic-single2').val();

      if (client_id != 0 || currency_id != 0) {
        if (client_id != 0) {
          if (currency_id != 0) {
            url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&client_id=' + client_id + '&currency_id=' + currency_id;
            // console.log(url);
          } else {
            url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&client_id=' + client_id;
            // console.log(url);
          }
        } else {
          if (currency_id != 0) {
            url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&currency_id=' + currency_id;
            // console.log(url);
          }
        }
      }
      console.log(url);
      window.location.href = url;
    }
  })

  $('#start').change(function(){
    var status = $('option:selected', '#status').val();
    var by = $('option:selected', '#by').val();
    var range = $('option:selected', '#range').val();
    start = $('#start').val();
    end = $('#end').val();
    const date1 = new Date(start);
    const date2 = new Date(end);
    const diffTime = date2 - date1;
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
    console.log(diffDays);
    if (diffDays < 0) {
      toastr['error']('Please Select the Date correctly.','Error');
      return;
    }
    window.sessionStorage.setItem('start', start);
    window.sessionStorage.setItem('end', end);
    console.log('today:' + current_date + ', start date:' + start + ', end date:' + end);
    url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by;

    var client_id = $('option:selected', '#js-example-basic-single1').val();
    var currency_id = $('option:selected', '#js-example-basic-single2').val();

    if (client_id != 0 || currency_id != 0) {
      if (client_id != 0) {
        if (currency_id != 0) {
          url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&client_id=' + client_id + '&currency_id=' + currency_id;
          // console.log(url);
        } else {
          url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&client_id=' + client_id;
          // console.log(url);
        }
      } else {
        if (currency_id != 0) {
          url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&currency_id=' + currency_id;
          // console.log(url);
        }
      }
    }
    console.log(url);
    window.location.href = url;
  })

  $('#end').change(function(){
    var status = $('option:selected', '#status').val();
    var by = $('option:selected', '#by').val();
    var range = $('option:selected', '#range').val();
    start = $('#start').val();
    end = $('#end').val();
    const date1 = new Date(start);
    const date2 = new Date(end);
    const diffTime = date2 - date1;
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
    console.log(diffDays);
    if (diffDays < 0) {
      toastr['error']('Please Select the Date correctly.','Error');
      return;
    }
    window.sessionStorage.setItem('start', start);
    window.sessionStorage.setItem('end', end);
    console.log('today:' + current_date + ', start date:' + start + ', end date:' + end);
    url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by;

    var client_id = $('option:selected', '#js-example-basic-single1').val();
    var currency_id = $('option:selected', '#js-example-basic-single2').val();

    if (client_id != 0 || currency_id != 0) {
      if (client_id != 0) {
        if (currency_id != 0) {
          url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&client_id=' + client_id + '&currency_id=' + currency_id;
          // console.log(url);
        } else {
          url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&client_id=' + client_id;
          // console.log(url);
        }
      } else {
        if (currency_id != 0) {
          url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&currency_id=' + currency_id;
          // console.log(url);
        }
      }
    }
    console.log(url);
    window.location.href = url;
  })

  $('.more_filters').click(function(){
    var status = $('option:selected', '#status').val();
    var by = $('option:selected', '#by').val();
    var range = $('option:selected', '#range').val();
    url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by;

    var client_id = $('option:selected', '#js-example-basic-single1').val();
    var currency_id = $('option:selected', '#js-example-basic-single2').val();
    if (client_id != 0 || currency_id != 0) {
      if (client_id != 0) {
        if (currency_id != 0) {
          url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&client_id=' + client_id + '&currency_id=' + currency_id;
          // console.log(url);
        } else {
          url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&client_id=' + client_id;
          // console.log(url);
        }
      } else {
        if (currency_id != 0) {
          url = '{{config('app.url')}}' + '/quotes?start=' + start + '&end=' + end + '&status=' + status + '&range=' + range + '&by=' + by + '&currency_id=' + currency_id;
          // console.log(url);
        }
      }
    }
    console.log(url);
    window.location.href = url;
  });
</script>
@endpush