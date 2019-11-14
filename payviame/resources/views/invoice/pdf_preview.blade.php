<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('frontend/css/styleee.css')}}">
    <link rel="stylesheet" href="https://d3j9byh24fqslb.cloudfront.net/assets/redesign/vendor/nucleo/css/nucleo-06307e5fb5202d5657ede5f3566de1cb56dd9be9ddf9ee0586db7cf08d9a7277.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">
    <link href="{{asset('frontend/plugins/bootstrap-colorpicker/bootstrap-colorpicker.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('frontend/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: DejaVu Sans, sans-serif;
            /*font-family: cursive;*/
            font-weight: 100;
            margin: 0;
            color: #000 !important;
        }

        #invoice-page {
            box-shadow: 0 1px 4px rgba(0,0,0,0.18);
            background-color: #fff;
            position: relative;
            margin: 0;
            width: 100%;
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
            margin: 0 2% 0 0;
        }
        .details {
            padding: 0 10px 15px 10px;
            line-height: 2em;
        }
        .detailss {
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
            padding-left: 5px;
            padding-right: 5px;
            border: 1px solid #e3e3e3;
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
    </style>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{asset('frontend/js/jquery.printPage.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.btnprn').printPage();
        });
    </script>
</head>
<body>
    <div id="invoice-page">
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
            <div style="display: flex;">
                <div class="span-14">
                    <table class="to-from">
                        <tbody>
                            <tr>
                                <td style="width: 29%; vertical-align: top; padding-bottom: 0">
                                    <h3 class="invoice-from">From &nbsp;&nbsp;&nbsp;&nbsp; {{ $invoice->account->user->profile->business_name }}</h3>
                                     <div class="dark_grey">
                                        <hr>
                                        <p>{{ $invoice->account->user->profile->contact_name }}</p>
                                    </div>
                                </td>
                                <td style="width: 29%; vertical-align: top; padding-bottom: 0">
                                    <h3 class="invoice-to">To &nbsp;&nbsp;&nbsp;&nbsp; {{ $invoice->client->business_name }}</h3>
                                    <div class="dark_grey">
                                        <hr>
                                        <p>{{ $invoice->recipient_name }}</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top">
                                    <div class="dark_grey">
                                      <span>Reg. Nr. {{ $invoice->account->user->profile->company_number }}</span><br>
                                      <span>VAT Nr. {{ $invoice->account->user->profile->vat_number }}</span><br>
                                      <span>Address: {{ $invoice->account->user->profile->business_address }}</span>
                                    </div>
                                </td>
                                <td style="vertical-align: top">
                                    <div class="dark_grey">
                                      @if(!isset($invoice->recipient_address))
                                        <p>{{ $invoice->client->address_detail }}</p>
                                      @else
                                        <p>{{ $invoice->recipient_address }}</p>
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
                    <table class="to-from">
                        <tbody>
                            <tr>
                                <td style="width:40%;vertical-align: top; ">
                                    <h3 class="invoice-number" style="margin-top: -10">
                                        <div class="right formatted-number">
                                            {{ $invoice->id }}
                                        </div>
                                        Invoice
                                    </h3>
                                    <hr>
                                    <div class="dark_grey">
                                        <div class="span-12">
                                           <b>Date Issued:</b>
                                        </div>
                                        <div class="span-12 last t-right" style="margin-left: auto;">
                                            @php
                                            $date = date_create($invoice->date_issued);
                                            echo date_format($date, 'M d\, Y');
                                            @endphp
                                        </div>
                                    </div>
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top">
                                    <div class="dark_grey">
                                        <div class="span-12">
                                           <b>Payment due:</b>
                                        </div>
                                        <div class="span-12 last t-right" style="margin-left: auto;">
                                            @php
                                            $date1 = date_create($invoice->payment_due);
                                            echo date_format($date1, 'M d\, Y');
                                            @endphp
                                        </div>
                                    </div>
                                    <br><br>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:40%;vertical-align: top">
                                    <div class="amount_due clearfix" style="height:20px;padding-bottom:5px;padding-top:0px;margin-top:10px;">
                                        <div class="span-12">
                                            <b>
                                            Total:
                                            </b>
                                        </div>
                                        <div class="span-12 last t-right nowrap" style="margin-left: auto;">
                                            {{ $invoice->sum_total }}<span class="currency_code"> {{$invoice->currency->currency_code}}</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr class="space clear">
            <hr class="space clear">
            <hr class="space clear">
            <hr class="space clear">
            <table id="line_items">
                <thead>
                    <tr>
                        <th style="width: 40%">Description</th>
                        <th style="width: 10%">Qty</th>
                        <th style="width: 10%">Unit Price</th>
                        @if(count($taxes))
                            @if(count($taxes) == 2)
                            <th style="width: 10%">{{$taxes[0]->tax_description}}</th>
                            <th style="width: 10%">{{$taxes[1]->tax_description}}</th>
                            @else
                            <th style="width: 10%">{{$taxes[0]->tax_description}}</th>
                            <th style="width: 10%"> </th>
                            @endif
                        @else
                        <th style="width: 10%"> </th>
                        <th style="width: 10%"> </th>
                        @endif
                        <th style="width: 20%"><span class="right">Amount</span></th>
                    </tr>
                </thead>
                <tbody>
                @if($invoice_descriptions)
                    @foreach($invoice_descriptions as $key=>$value)
                    <tr class="line_item odd">
                      <td style="width: 40%">
                        <span>{{ $value->description }}</span>
                      </td>
                      <td style="width: 10%">{{ $value->quality }}</td>
                      <td style="width: 10%">
                      ${{ $value->unit_price }}
                      </td>
                      @if($value->tax1 == 1)
                      <td style="width: 10%"><img src="{{ asset('frontend/images/checkbox.png') }}" width="20" height="20"></td>
                      @else
                      <td style="width: 10%"></td>
                      @endif
                      @if($value->tax2 == 1)
                      <td style="width: 10%"><img src="{{ asset('frontend/images/checkbox.png') }}" width="20" height="20"></td>
                      @else
                      <td style="width: 10%"></td>
                      @endif
                      <td style="width: 20%"><span class="right">{{ $value->amount_price }} {{$invoice->currency->currency_code}}</span></td>
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
                      <td class="nowrap" id="invoice_subtotal" colspan="1">{{ $invoice->sub_total }}<span class="currency_code"> {{$invoice->currency->currency_code}}</span></td>
                    </tr>
                    @if(count($taxes))
                      @if(count($taxes) == 2)
                        <tr>
                          <td colspan="5">
                              <b class="right">{{ $taxes[0]->tax_description }} ({{$taxes[0]->tax_percentage}} %)</b>
                          </td>
                          <td class="nowrap" id="invoice_subtotal" colspan="1">{{$invoice->sum_tax1}}<span class="currency_code"> {{$invoice->currency->currency_code}}</span></td>
                        </tr>
                        <tr>
                          <td colspan="5">
                              <b class="right">{{ $taxes[1]->tax_description }} ({{$taxes[1]->tax_percentage}} %)</b>
                          </td>
                          <td class="nowrap" id="invoice_subtotal" colspan="1">{{$invoice->sum_tax2}}<span class="currency_code"> {{$invoice->currency->currency_code}}</span></td>
                        </tr>
                      @else
                        <tr>
                          <td colspan="5">
                              <b class="right">{{ $taxes[0]->tax_description }} ({{$taxes[0]->tax_percentage}} %)</b>
                          </td>
                          <td class="nowrap" id="invoice_subtotal" colspan="1">{{$invoice->sum_tax1}}<span class="currency_code"> {{$invoice->currency->currency_code}}</span></td>
                        </tr>
                        <tr>
                          <td colspan="5">
                              <b class="right"> (0 %)</b>
                          </td>
                          <td class="nowrap" id="invoice_subtotal" colspan="1">{{$invoice->sum_tax2}}<span class="currency_code"> {{$invoice->currency->currency_code}}</span></td>
                        </tr>
                      @endif
                    @else
                      <tr>
                        <td colspan="5">
                            <b class="right"> (0 %)</b>
                        </td>
                        <td class="nowrap" id="invoice_subtotal" colspan="1">{{$invoice->sum_tax1}}<span class="currency_code"> {{$invoice->currency->currency_code}}</span></td>
                      </tr>
                      <tr>
                        <td colspan="5">
                            <b class="right"> (0 %)</b>
                        </td>
                        <td class="nowrap" id="invoice_subtotal" colspan="1">{{$invoice->sum_tax2}}<span class="currency_code"> {{$invoice->currency->currency_code}}</span></td>
                      </tr>
                    @endif
                    <tr>
                      <td colspan="3">
                      &nbsp;
                      </td>
                      <td class="amount_due" colspan="2">
                        <b class="right">Total</b>
                      </td>
                      <td class="amount_due nowrap" id="invoice_total" colspan="1">{{ $invoice->sum_total }}<span class="currency_code"> {{$invoice->currency->currency_code}}</span></td>
                    </tr>
                </tbody>
            </table>
            <div class="dark_grey">
                <p></p>
            </div>
            <div class="last span-24">
                <hr class="clear space">
                @php
                $array = $array = explode("\n", $invoice->invoice_footer);
                foreach($array as $key => $value) {
                    echo '<span>' . $value .'</span><br>';
                }
                @endphp
            </div>  
        </div>
    </div>
</body>
</html>