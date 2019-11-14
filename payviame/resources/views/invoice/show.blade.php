@extends('layouts.dashboard')

@section('title', __('Invoices'))

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


  #ribbon-container_paid {
    position: absolute;
    top: 15px;
    right: -15px;
    overflow: visible; /* so we can see the pseudo-elements we're going to add to the anchor */
    font-size: 18px; /* font-size and line-height must be equal so we can account for the height of the banner */
    line-height: 18px;
  }
  
  #ribbon-container_paid:before {
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
  
  #ribbon-container_paid:after { /* This adds the second part of our dropshadow */
    content:"";
    height: 3px;
    background: rgba(0,0,0,.3);
    display: block;
    position: absolute;
    bottom: -3px;
    left: 58px;
    right:3px;
  }
  
  #ribbon-container_paid a {
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
  
  #ribbon-container_paid a:before { /* this creates the "forked" part of our ribbon */
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
  
  #ribbon-container_paid a:after { /* this creates the "folded" part of our ribbon */
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
  
  #ribbon-container_paid a:hover {
    background:#009ff1;
  }
  
  #ribbon-container_paid a:hover:before { /* this makes sure that the "forked" part of the ribbon changes color with the anchor on :hover */
    border-top: 29px solid #009ff1; 
    border-bottom: 29px solid #009ff1;
  }


  #ribbon-container_unpaid {
    position: absolute;
    top: 15px;
    right: -15px;
    overflow: visible; /* so we can see the pseudo-elements we're going to add to the anchor */
    font-size: 18px; /* font-size and line-height must be equal so we can account for the height of the banner */
    line-height: 18px;
  }
  
  #ribbon-container_unpaid:before {
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
  
  #ribbon-container_unpaid:after { /* This adds the second part of our dropshadow */
    content:"";
    height: 3px;
    background: rgba(0,0,0,.3);
    display: block;
    position: absolute;
    bottom: -3px;
    left: 58px;
    right:3px;
  }
  
  #ribbon-container_unpaid a {
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
  
  #ribbon-container_unpaid a:before { /* this creates the "forked" part of our ribbon */
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
  
  #ribbon-container_unpaid a:after { /* this creates the "folded" part of our ribbon */
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
  
  #ribbon-container_unpaid a:hover {
    background:#009ff1;
  }
  
  #ribbon-container_unpaid a:hover:before { /* this makes sure that the "forked" part of the ribbon changes color with the anchor on :hover */
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
            <a href="{{ route('invoice.index') }}">Inovice</a>
            <i class="fa fa-angle-right"></i>
            {{ $invoice->id }}
          </h1>
        </div>
      </div>
    </div>
    <div class="page-links">
      <div class="container">
        <div class="left-penal">
          <div id="new-in">
            <div id="">
              <a href="{{ route('invoice.print_preview', $invoice->id) }}" class="flip-in btn btnprn"><i class="fa fa-print"></i>&nbsp;&nbsp; Print </a>
              <a href="{{ route('invoice.download_pdf', $invoice->id) }}" class="flip-in btn"><i class="fa fa-download"></i>&nbsp;&nbsp; Get PDF </a>
              <a href="{{ route('invoice.duplicate_invoice', $invoice->id) }}" class="flip-in btn"><i class="fa fa-copy"></i>&nbsp;&nbsp; Duplicate </a>
              <a href="javascript:;" class="flip-in btn" onclick="(confirm('Are you sure? You want to delete it?')?document.getElementById('delete-form-{{$invoice->id}}').submit(): '');"><i class="fa fa-trash"></i>&nbsp;&nbsp; {{__('Delete')}} </a>
              <form id="delete-form-{{$invoice->id}}" action="{{ route('invoice.destroy',$invoice->id) }}" method="POST" style="display: none;">
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
                <a class="nav-link active" href="{{route('invoice.show', $invoice->id)}}">Manage Invoice</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('invoice.edit', $invoice->id)}}"><i class="fa fa-edit"></i> Edit Invoice</a>
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
            <div class="span-18" id="invoice_page_container">
              <div>
                <div id="invoice-page">
                  @if($invoice->status == 0)
                  <div id="ribbon-container_draft">
                    <a href="javascript:;" id="ribbon">Draft</a>
                  </div>
                  @elseif($invoice->status == 1)
                  <div id="ribbon-container_sent">
                    <a href="javascript:;" id="ribbon">Sent</a>
                  </div>
                  @elseif($invoice->status == 3)
                  <div id="ribbon-container_paid">
                    <a href="javascript:;" id="ribbon">Paid</a>
                  </div>
                  @else
                  <div id="ribbon-container_unpaid">
                    <a href="javascript:;" id="ribbon">Overdue</a>
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
                      @if(!isset($invoice->account->user->profile->company_logo))
                        <img src="{{ asset('frontend/images/finalpay1.png') }}" alt="Paydirt logo" height="80">
                      @else
                        <img src="{{ asset($invoice->account->user->profile->company_logo) }}" alt="Paydirt logo" height="80">
                      @endif
                    </div>
                    <hr class="space clear">
                    <div class="span-14">
                      <table class="to-from">
                        <tbody>
                          <tr>
                            <td style="width: 50%; vertical-align: top; padding-bottom: 0">
                              <h3 class="invoice-from">From &nbsp;&nbsp;&nbsp;&nbsp; {{ $invoice->account->user->profile->business_name }}</h3>
                            </td>
                            <td style="width: 50%; vertical-align: top; padding-bottom: 0">
                              <h3 class="invoice-to">To &nbsp;&nbsp;&nbsp;&nbsp; {{ $invoice->client->business_name }}</h3>
                            </td>
                          </tr>
                          <tr>
                            <td style="vertical-align: top">
                              <div class="dark_grey">
                                <hr>
                                <p>{{ $invoice->account->user->profile->contact_name }}</p>
                                <textarea class="street_address" name="account_address" rows="4" placeholder="Your address" disabled>Reg. Nr. {{ $invoice->account->user->profile->company_number }}&#013;VAT Nr. {{ $invoice->account->user->profile->vat_number }}&#013;Address: {{ $invoice->account->user->profile->business_address }}
                                </textarea>
                              </div>
                            </td>
                            <td style="vertical-align: top">
                              <div class="dark_grey">
                                <hr>
                                @if(!isset($invoice->recipient_name))
                                  <p>&nbsp;</p>
                                @else
                                  <p>{{ $invoice->recipient_name }}</p>
                                @endif
                                @if(!isset($invoice->recipient_address))
                                  <textarea class="street_address" name="recipient_address" rows="4" placeholder="Recipient's address" disabled>{{ $invoice->client->address_detail }}</textarea>
                                @else
                                  <textarea class="street_address" name="recipient_address" rows="4" placeholder="Recipient's address" disabled>{{ $invoice->recipient_address }}</textarea>
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
                          {{ $invoice->id }}
                        </div>
                        Invoice
                      </h3>
                      <hr>
                      <div class="details clearfix">
                        <div class="span-12">
                          <b>Date Issued:</b>
                        </div>
                        <div class="span-12 last t-right">
                          @php
                            $date = date_create($invoice->date_issued);
                            echo date_format($date, 'M d\, Y');
                          @endphp
                        </div>
                      </div>
                      <div class="details clearfix">
                        <div class="span-12">
                          <b>Payment due:</b>
                        </div>
                        <div class="span-12 last t-right">
                          @php
                            $date1 = date_create($invoice->payment_due);
                            echo date_format($date1, 'M d\, Y');
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
                          {{$invoice->currency->currency_symbol}} {{ $invoice->sum_total }}<span class="currency_code">{{$invoice->currency->currency_code}}</span>
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
                        @if($invoice_descriptions)
                        @foreach($invoice_descriptions as $key=>$value)
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
                          <td class="line_item_subtotal">{{$invoice->currency->currency_symbol}} {{ $value->amount_price }}</td>
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
                          <td class="line_item_subtotal">{{$invoice->currency->currency_symbol}} {{ $invoice->sub_total }}<span class="currency_code">{{$invoice->currency->currency_code}}</span></td>
                        </tr>
                        @if(count($taxes))
                          @if(count($taxes) == 2)
                            <tr>
                              <td colspan="5">
                                <b class="right">{{ $taxes[0]->tax_description }} ({{$taxes[0]->tax_percentage}} %)</b>
                              </td>
                              <td class="line_item_subtotal">{{$invoice->currency->currency_symbol}} {{$invoice->sum_tax1}}<span class="currency_code">{{$invoice->currency->currency_code}}</span></td>
                            </tr>
                            <tr>
                              <td colspan="5">
                                <b class="right">{{ $taxes[1]->tax_description }} ({{$taxes[1]->tax_percentage}} %)</b>
                              </td>
                              <td class="line_item_subtotal">{{$invoice->currency->currency_symbol}} {{$invoice->sum_tax2}}<span class="currency_code">{{$invoice->currency->currency_code}}</span></td>
                            </tr>
                          @else
                            <tr>
                              <td colspan="5">
                                <b class="right">{{ $taxes[0]->tax_description }} ({{$taxes[0]->tax_percentage}} %)</b>
                              </td>
                              <td class="line_item_subtotal">{{$invoice->currency->currency_symbol}} {{$invoice->sum_tax1}}<span class="currency_code">{{$invoice->currency->currency_code}}</span></td>
                            </tr>
                            <tr>
                              <td colspan="5">
                                <b class="right"> (0 %)</b>
                              </td>
                              <td class="line_item_subtotal">{{$invoice->currency->currency_symbol}} {{$invoice->sum_tax2}}<span class="currency_code">{{$invoice->currency->currency_code}}</span></td>
                            </tr>
                          @endif
                        @else
                          <tr>
                            <td colspan="5">
                              <b class="right"> (0 %)</b>
                            </td>
                            <td class="line_item_subtotal">{{$invoice->currency->currency_symbol}} {{$invoice->sum_tax1}}<span class="currency_code">{{$invoice->currency->currency_code}}</span></td>
                          </tr>
                          <tr>
                            <td colspan="5">
                              <b class="right"> (0 %)</b>
                            </td>
                            <td class="line_item_subtotal">{{$invoice->currency->currency_symbol}} {{$invoice->sum_tax2}}<span class="currency_code">{{$invoice->currency->currency_code}}</span></td>
                          </tr>
                        @endif
                        <tr>
                          <td colspan="3">&nbsp;</td>
                          <td class="amount_due" colspan="2">
                            <b class="right">Total</b>
                          </td>
                          <td class="amount_due nowrap" id="invoice_total">
                            {{$invoice->currency->currency_symbol}} {{ $invoice->sum_total }}<span class="currency_code">{{$invoice->currency->currency_code}}</span>
                          </td>
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
                      <textarea class="invoice_footer" name="footer" rows="2" placeholder="Terms and Conditions" style="height: 100px;" disabled>{{ $invoice->invoice_footer }}</textarea>
                    </div>  
                  </div>
                </div>
              </div>
            </div>
            <div class="last span-6">
              <div id="invoice-options">
                <div id="email_button">
                  @if($invoice->status == 0)
                  <a class="action massive" id="send_remind_links" href="javascript:;" data-toggle="modal" data-target="#sendInvoice" role="button">
                    <i class="fa fa-envelope"></i>
                    &nbsp;
                    Send Invoice
                    &nbsp;
                  </a>
                  <br>
                  <span class="alternative">
                    &nbsp;
                    or
                    &nbsp;
                    <a id="mark_invoice_as_sent" href="{{ route('invoice.status.update', [$invoice->id, 1]) }}">
                        Mark it as Sent
                    </a>
                  </span>
                  @elseif($invoice->status == 1)
                  <a class="action massive" id="send_remind_links" href="javascript:;" data-toggle="modal" data-target="#sendInvoice" role="button">
                    <i class="fa fa-envelope"></i>
                    &nbsp;
                    Re-Send Invoice
                    &nbsp;
                  </a>
                  <br>
                  <span class="alternative">
                    &nbsp;
                    or
                    &nbsp;
                    <a id="mark_invoice_as_sent" href="{{ route('invoice.status.update', [$invoice->id, 0]) }}">
                        Convert Invoice to draft
                    </a>
                  </span>
                  @endif
                </div>
                <hr class="double">
                @if($invoice->status != 0)
                <div class="card">
                  <div class="card-header">
                    Payments
                    <div style="float: right">
                      <button class="btn btn-success add_payment_btn" id="flip" <?php echo ($invoice->status == '3') ? 'disabled' : '' ?>> Add a payment </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="form-group row">
                      <label for="paid_value" class="col-sm-4 col-form-label" style="margin-top: 10px;">Paid</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="paid_value" name="paid_value" placeholder="Paid" value="{{$paid}}" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="owing_value" class="col-sm-4 col-form-label" style="margin-top: 10px;">Owing</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="owing_value" name="owing_value" placeholder="Owing" value="<?php echo ($invoice->status == '3') ? '0' : $owing ?>" disabled>
                      </div>
                    </div>
                    <div id="panel">
                      <hr>
                      <form method="POST" action="{{ route('invoice.record.save') }}">
                        @csrf
                        <div class="form-group row">
                          <label for="pay_value" class="col-sm-4 col-form-label" style="margin-top: 10px;">Pay value</label>
                          <div class="col-sm-8">
                            <input type="text" name="invoice_id" value="{{$invoice->id}}" hidden>
                            <input type="number" class="form-control" id="pay_value" name="pay_value" placeholder="Pay input" value="0" min="0">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="pay_date" class="col-sm-4 col-form-label" >Pay Date</label>
                          <div class="col-sm-8">
                            <input type="date"  name="pay_date" class="datepic-im" id="pay_date" style="border: 0;" value="{{ date('Y-m-d') }}">
                          </div>
                        </div>
                        <div class="form-group ">
                          <textarea id="pay_description" name="pay_description" rows="1" placeholder="Optional Payment Description"></textarea>
                        </div>
                        <div class="form-group">
                          <button type="submit">Record Payment</button>
                          &nbsp;&nbsp;&nbsp;or&nbsp;&nbsp;&nbsp;
                          <a href="javascript:;" class="cancel_record">Cancel</a>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                @endif
              </div>
              <div class="modal fade" id="sendInvoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <form method="POST" action="{{ route('invoice.send', $invoice->id) }}" enctype="multipart/form-data">
                      @csrf
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Send Invoice {{ $invoice->id }} to {{ $invoice->client->business_name }}</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        
                        <div class="form-group row">
                          <label for="toClient" class="col-sm-2 col-form-label" style="margin-top: 10px;">To</label>
                          <div class="col-sm-10">
                            <input type="email" class="form-control" id="toClient" name="toClient" placeholder="Email" value="{{ $invoice->client->email_address }}" required>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="subject" class="col-sm-2 col-form-label" style="margin-top: 10px;">Subject</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Email Title" value="New invoice {{ $invoice->id }} to {{ $invoice->account->user->profile->business_name }}" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <textarea class="" id="mailContent" name="mailContent" rows="6" placeholder="Mail Content" >Hello @if(!isset($invoice->recipient_name)){{ $invoice->client->contact_name }}@else{{ $invoice->recipient_name }}@endif&#013;&#013;Please find attached invoice {{ $invoice->id }}.&#013;&#013;Regards,&#013;{{ $invoice->account->user->profile->business_name }}</textarea>
                        </div>

                        <div class="form-group">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="attachPDF" name="attachPDF" checked>
                            <label class="form-check-label" for="attachPDF">
                              Attach invoice as a PDF
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <a href="javascript:;" data-dismiss="modal">Cancel</a>&nbsp;&nbsp;&nbsp;or&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-primary action" id="sendEmail" type="submit"> Send email and mark invoice as sent </button>
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
          <!-- Edit invoice page Content-->
    </div>
  </div>
  <div class="clear"></div>
</div>

<div class="clear"></div>

@endsection

@push('scripts')
<script src="{{asset('frontend/js/jquery.printPage.js')}}" type="text/javascript"></script>
<script> 

  var height = $("#side").height();

  $(window).scroll(function(){
    $("#side").css("top",Math.max(15,276-$(this).scrollTop()));
                      
     if( ($("#side").offset().top+height) >= $('footer').offset().top ){
        $("#side").hide();       
     } 
     
     if( ($(this).scrollTop()+height) < ($('footer').offset().top) ){
        $("#side").show();       
     }
     
  });

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
      url: '{{ url('/invoices/generate-pdf') }}',
      data: {id: '<?php echo $invoice->id?>'},
      success:function(data){
        console.log(data.success);
      }
    });
  });

  $('#selectStatus').change(function(){
    if ($('option:selected', this).val() == 0) {
      window.location.href = '{{url('/invoices/'.$invoice->id.'/status/0')}}';
    } else if ($('option:selected', this).val() == 1) {
      window.location.href = '{{url('/invoices/'.$invoice->id.'/status/1')}}';
    } else if ($('option:selected', this).val() == 2) {
      window.location.href = '{{url('/invoices/'.$invoice->id.'/status/2')}}';
    } else {
      window.location.href = '{{url('/invoices/'.$invoice->id.'/status/3')}}';
    }
  })
</script>

<script>
  $(document).ready(function() {

    $("#flip").click(function(){
      $("#panel").slideToggle("slow");
    });

    $(".cancel_record").click(function(){
      $("#panel").slideToggle("slow");
    });
  });
</script>
@endpush