@extends('layouts.dashboard')

@section('title', __('Quote'))

@push('stylesheets')
  <style type="text/css">
    #invoice-page {
      box-shadow: 0 1px 4px rgba(0,0,0,0.18);
      background-color: #fff;
      position: relative;
      margin: 0;
      width: 853px;
      min-height: 1000px;  
    }
    .span-14 {
      min-height: 1px;
      float: left;
      width: 57.5%;
      margin: 0 2% 0 0;
    }
    table {
      margin-bottom: 1.4em;
      width: 100%;
    }
    #invoice-page table.to-from td {
        padding: 0 10px 0 0;
    }
    .span-1 {
      min-height: 1px;
      float: left;
      width: 2.25%;
      margin: 0 2% 0 0;
    }
    .span-9 {
        min-height: 1px;
        float: left;
        width: 36.25%;
        margin: 0 2% 0 0;
    }
    .details {
        padding: 0 10px 15px 10px;
        line-height: 2em;
    }
    .span-12 {
        min-height: 1px;
        float: left;
        width: 49%;
        margin: 0 2% 0 0;
    }
    .t-right {
        text-align: right !important;
    }
    .amount_due {
        background-color: #f6f6f6;
        border: 1px solid #e3e3e3;
        border-left: 0;
        border-right: 0;
        padding: 5px 10px;
        margin-top: 5px;
        font-weight: bold;
        font-size: 1.2em;
    }
    #invoice-page .formatted-number {
        padding: 5px;
        border: 1px solid #e3e3e3;
        margin-top: -6px;
        font-weight: bold;
        background-color: #F6F6F6;
        border-radius: 4px;
        vertical-align: baseline;
    }
    .right {
        float: right !important;
    }
    table#line_items td.rule {
        padding: 0;
        border-top: 1px solid #e3e3e3;
    }
    #middle {
        padding: 30px 50px;
        background: transparent;
    }

      
    #ribbon-container_draft {
      position: absolute;
      top: 15px;
      right: -15px;
      overflow: visible; /* so we can see the pseudo-elements we're going to add to the anchor */
      font-size: 18px; /* font-size and line-height must be equal so we can account for the height of the banner */
      line-height: 18px;
    }
    
    #ribbon-container_draft:before {
      content:"";
      height: 0;
      width: 0;
      display: block;
      position: absolute;
      top: 3px;
      left: 0;
      border-top: 29px solid rgba(0,0,0,.3); /* These 4 border properties create the first part of our drop-shadow */
      border-bottom: 29px solid rgba(0,0,0,.3); 
      border-right: 29px solid rgba(0,0,0,.3);
      border-left: 29px solid transparent;
    }
    
    #ribbon-container_draft:after { /* This adds the second part of our dropshadow */
      content:"";
      height: 3px;
      background: rgba(0,0,0,.3);
      display: block;
      position: absolute;
      bottom: -3px;
      left: 58px;
      right:3px;
    }
    
    #ribbon-container_draft a {
      display:block;
      padding:20px;
      position:relative; /* allows us to position our pseudo-elements properly */
      background:#dfa404;
      overflow:visible;
      height:58px;
      margin-left:29px;
      color:#fff;
      text-decoration:none;
    }
    
    #ribbon-container_draft a:before { /* this creates the "forked" part of our ribbon */
      content:"";
      height: 0;
      width: 0;
      display:block;
      position:absolute;
      top:0;
      left:-29px;
      border-top: 29px solid #dfa404; 
      border-bottom: 29px solid #dfa404; 
      border-right: 29px solid transparent;
      border-left: 29px solid transparent;
    }
    
    #ribbon-container_draft a:after { /* this creates the "folded" part of our ribbon */
      content:""; 
      height: 0;
      width: 0;
      display:block;
      position:absolute;
      bottom:-15px;
      right:0;
      border-top: 15px solid #004a70; 
      border-right: 15px solid transparent;
    }
    
    #ribbon-container_draft a:hover {
      background:#009ff1;
    }
    
    #ribbon-container_draft a:hover:before { /* this makes sure that the "forked" part of the ribbon changes color with the anchor on :hover */
      border-top: 29px solid #009ff1; 
      border-bottom: 29px solid #009ff1;
    }


    #ribbon-container_sent {
      position: absolute;
      top: 15px;
      right: -15px;
      overflow: visible; /* so we can see the pseudo-elements we're going to add to the anchor */
      font-size: 18px; /* font-size and line-height must be equal so we can account for the height of the banner */
      line-height: 18px;
    }
    
    #ribbon-container_sent:before {
      content:"";
      height: 0;
      width: 0;
      display: block;
      position: absolute;
      top: 3px;
      left: 0;
      border-top: 29px solid rgba(0,0,0,.3); /* These 4 border properties create the first part of our drop-shadow */
      border-bottom: 29px solid rgba(0,0,0,.3); 
      border-right: 29px solid rgba(0,0,0,.3);
      border-left: 29px solid transparent;
    }
    
    #ribbon-container_sent:after { /* This adds the second part of our dropshadow */
      content:"";
      height: 3px;
      background: rgba(0,0,0,.3);
      display: block;
      position: absolute;
      bottom: -3px;
      left: 58px;
      right:3px;
    }
    
    #ribbon-container_sent a {
      display:block;
      padding:20px;
      position:relative; /* allows us to position our pseudo-elements properly */
      background:#6c757d;
      overflow:visible;
      height:58px;
      margin-left:29px;
      color:#fff;
      text-decoration:none;
    }
    
    #ribbon-container_sent a:before { /* this creates the "forked" part of our ribbon */
      content:"";
      height: 0;
      width: 0;
      display:block;
      position:absolute;
      top:0;
      left:-29px;
      border-top: 29px solid #6c757d; 
      border-bottom: 29px solid #6c757d; 
      border-right: 29px solid transparent;
      border-left: 29px solid transparent;
    }
    
    #ribbon-container_sent a:after { /* this creates the "folded" part of our ribbon */
      content:""; 
      height: 0;
      width: 0;
      display:block;
      position:absolute;
      bottom:-15px;
      right:0;
      border-top: 15px solid #004a70; 
      border-right: 15px solid transparent;
    }
    
    #ribbon-container_sent a:hover {
      background:#009ff1;
    }
    
    #ribbon-container_sent a:hover:before { /* this makes sure that the "forked" part of the ribbon changes color with the anchor on :hover */
      border-top: 29px solid #009ff1; 
      border-bottom: 29px solid #009ff1;
    }


    #ribbon-container_accepted {
      position: absolute;
      top: 15px;
      right: -15px;
      overflow: visible; /* so we can see the pseudo-elements we're going to add to the anchor */
      font-size: 18px; /* font-size and line-height must be equal so we can account for the height of the banner */
      line-height: 18px;
    }
    
    #ribbon-container_accepted:before {
      content:"";
      height: 0;
      width: 0;
      display: block;
      position: absolute;
      top: 3px;
      left: 0;
      border-top: 29px solid rgba(0,0,0,.3); /* These 4 border properties create the first part of our drop-shadow */
      border-bottom: 29px solid rgba(0,0,0,.3); 
      border-right: 29px solid rgba(0,0,0,.3);
      border-left: 29px solid transparent;
    }
    
    #ribbon-container_accepted:after { /* This adds the second part of our dropshadow */
      content:"";
      height: 3px;
      background: rgba(0,0,0,.3);
      display: block;
      position: absolute;
      bottom: -3px;
      left: 58px;
      right:3px;
    }
    
    #ribbon-container_accepted a {
      display:block;
      padding:20px;
      position:relative; /* allows us to position our pseudo-elements properly */
      background:#6f42c1;
      overflow:visible;
      height:58px;
      margin-left:29px;
      color:#fff;
      text-decoration:none;
    }
    
    #ribbon-container_accepted a:before { /* this creates the "forked" part of our ribbon */
      content:"";
      height: 0;
      width: 0;
      display:block;
      position:absolute;
      top:0;
      left:-29px;
      border-top: 29px solid #6f42c1; 
      border-bottom: 29px solid #6f42c1; 
      border-right: 29px solid transparent;
      border-left: 29px solid transparent;
    }
    
    #ribbon-container_accepted a:after { /* this creates the "folded" part of our ribbon */
      content:""; 
      height: 0;
      width: 0;
      display:block;
      position:absolute;
      bottom:-15px;
      right:0;
      border-top: 15px solid #004a70; 
      border-right: 15px solid transparent;
    }
    
    #ribbon-container_accepted a:hover {
      background:#009ff1;
    }
    
    #ribbon-container_accepted a:hover:before { /* this makes sure that the "forked" part of the ribbon changes color with the anchor on :hover */
      border-top: 29px solid #009ff1; 
      border-bottom: 29px solid #009ff1;
    }


    #ribbon-container_declined {
      position: absolute;
      top: 15px;
      right: -15px;
      overflow: visible; /* so we can see the pseudo-elements we're going to add to the anchor */
      font-size: 18px; /* font-size and line-height must be equal so we can account for the height of the banner */
      line-height: 18px;
    }
    
    #ribbon-container_declined:before {
      content:"";
      height: 0;
      width: 0;
      display: block;
      position: absolute;
      top: 3px;
      left: 0;
      border-top: 29px solid rgba(0,0,0,.3); /* These 4 border properties create the first part of our drop-shadow */
      border-bottom: 29px solid rgba(0,0,0,.3); 
      border-right: 29px solid rgba(0,0,0,.3);
      border-left: 29px solid transparent;
    }
    
    #ribbon-container_declined:after { /* This adds the second part of our dropshadow */
      content:"";
      height: 3px;
      background: rgba(0,0,0,.3);
      display: block;
      position: absolute;
      bottom: -3px;
      left: 58px;
      right:3px;
    }
    
    #ribbon-container_declined a {
      display:block;
      padding:20px;
      position:relative; /* allows us to position our pseudo-elements properly */
      background:#dc3545;
      overflow:visible;
      height:58px;
      margin-left:29px;
      color:#fff;
      text-decoration:none;
    }
    
    #ribbon-container_declined a:before { /* this creates the "forked" part of our ribbon */
      content:"";
      height: 0;
      width: 0;
      display:block;
      position:absolute;
      top:0;
      left:-29px;
      border-top: 29px solid #dc3545; 
      border-bottom: 29px solid #dc3545; 
      border-right: 29px solid transparent;
      border-left: 29px solid transparent;
    }
    
    #ribbon-container_declined a:after { /* this creates the "folded" part of our ribbon */
      content:""; 
      height: 0;
      width: 0;
      display:block;
      position:absolute;
      bottom:-15px;
      right:0;
      border-top: 15px solid #004a70; 
      border-right: 15px solid transparent;
    }
    
    #ribbon-container_declined a:hover {
      background:#009ff1;
    }
    
    #ribbon-container_declined a:hover:before { /* this makes sure that the "forked" part of the ribbon changes color with the anchor on :hover */
      border-top: 29px solid #009ff1; 
      border-bottom: 29px solid #009ff1;
    }
  </style>
@endpush

@section('content')

<div id="main">
  <div>
    <div id="page-head">
      <div class="page-title" style="padding-bottom: 68px;">
        <div class="container">
          <h1>
            <a href="{{ route('quote.index') }}">Quotes</a>
            <i class="fa fa-angle-right"></i>
            {{ $quote->id }}
          </h1>
        </div>
      </div>
    </div>
    <div class="page-links">
      <div class="container">
        <div class="left-penal">
          <div id="new-in">
            <div id="flip">
              <a href="{{ route('quote.print_preview', $quote->id) }}" class="flip-in btn btnprn"><i class="fa fa-print"></i>&nbsp;&nbsp; Print </a>
              <a href="{{ route('quote.download_pdf', $quote->id) }}" class="flip-in btn"><i class="fa fa-download"></i>&nbsp;&nbsp; Get PDF </a>
              <a href="{{ route('quote.duplicate_quote', $quote->id) }}" class="flip-in btn"><i class="fa fa-copy"></i>&nbsp;&nbsp; Duplicate </a>
              <a href="javascript:;" class="flip-in btn" onclick="(confirm('Are you sure? You want to delete it?')?document.getElementById('delete-form-{{$quote->id}}').submit(): '');"><i class="fa fa-trash"></i>&nbsp;&nbsp; {{__('Delete')}} </a>
              <form id="delete-form-{{$quote->id}}" action="{{ route('quote.destroy',$quote->id) }}" method="POST" style="display: none;">
                  @csrf
                  @method('DELETE')
              </form>
            </div>
            <div class="clear"></div>
          </div>
        </div>
        <div class="right-penal">   
          <div style="position: relative;top: -32px;"> 
            <ul class="nav nav-tabs page-tab">
              <li class="nav-item">
                <a class="nav-link active" href="{{route('quote.show', $quote->id)}}">Manage Quotes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('quote.edit', $quote->id)}}"><i class="fa fa-edit"></i> Edit Quotes</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="clear"></div>   
    <!-- Tab panes -->
    <div class="tab-content">
    
      <!--Task Content-->
      <div id="home" class="tab-pane active">
        <div id="middle">
          <div class="container">
            <div class="span-18" id="quote_page_container">
              <div>
                <div id="invoice-page">
                  @if($quote->status == 0)
                  <div id="ribbon-container_draft">
                    <a href="javascript:;" id="ribbon">Draft</a>
                  </div>
                  @elseif($quote->status == 1)
                  <div id="ribbon-container_sent">
                    <a href="javascript:;" id="ribbon">Sent</a>
                  </div>
                  @elseif($quote->status == 2)
                  <div id="ribbon-container_accepted">
                    <a href="javascript:;" id="ribbon">Accepted</a>
                  </div>
                  @else
                  <div id="ribbon-container_declined">
                    <a href="javascript:;" id="ribbon">Declined</a>
                  </div>
                  @endif
                  <div class="overlays">
                    <div class="current draft">
                        &nbsp;
                    </div>
                    <div class="sent">
                        &nbsp;
                    </div>
                    <div class="accepted">
                        &nbsp;
                    </div>
                    <div class="declined">
                        &nbsp;
                    </div>
                  </div>
                  <div id="invoice_contents">
                    <div class="logo_bar">
                      @if(!isset($quote->account->user->profile->company_logo))
                      <img src="{{ asset('frontend/images/finalpay1.png') }}" alt="Paydirt logo" height="80">
                      @else
                      <img src="{{ asset($quote->account->user->profile->company_logo) }}" alt="Paydirt logo" height="80">
                      @endif
                    </div>
                    <hr class="space clear">
                    <div class="span-14">
                      <table class="to-from">
                        <tbody>
                          <tr>
                            <td style="width: 50%; vertical-align: top; padding-bottom: 0">
                              <h3 class="invoice-from">From &nbsp;&nbsp;&nbsp;&nbsp; {{ $quote->account->user->profile->business_name }}</h3>
                            </td>
                            <td style="width: 50%; vertical-align: top; padding-bottom: 0">
                              <h3 class="invoice-to">To &nbsp;&nbsp;&nbsp;&nbsp; {{ $quote->client->business_name }}</h3>
                            </td>
                          </tr>
                          <tr>
                            <td style="vertical-align: top">
                              <div class="dark_grey">
                                <hr>
                                <p>{{ $quote->account->user->profile->contact_name }}</p>
                                <textarea class="street_address" name="account_address" rows="4" placeholder="Your address" disabled>Reg. Nr. {{ $quote->account->user->profile->company_number }}&#013;VAT Nr. {{ $quote->account->user->profile->vat_number }}&#013;Address: {{ $quote->account->user->profile->business_address }}</textarea>
                              </div>
                            </td>
                            <td style="vertical-align: top">
                              <div class="dark_grey">
                                <hr>
                                @if(!isset($quote->recipient_name))
                                  <p>&nbsp;</p>
                                @else
                                  <p>{{ $quote->recipient_name }}</p>
                                @endif
                                @if(!isset($quote->recipient_address))
                                  <textarea class="street_address" name="recipient_address" rows="4" placeholder="Recipient's address" disabled>{{ $quote->client->address_detail }}</textarea>
                                @else
                                  <textarea class="street_address" name="recipient_address" rows="4" placeholder="Recipient's address" disabled>{{ $quote->recipient_address }}</textarea>
                                @endif
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="span-1">
                      &nbsp;
                    </div>
                    <div class="span-9 last">
                      <h3 class="invoice-number">
                        <div class="right formatted-number">
                          {{ $quote->id }}
                        </div>
                        Quote
                      </h3>
                      <hr>
                      <div class="details clearfix">
                        <div class="span-12">
                          <b>Date Issued:</b>
                        </div>
                        <div class="span-12 last t-right">
                          @php
                          $date = date_create($quote->date_issued);
                          echo date_format($date, 'M d\, Y');
                          @endphp
                        </div>
                      </div>
                      <div class="amount_due clearfix">
                        <div class="span-12">
                          <b>
                            Total:
                          </b>
                        </div>
                        <div class="span-12 last t-right nowrap">
                          {{$quote->currency->currency_symbol}} {{ $quote->sum_total }}<span class="currency_code">{{$quote->currency->currency_code}}</span>
                        </div>
                      </div>
                    </div>
                    <hr class="space clear">
                    <hr class="space clear">
                    <hr class="space clear">
                    <hr class="space clear">
                    <table id="line_items">
                      <thead>
                        <tr>
                          <th class="description">Description</th>
                          <th>Qty</th>
                          <th class="unit-price">Unit Price</th>
                          @if(count($taxes))
                            @if(count($taxes) == 2)
                            <th class="unit-price">{{$taxes[0]->tax_description}}</th>
                            <th class="unit-price">{{$taxes[1]->tax_description}}</th>
                            @else
                            <th class="unit-price">{{$taxes[0]->tax_description}}</th>
                            <th class="unit-price"> </th>
                            @endif
                          @else
                          <th class="unit-price"> </th>
                          <th class="unit-price"> </th>
                          @endif
                          <th class="line_item_subtotal">Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if($quote_descriptions)
                        @foreach($quote_descriptions as $key=>$value)
                        <tr class="line_item odd">
                          <td class="description">
                          <p>{{ $value->description }}</p>
                          </td>
                          <td>{{ $value->quality }}</td>
                          <td class="unit-price">
                          ${{ $value->unit_price }}
                          </td>
                          @if($value->tax1 == 1)
                          <td class="unit-price"><input type="checkbox" name="tax1" checked disabled></td>
                          @else
                          <td class="unit-price"></td>
                          @endif
                          @if($value->tax2 == 1)
                          <td class="unit-price"><input type="checkbox" name="tax2" checked disabled></td>
                          @else
                          <td class="unit-price"></td>
                          @endif
                          <td class="line_item_subtotal">{{ $quote->currency->currency_symbol }} {{ $value->amount_price }}</td>
                        </tr>
                        @endforeach
                        @endif
                        <tr>
                          <td class="rule" colspan="6">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="5">
                              <b class="right">Subtotal</b>
                          </td>
                          <td class="line_item_subtotal">{{ $quote->currency->currency_symbol }} {{ $quote->sub_total }}<span class="currency_code">{{ $quote->currency->currency_code }} </span></td>
                        </tr>
                        @if(count($taxes))
                          @if(count($taxes) == 2)
                            <tr>
                              <td colspan="5">
                                  <b class="right">{{ $taxes[0]->tax_description }} ({{$taxes[0]->tax_percentage}} %)</b>
                              </td>
                              <td class="line_item_subtotal">{{ $quote->currency->currency_symbol }} {{$quote->sum_tax1}}<span class="currency_code">{{ $quote->currency->currency_code }} </span></td>
                            </tr>
                            <tr>
                              <td colspan="5">
                                  <b class="right">{{ $taxes[1]->tax_description }} ({{$taxes[1]->tax_percentage}} %)</b>
                              </td>
                              <td class="line_item_subtotal">{{ $quote->currency->currency_symbol }} {{$quote->sum_tax2}}<span class="currency_code">{{ $quote->currency->currency_code }} </span></td>
                            </tr>
                          @else
                            <tr>
                              <td colspan="5">
                                  <b class="right">{{ $taxes[0]->tax_description }} ({{$taxes[0]->tax_percentage}} %)</b>
                              </td>
                              <td class="line_item_subtotal">{{ $quote->currency->currency_symbol }} {{$quote->sum_tax1}}<span class="currency_code">{{ $quote->currency->currency_code }} </span></td>
                            </tr>
                            <tr>
                              <td colspan="5">
                                  <b class="right"> (0 %)</b>
                              </td>
                              <td class="line_item_subtotal">{{ $quote->currency->currency_symbol }} {{$quote->sum_tax2}}<span class="currency_code">{{ $quote->currency->currency_code }} </span></td>
                            </tr>
                          @endif
                        @else
                          <tr>
                            <td colspan="5">
                                <b class="right"> (0 %)</b>
                            </td>
                            <td class="line_item_subtotal">{{ $quote->currency->currency_symbol }} {{$quote->sum_tax1}}<span class="currency_code">{{ $quote->currency->currency_code }} </span></td>
                          </tr>
                          <tr>
                            <td colspan="5">
                                <b class="right"> (0 %)</b>
                            </td>
                            <td class="line_item_subtotal">{{ $quote->currency->currency_symbol }} {{$quote->sum_tax2}}<span class="currency_code">{{ $quote->currency->currency_code }} </span></td>
                          </tr>
                        @endif
                        <tr>
                          <td colspan="3">
                          &nbsp;
                          </td>
                          <td class="amount_due" colspan="2">
                            <b class="right">Total</b>
                          </td>
                          <td class="amount_due nowrap" id="invoice_total">{{ $quote->currency->currency_symbol }} {{ $quote->sum_total }}<span class="currency_code">{{ $quote->currency->currency_code }} </span></td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="dark_grey">
                      <p></p>
                    </div>
                    <div class="last span-24">
                      <hr class="clear space">
                      <hr class="clear space">
                      <hr class="clear space">
                      <textarea class="invoice_footer" name="footer" rows="2" placeholder="Terms and Conditions" style="height: 100px;" disabled>{{ $quote->quote_footer }}</textarea>
                    </div>  
                  </div>
                </div>
              </div>
            </div>
            <div class="last span-6">
              <div id="invoice-options">
                <div id="email_button">
                  @if($quote->status == 0)
                  <a class="action massive" id="send_remind_links" href="javascript:;" data-toggle="modal" data-target="#sendQuote" role="button">
                    <i class="fa fa-envelope"></i>
                    &nbsp;
                    Send Quote
                    &nbsp;
                  </a>
                  <br>
                  <span class="alternative">
                    &nbsp;
                    or
                    &nbsp;
                    <a id="mark_quote_as_sent" href="{{ route('quote.status.update', [$quote->id, 1]) }}">
                        Mark it as Sent
                    </a>
                  </span>
                  @elseif($quote->status == 1)
                  <a class="action massive" id="send_remind_links" href="javascript:;" data-toggle="modal" data-target="#sendQuote" role="button">
                    <i class="fa fa-envelope"></i>
                    &nbsp;
                    Re-Send Quote
                    &nbsp;
                  </a>
                  @endif
                  <hr class="space">
                  <hr class="double">
                  <a class="action massive" href="{{ route('invoice.create', [$quote->client->id,$quote->id]) }}" data-onclick="convertQuoteToInvoice">
                    <i class="fa fa-file"></i>
                    &nbsp;
                    Create Invoice
                    &nbsp;
                  </a>
                  <hr class="space">
                  <div class="form-group row">
                    <label for="selectStatus" class="col-sm-6  col-form-label" style="margin-top: 10px; font-size: 15px">Quote Status</label>
                    <div class="col-sm-6">
                      <select  class="form-control" id="selectStatus"  required>
                        <option value="0" <?php echo ($quote->status == '0') ? 'selected' : '' ?>>Draft</option>
                        <option value="1" <?php echo ($quote->status == '1') ? 'selected' : '' ?>>Sent</option>
                        <option value="2" <?php echo ($quote->status == '2') ? 'selected' : '' ?>>Accepted</option>
                        <option value="3" <?php echo ($quote->status == '3') ? 'selected' : '' ?>>Declined</option>
                      </select>
                    </div>
                  </div>
                </div>
                <hr class="double">
              </div>
              <div class="modal fade" id="sendQuote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <form method="POST" action="{{ route('quote.send', $quote->id) }}" enctype="multipart/form-data">
                      @csrf
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Send quote {{ $quote->id }} to {{ $quote->client->business_name }}</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        
                        <div class="form-group row">
                          <label for="toClient" class="col-sm-2 col-form-label" style="margin-top: 10px;">To</label>
                          <div class="col-sm-10">
                            <input type="email" class="form-control" id="toClient" name="toClient" placeholder="Email" value="{{ $quote->client->email_address }}" required>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="subject" class="col-sm-2 col-form-label" style="margin-top: 10px;">Subject</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Email Title" value="New quote {{ $quote->id }} to {{ $quote->account->user->profile->business_name }}" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <textarea class="" id="mailContent" name="mailContent" rows="6" placeholder="Mail Content" >Hello @if(!isset($quote->recipient_name)){{ $quote->client->contact_name }}@else{{ $quote->recipient_name }}@endif&#013;&#013;Please find attached quote {{ $quote->id }}.&#013;&#013;Regards,&#013;{{ $quote->account->user->profile->business_name }}</textarea>
                        </div>

                        <div class="form-group">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="attachPDF" name="attachPDF" checked>
                            <label class="form-check-label" for="attachPDF">
                              Attach quote as a PDF
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <a href="javascript:;" data-dismiss="modal">Cancel</a>&nbsp;&nbsp;&nbsp;or&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-primary action" id="sendEmail" type="submit"> Send email and mark quote as sent </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--edit client-->
        <!-- Edit Quote page Content-->
    </div>
  </div>
  <div class="clear"></div>
</div>

<div class="clear"></div>

@endsection

@push('scripts')
<script src="{{asset('frontend/js/jquery.printPage.js')}}" type="text/javascript"></script>
<script>

  // var height = $("#side").height();

  // $(window).scroll(function(){
  //   $("#side").css("top",Math.max(15,227-$(this).scrollTop()));
                      
  //   if( ($("#side").offset().top+height) >= $('footer').offset().top ){
  //       $("#side").hide();       
  //   } 
     
  //   if( ($(this).scrollTop()+height) < ($('footer').offset().top) ){
  //       $("#side").show();       
  //   }
     
  // });

  $(document).ready(function(){
    $('.btnprn').printPage();
  });

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $(document).ready(function(){
    $.ajax({
      type: 'POST',
      url: '{{ url('/quotes/generate-pdf') }}',
      data: {id: '<?php echo $quote->id?>'},
      success:function(data){
        console.log(data.success);
      }
    });
  });

  $('#selectStatus').change(function(){
    if ($('option:selected', this).val() == 0) {
      window.location.href = '{{url('/quotes/'.$quote->id.'/status/0')}}';
    } else if ($('option:selected', this).val() == 1) {
      window.location.href = '{{url('/quotes/'.$quote->id.'/status/1')}}';
    } else if ($('option:selected', this).val() == 2) {
      window.location.href = '{{url('/quotes/'.$quote->id.'/status/2')}}';
    } else {
      window.location.href = '{{url('/quotes/'.$quote->id.'/status/3')}}';
    }
  })
</script> 
@endpush