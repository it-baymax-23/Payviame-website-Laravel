<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        body {
            background-color: #fff;
            font-family: 'DejaVu Sans';
            color: #000 ;
        }
        .formatted-number {
            border: 1px solid #e3e3e3;
            background-color: #F6F6F6;
            border-radius: 4px;
        }
        .amount_due {
            background-color: #f6f6f6;
            border-top: 1px solid #e3e3e3;
            border-bottom: 1px solid #e3e3e3;
        }
        table {
            width: 100%;
        }
        .right {
            float: right !important;
        }
    </style>
</head>
<body>
    <div id="invoice-page">
        <div id="invoice_contents" style="max-width: 800px">
            <div class="logo_bar">
                @if(!isset($invoice->account->user->profile->company_logo))
                <img src="{{ asset('frontend/images/finalpay1.png') }}" alt="Paydirt logo" height="50">
                @else
                <img src="{{ asset($invoice->account->user->profile->company_logo) }}" alt="Paydirt logo" height="50">
                @endif
            </div>
            <table>
                <tr>
                    <td style="width: 27%; border-bottom: 1px solid lightgrey;">
                        <p style="font-size: 10px;">From &nbsp;&nbsp; {{ $invoice->account->user->profile->business_name }}</p>
                    </td>
                    <td style="width: 2%;"></td>
                    <td style="width: 27%; border-bottom: 1px solid lightgrey;">
                        <p style="font-size: 10px;">To &nbsp;&nbsp; {{ $invoice->client->business_name }}</p>
                    </td>
                    <td style="width: 8%;"></td>
                    <td style="width: 20%; border-bottom: 1px solid lightgrey;">
                        <p style="font-size: 10px;">invoice</p>
                    </td>
                    <td style="width: 16%; border-bottom: 1px solid lightgrey;">
                        <p class="formatted-number" style="font-weight: bold; font-size: 10px">{{ $invoice->id }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span style="font-size: 8px; color: #636b6f;">
                            <br/>
                            {{ $invoice->account->user->profile->contact_name }}
                            <br/>
                            Reg. Nr. {{ $invoice->account->user->profile->company_number }}
                            <br/>
                            VAT Nr. {{ $invoice->account->user->profile->vat_number }}
                            <br/>
                            Address: {{ $invoice->account->user->profile->business_address }}
                        </span>
                    </td>
                    <td></td>
                    <td>
                        <span style="font-size: 8px; color: #636b6f;">
                            <br/>
                            {{ $invoice->recipient_name }}
                            <br/>
                            @if(!isset($invoice->recipient_address))
                                {{ $invoice->client->address_detail }}
                            @else
                                {{ $invoice->recipient_address }}
                            @endif
                        </span>
                    </td>
                    <td></td>
                    <td colspan="2">
                        <span style="font-size: 8px;">
                            <br/>
                            <b>Date Issued:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>  
                            @php
                                $date = date_create($invoice->date_issued);
                                echo date_format($date, 'M d\, Y');
                            @endphp
                            <br/>
                            <b>Payment Due:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>  
                            @php
                                $date1 = date_create($invoice->payment_due);
                                echo date_format($date1, 'M d\, Y');
                            @endphp
                        </span>
                        <br/>
                        <br/>
                        <div class="amount_due">
                            <b>Total: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> <b>{{ $invoice->currency->currency_symbol }} {{ $invoice->sum_total }}</b> <span style="color: #636b6f;">{{ $invoice->currency->currency_code }}</span>
                        </div>
                    </td>
                </tr>
            </table>
            <br/><br/><br/><br/><br/>
            <table style="width: 100%">
                <thead>
                    <tr>
                        <th class="amount_due" style="width: 53%; font-size: 10px;"><p style="font-weight: bold;">Description</p></th>
                        <th class="amount_due" style="width: 7%; font-size: 10px;"><p style="font-weight: bold;">Qty</p></th>
                        <th class="amount_due" style="width: 12%; font-size: 10px;"><p style="font-weight: bold;">Unit Price</p></th>
                        @if(count($taxes))
                            @if(count($taxes) == 2)
                                <th class="amount_due" style="width: 8%; font-size: 10px;"><p style="font-weight: bold;">{{$taxes[0]->tax_description}}</p></th>
                                <th class="amount_due" style="width: 8%; font-size: 10px;"><p style="font-weight: bold;">{{$taxes[1]->tax_description}}</p></th>
                            @else
                                <th class="amount_due" style="width: 8%; font-size: 10px;"><p style="font-weight: bold;">VAT</p></th>
                                <th class="amount_due" style="width: 8%; font-size: 10px;"></th>
                            @endif
                        @else
                            <th class="amount_due" style="width: 8%; font-size: 10px;"></th>
                            <th class="amount_due" style="width: 8%; font-size: 10px;"></th>
                        @endif
                        <th class="amount_due" style="width: 12%; font-size: 10px;"><p style="font-weight: bold;">Amount</p></th>
                    </tr>
                </thead>
                <tbody>
                    @if($invoice_descriptions)
                    @foreach($invoice_descriptions as $key=>$value)
                    <tr>
                        <td style="width: 53%; font-size: 9px;">{{ $value->description }}</td>
                        <td style="width: 7%; font-size: 8px;">&nbsp;&nbsp;{{ $value->quality }}</td>
                        <td style="width: 12%; font-size: 8px;">&nbsp;&nbsp;{{ $invoice->currency->currency_symbol }} {{ $value->unit_price }}</td>
                        @if($value->tax1 == 1)
                        <td style="width: 8%; font-size: 10px;">&nbsp;&nbsp;<img src="{{ asset('frontend/images/checkbox.png') }}" width="8" height="8"></td>
                        @else
                        <td style="width: 8%; font-size: 10px;"></td>
                        @endif
                        @if($value->tax2 == 1)
                        <td style="width: 8%; font-size: 10px;">&nbsp;&nbsp;<img src="{{ asset('frontend/images/checkbox.png') }}" width="8" height="8"></td>
                        @else
                        <td style="width: 8%; font-size: 10px;"></td>
                        @endif
                        <td style="width: 12%; font-size: 8px;">{{ $invoice->currency->currency_symbol }} {{ $value->amount_price }}</td>
                    </tr>
                    @endforeach
                    @endif
                    <tr>
                        <td colspan="6" style="border-top: 2px solid #e3e3e3;"></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2" style="font-size: 10px;">
                            <b class="right">Subtotal</b>
                        </td>
                        <td class="right" colspan="2" style="font-size: 10px;"><b>{{ $invoice->currency->currency_symbol }} {{ $invoice->sub_total }}</b> <span style="color: #636b6f;">{{ $invoice->currency->currency_code }}</span></td>
                    </tr>
                    @if(count($taxes))
                      @if(count($taxes) == 2)
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2" style="font-size: 10px;">
                                <b class="right">{{ $taxes[0]->tax_description }} ({{$taxes[0]->tax_percentage}} %)</b>
                            </td>
                            <td class="right" colspan="2" style="font-size: 10px;"><b>{{ $invoice->currency->currency_symbol }} {{$invoice->sum_tax1}}</b> <span style="color: #636b6f;"> {{ $invoice->currency->currency_code }}</span></td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2" style="font-size: 10px;">
                                <b class="right">{{ $taxes[1]->tax_description }} ({{$taxes[1]->tax_percentage}} %)</b>
                            </td>
                            <td class="right" colspan="2" style="font-size: 10px;"><b>{{ $invoice->currency->currency_symbol }} {{$invoice->sum_tax2}}</b> <span style="color: #636b6f;"> {{ $invoice->currency->currency_code }}</span></td>
                        </tr>
                      @else
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2" style="font-size: 10px;">
                                <b class="right">{{ $taxes[0]->tax_description }} ({{$taxes[0]->tax_percentage}} %)</b>
                            </td>
                            <td class="right" colspan="2" style="font-size: 10px;"><b>{{ $invoice->currency->currency_symbol }} {{$invoice->sum_tax1}}</b> <span style="color: #636b6f;"> {{ $invoice->currency->currency_code }}</span></td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2" style="font-size: 10px;">
                                <b class="right"> (0 %)</b>
                            </td>
                            <td class="right" colspan="2" style="font-size: 10px;"><b>{{ $invoice->currency->currency_symbol }} {{$invoice->sum_tax2}}</b> <span style="color: #636b6f;"> {{ $invoice->currency->currency_code }}</span></td>
                        </tr>
                      @endif
                    @else
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2" style="font-size: 10px;">
                                <b class="right"> (0 %)</b>
                            </td>
                            <td class="right" colspan="2" style="font-size: 10px;"><b>{{ $invoice->currency->currency_symbol }} {{$invoice->sum_tax1}}</b> <span style="color: #636b6f;"> {{ $invoice->currency->currency_code }}</span></td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2" style="font-size: 10px;">
                                <b class="right"> (0 %)</b>
                            </td>
                            <td class="right" colspan="2" style="font-size: 10px;"><b>{{ $invoice->currency->currency_symbol }} {{$invoice->sum_tax2}}</b> <span style="color: #636b6f;"> {{ $invoice->currency->currency_code }}</span></td>
                        </tr>
                    @endif
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2" style="font-size: 10px; border-top: 2px solid #e3e3e3; border-bottom: 1px solid #e3e3e3; background-color: #f6f6f6;">
                                <b class="right">Total</b>
                            </td>
                            <td class="right" colspan="2" style="font-size: 10px; border-top: 2px solid #e3e3e3; border-bottom: 1px solid #e3e3e3; background-color: #f6f6f6;"><b>{{ $invoice->currency->currency_symbol }} {{ $invoice->sum_total }}</b> <span style="color: #636b6f;"> {{ $invoice->currency->currency_code }}</span></td>
                        </tr>
                </tbody>
            </table>
            <br/><br/>
            <div style="font-size: 10px; color: #636b6f;">
                @php
                $array = explode("\n", $invoice->invoice_footer);
                foreach($array as $key => $value) {
                    echo '<span>' . $value .'</span><br>';
                }
                @endphp
            </div>
        </div>
    </div>
</body>
</html>