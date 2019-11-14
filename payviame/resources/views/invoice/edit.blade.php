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
</style>
@endpush

@section('content')

<div id="main">
  <div>
    <div id="page-head">
      <div class="page-title" style="padding-bottom: 68px;">
        <div class="container">
          <h1>
            <a href="{{ route('invoice.index') }}">Invoice</a>
            <i class="fa fa-angle-right"></i>
            {{ $invoice->id }}
            <i class="fa fa-angle-right"></i>
            Edit
          </h1>
        </div>
      </div>
    </div>
    <div class="page-links">
      <div class="container">
        <div class="left-penal"></div>
        <div class="right-penal">
          <div style="position: relative;top: 0px;">
            <ul class="nav nav-tabs page-tab">
              <li class="nav-item">
                <a class="nav-link" href="{{route('invoice.show', $invoice->id)}}">Manage Invoice</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="{{route('invoice.edit', $invoice->id)}}">Edit Invoice</a>
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
        <!-- Manage invoices page Content-->
      <!--edit client-->
      <div id="menu2" class="tab-pane active"><br>
        <div id="middle">
          <div class="container">
            <div id="edit_invoice_page">
              <form class="backbone" method="POST" action="{{ route('invoice.update', $invoice->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="span-18">
                  <div id="invoice-page" class="mb-5">
                    <div class="clearfix shell">
                      <div id="logo_uploader_container">
                        <div>
                          <div class="logo_bar">
                            @if(!isset($invoice->account->user->profile->company_logo))
                            <img src="{{ asset('frontend/images/finalpay1.png') }}" alt="Paydirt logo" height="80">
                            @else
                            <img src="{{ asset($invoice->account->user->profile->company_logo) }}" alt="Paydirt logo" height="80">
                            @endif
                          </div>
                          <hr class="space">
                        </div>
                      </div>
                      <hr class="clear space">
                      <div class="my_business span-7">
                        <div class="span-6">
                          <h3 class="invoice-from">
                            From
                            &nbsp;
                          </h3>
                        </div>
                        <div class="last span-18">
                          <input type="text" name="account_business_name" placeholder="Your business name" value="{{ $invoice->account->user->profile->business_name }}">
                        </div>
                        <hr class="clear">
                        <input type="text" name="account_contact_name" placeholder="Your name" value="{{ $invoice->account->user->profile->contact_name }}">
                        <div class="account_address">
                          <textarea class="street_address" name="account_address" rows="4" placeholder="Your address">Reg. Nr. {{ $invoice->account->user->profile->company_number }}&#013;VAT Nr. {{ $invoice->account->user->profile->vat_number }}&#013;Address: {{ $invoice->account->user->profile->business_address }}</textarea>
                        </div>
                      </div>
                      <div class="span-7">
                        <div class="span-6">
                          <h3 class="invoice-to">
                            To
                            &nbsp;
                          </h3>
                        </div>
                        <div class="last span-18">
                          <input type="text" name="client_business_name" placeholder="Recipient's business name" value="{{ $invoice->client->business_name }}">
                        </div>
                        <hr class="clear">
                        @if(!isset($invoice->recipient_name))
                          <input type="text" name="recipient_name" id="recipient_name" placeholder="Recipient's name" value="{{ $invoice->client->contact_name }}">
                        @else
                          <input type="text" name="recipient_name" id="recipient_name" placeholder="Recipient's name" value="{{ $invoice->recipient_name }}">
                        @endif
                        <div class="client_address">
                          @if(!isset($invoice->recipient_address))
                            <textarea class="street_address" name="recipient_address" rows="4" placeholder="Recipient's address">{{ $invoice->client->address_detail }}</textarea>
                          @else
                            <textarea class="street_address" name="recipient_address" rows="4" placeholder="Recipient's address">{{ $invoice->recipient_address }}</textarea>
                          @endif
                        </div>
                      </div>
                      <div class="span-1">&nbsp;</div>
                      <div class="last span-9">
                        <div class="formatted-number-input">
                          <input class="form-5 number" type="text" name="padded_number" value="{{ $invoice->id }}">
                        </div>
                        <h3 class="invoice-number">
                          <span class="invoice-type">
                            Invoice
                            <hr class="clear">
                          </span>
                        </h3>
                        <div id="invoice-dates">
                          <label for="issued_at">Date Issued:</label>
                          <div class="faux_input form-9 col-md-6">
                            <input type="date" name="date_issued" class="datepic-im" id="date_issued" style="border: 0;" value="{{ $invoice->date_issued }}">
                          </div>
                        </div>
                        <br>
                        <div id="invoice-dates">
                          <label for="issued_at">Payment due:</label>
                          <div class="faux_input form-9 col-md-6">
                            <input type="date" name="payment_due" class="datepic-im" id="payment_due" style="border: 0;" value="{{ $invoice->payment_due }}">
                          </div>
                        </div>
                      </div>
                      <hr class="clear space">
                      <div class="last span-16">
                        <h3 class="invoice-description">Description</h3>
                        <hr class="clear">
                        <textarea class="invoice_description" type="text" name="recipient_description" rows="2" style="height: 40px;"></textarea>
                      </div>
                      <hr class="clear space">
                      <!-- table start -->
                      <table id="line_items" class="example">
                        <thead>
                          <tr>
                            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            <th class="description">Description</th>
                            <th>Qty</th>
                            <th>Unit Price</th>
                            @if(count($taxes))
                              @if(count($taxes) == 2)
                                @foreach($taxes as $key=>$tax)
                                <th class="tax_header"><span id="t-tax{{$key}}">{{ $tax->tax_description }}</span></th>
                                @endforeach
                              @else
                                @foreach($taxes as $key=>$tax)
                                <th class="tax_header"><span id="t-tax{{$key}}">{{ $tax->tax_description }}</span></th>
                                @endforeach
                                <th class="tax_header"><!-- <span id="t-tax1">OTV</span> --></th>
                              @endif
                            @else
                              <th class="tax_header"><!-- <span  id="t-tax0">VAT</span> --></th>
                              <th class="tax_header"><!-- <span  id="t-tax1">OTV</span> --></th>
                            @endif
                            <th>
                              <span class="right">Amount</span>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          @php
                            $num = 2;
                          @endphp
                          @if($invoice_descriptions)
                            @foreach($invoice_descriptions as $key=>$value)
                            <tr id="tr{{++$key}}" class="fields tr">
                              <td class="no-space">
                                  <div class="controls">
                                      <div class="outset_left_container">
                                          <span id="{{$key}}"  class="delete1 remove_line_item" onClick="delete2({{$key}})"><i class="fa fa-remove"></i></span>
                                      </div>
                                  </div>
                              </td>
                              <td>
                                <textarea class="form-control line_item invoice" name="description" rows="1"  style="height: 30px;">{{ $value->description }}</textarea>
                              </td>
                              <td>
                                <input id="QTY{{$key}}" class="form-control line_item_quantity form-4 invoice" type="text" name="quality" onKeyUp="Subtotal({{$key}})" value="{{ $value->quality }}">
                              </td>
                              <td class="nowrap">
                                <input id="PPRICE{{$key}}" class="form-5 form-control inline line_item_rate invoice" type="text" name="unit_price" onKeyUp="Subtotal({{$key}})" value="{{ $value->unit_price }}">
                              </td>
                              <td class="text-center">
                                @if($value->tax1 == 1)
                                <input id="t-taxbox{{$key}}" class="includes_tax mx-auto t-taxbox invoice" type="checkbox" checked value="1" name="tax1">
                                @else
                                <input id="t-taxbox{{$key}}" class="includes_tax mx-auto t-taxbox invoice" type="checkbox" value="1" name="tax1">
                                @endif
                                <input type="text" id="tax_val{{$key}}" class="tax_val1 invoice" value="{{$value->tax_val1}}" name="tax_val1" hidden>
                              </td>
                              <td class="text-center">
                                @if($value->tax2 == 1)
                                <input id="t-taxboxx{{$key}}" class="includes_tax mx-auto t-taxboxx invoice" type="checkbox" checked value="1" name="tax2">
                                @else
                                <input id="t-taxboxx{{$key}}" class="includes_tax mx-auto t-taxboxx invoice" type="checkbox" value="1" name="tax2">
                                @endif
                                <input type="text" id="tax_vall{{$key}}" class="tax_val2 invoice" value="{{$value->tax_val2}}" name="tax_val2" hidden>
                              </td>
                                
                              <td class="grey line_item_subtotal nowrap">
                                <span><input type="text" name="amount_price" value="{{ $value->amount_price }}" id="TOTAL1" class="border-0 text-right amount invoice" disabled />{{$invoice->currency->currency_symbol}}</span>
                              </td>                
                            </tr>
                            @php
                            $num++;
                            @endphp
                            @endforeach
                          @else
                          <tr id='tr1' class="fields tr">
                            <td class="no-space">
                                <div class="controls">
                                    <div class="outset_left_container">
                                        <span id='1'  class='delete1 remove_line_item' onClick='delete2(1)'><i class="fa fa-remove"></i></span>
                                    </div>
                                </div>
                            </td>
                            <td>
                              <textarea class="form-control line_item invoice" name="description" rows="1"  style="height: 30px;"></textarea>
                            </td>
                            <td>
                              <input id="QTY1" class="form-control line_item_quantity form-4 invoice" type="text" name="quality" onKeyUp="Subtotal(1)" value="1">
                            </td>
                            <td class="nowrap">
                              <input id="PPRICE1" class="form-5 form-control inline line_item_rate invoice" type="text" name="unit_price" onKeyUp="Subtotal(1)" value="0">
                            </td>
                            @if(count($taxes))
                              @if(count($taxes) == 2)
                                <td class="text-center">
                                  <input id="t-taxbox1" class="includes_tax mx-auto t-taxbox invoice" type="checkbox" checked value="1" name="tax1">
                                  <input type="text" id="tax_val1" class="tax_val1 invoice" value="0" name="tax_val1" hidden>
                                </td>
                                <td class="text-center">
                                  <input id="t-taxboxx1" class="includes_tax mx-auto t-taxboxx invoice" type="checkbox" checked value="1" name="tax2">
                                  <input type="text" id="tax_vall1" class="tax_val2 invoice" value="0" name="tax_val2" hidden>
                                </td>
                              @else
                                <td class="text-center">
                                  <input id="t-taxbox1" class="includes_tax mx-auto t-taxbox invoice" name="tax1" type="checkbox" checked value="1" >
                                  <input type="text" id="tax_val1" class="tax_val1 invoice" value="0" name="tax_val1" hidden>
                                </td>
                                <td class="text-center">
                                  <input id="t-taxboxx1" class="includes_tax mx-auto t-taxboxx invoice" type="checkbox" name="tax2" checked value="1" hidden>
                                  <input type="text" id="tax_vall1" class="tax_val2 invoice" value="0" name="tax_val2" hidden>
                                </td>
                              @endif
                            @else
                              <td class="text-center">
                                <input id="t-taxbox1" class="includes_tax mx-auto t-taxbox invoice" type="checkbox" name="tax1" checked value="1" >
                                <input type="text" id="tax_val1" class="tax_val1 invoice" value="0" name="tax_val1" hidden>
                              </td>
                              <td class="text-center">
                                <input id="t-taxboxx1" class="includes_tax mx-auto t-taxboxx invoice" type="checkbox" name="tax2" checked value="1">
                                <input type="text" id="tax_vall1" class="tax_val2 invoice" value="0" name="tax_val2" hidden>
                              </td>
                            @endif
                            <td class="grey line_item_subtotal nowrap">
                              <span><input type="text" name="amount_price" value="0.00" id="TOTAL1" class="border-0 text-right amount invoice" disabled /></span>
                            </td>                
                          </tr>
                          @endif
                          <tr id='tr_n'></tr>
                          <tr>
                              <td class="rule" colspan="7"></td>
                          </tr>
                          <tr class="add_fields">
                            <td colspan="3" data-original-colspan="3">
                              <div class="add btn-group">
                                <button type="button" class="btn add_line_item" onclick="myaddlist()">Add a line item</button>
                                <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                </button>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
                                  @foreach($inventories as $inventory)
                                  <a class="dropdown-item sel_inventory" attr-description="{{ $inventory->inventory_description }}" attr-price="{{ $inventory->inventory_price }}" href="javascript:;">{{ $inventory->inventory_description }}</a>
                                  @endforeach
                                  @if($user->role_id == 1)
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="{{route('setting.inventory.index')}}">Manage your preset line items</a>
                                  @endif
                                </div>
                              </div>
                            </td>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                              <b class="right">Subtotal</b>
                            </td>
                            <td class="nowrap" id="invoice_subtotal">
                              <input type="text" name="TOTAL" id="sub_total" value="{{$invoice->sub_total}}" class="border-0 text-right" disabled/><span class="currency_code">{{$invoice->currency->currency_symbol}}</span>
                            </td>
                          </tr>
                          @if(count($taxes))
                            @if(count($taxes) == 2)
                              <tr class="tax_total text-right" data-id="0" style="display: table-row;">
                                <td colspan="6" data-original-colspan="4">
                                  <b class="right">{{ $taxes[0]->tax_description }} ({{$taxes[0]->tax_percentage}} %)</b>
                                  <input type="text" id="tax_per1" value="{{$taxes[0]->tax_percentage}}" hidden>
                                </td>
                                <td class="nowrap tax_subtotal" id="invoice_tax_0" data-id="0">
                                  <input type="text" id="sum_tax1" value="{{$invoice->sum_tax1}}" class="border-0 text-right" disabled><span class="currency_code">{{$invoice->currency->currency_symbol}}</span>
                                </td>
                              </tr>
                              <tr class="tax_total text-right" data-id="0" style="display: table-row;">
                                <td colspan="6" data-original-colspan="4">
                                  <b class="right">{{ $taxes[1]->tax_description }} ({{$taxes[1]->tax_percentage}} %)</b>
                                  <input type="text" id="tax_per2" value="{{$taxes[1]->tax_percentage}}" hidden>
                                </td>
                                <td class="nowrap tax_subtotal" id="invoice_tax_0" data-id="0">
                                  <input type="text" id="sum_tax2" value="{{$invoice->sum_tax2}}" class="border-0 text-right" disabled><span class="currency_code">{{$invoice->currency->currency_symbol}}</span>
                                </td>
                              </tr>
                            @else
                              <tr class="tax_total text-right" data-id="0" style="display: table-row;">
                                <td colspan="6" data-original-colspan="4">
                                  <b class="right">{{ $taxes[0]->tax_description }} ({{$taxes[0]->tax_percentage}} %)</b>
                                  <input type="text" id="tax_per1" value="{{$taxes[0]->tax_percentage}}" hidden>
                                </td>
                                <td class="nowrap tax_subtotal" id="invoice_tax_0" data-id="0">
                                  <input type="text" id="sum_tax1" value="{{$invoice->sum_tax1}}" class="border-0 text-right" disabled><span class="currency_code">{{$invoice->currency->currency_symbol}}</span>
                                </td>
                              </tr>
                              <tr class="tax_total text-right" data-id="0" style="display: table-row;">
                                <td colspan="6" data-original-colspan="4">
                                  <b class="right"> (0 %)</b>
                                  <input type="text" id="tax_per2" value="0" hidden>
                                </td>
                                <td class="nowrap tax_subtotal" id="invoice_tax_0" data-id="0">
                                  <input type="text" id="sum_tax2" value="{{$invoice->sum_tax2}}" class="border-0 text-right" disabled><span class="currency_code">{{$invoice->currency->currency_symbol}}</span>
                                </td>
                              </tr>
                            @endif
                          @else
                            <tr class="tax_total text-right" data-id="0" style="display: table-row;">
                                <td colspan="6" data-original-colspan="4">
                                  <b class="right"> (0 %)</b>
                                  <input type="text" id="tax_per1" value="0" hidden>
                                </td>
                                <td class="nowrap tax_subtotal" id="invoice_tax_0" data-id="0">
                                  <input type="text" id="sum_tax1" value="{{$invoice->sum_tax1}}" class="border-0 text-right" disabled><span class="currency_code">{{$invoice->currency->currency_symbol}}</span>
                                </td>
                              </tr>
                              <tr class="tax_total text-right" data-id="0" style="display: table-row;">
                                <td colspan="6" data-original-colspan="4">
                                  <b class="right">0 (0 %)</b>
                                  <input type="text" id="tax_per2" value="0" hidden>
                                </td>
                                <td class="nowrap tax_subtotal" id="invoice_tax_0" data-id="0">
                                  <input type="text" id="sum_tax2" value="{{$invoice->sum_tax2}}" class="border-0 text-right" disabled><span class="currency_code">{{$invoice->currency->currency_symbol}}</span>
                                </td>
                              </tr>
                          @endif
                          <tr>
                            <td></td> 
                            <td></td>

                            <td colspan="4" width="20%">
                              <b class="right">Total</b>
                            </td>
                            <td class="nowrap" id="invoice_total">
                              <input type="text" name="TOTAL" id="sum_total" value="{{$invoice->sum_total}}" class="border-0 text-right" disabled/><span class="currency_code">{{$invoice->currency->currency_symbol}}</span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="last span-24">
                        <hr class="clear space">
                        <hr class="clear space">
                        <hr class="clear space">
                        @if(!isset($invoice->invoice_footer))
                          <textarea class="invoice_footer" id="invoice_footer" name="invoice_footer" rows="2" placeholder="Terms and Conditions" style="height: 100px;">{{ $invoice->account->user->profile->invoice_footer }}</textarea>
                        @else
                          <textarea class="invoice_footer" id="invoice_footer" name="invoice_footer" rows="2" placeholder="Terms and Conditions" style="height: 100px;">{{ $invoice->invoice_footer }}</textarea>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <div class="last span-6 ">
                  <div class="fixed" id="side">
                    <div class="follow" id="invoice-controls" style="">
                      <input class="massive" id="save-invoice" type="submit" value="Save Changes">
                      <span class="cancel">
                        or
                        <a class="cancel" href="{{ route('invoice.show', $invoice->id )}}">Discard changes</a>
                      </span>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="clear"></div>
</div>

<div class="clear"></div>

@endsection

@push('scripts')
<script> 
  var tax_per1 = Number($('#tax_per1').val())/Number(100);
  var tax_per2 = Number($('#tax_per2').val())/Number(100);
  console.log(tax_per1);
  console.log(tax_per2);

  var i = '<?php echo $num?>';
  function myaddlist() {

    $("<tr id='tr" + i + "' class='fields tr'><td class='no-space'><div class='controls'><div class='outset_left_container'><span id='" + i + "'  class='delete" + i + "  remove_line_item' onClick='delete2(this.id)'><i class='fa fa-remove'></i></span></div></div></td><td><textarea class='form-control line_item invoice' name='description' rows='1'  style='height: 30px;'></textarea></td><td><input id='QTY" + i + "' class='form-control line_item_quantity form-4 invoice' name='quality' value='1' type='text' onKeyUp='Subtotal(" + i + ")'></td><td class='nowrap'><input id='PPRICE" + i + "'  class='form-5 form-control inline line_item_rate invoice' name='unit_price' value='0' type='text' onKeyUp='Subtotal(" + i + ")'></td><td class='text-center'><input id='t-taxbox" + i +"' class='includes_tax mx-auto t-taxbox invoice' name='tax1' type='checkbox' checked value='1' ><input type='text' id='tax_val" + i + "' class='tax_val1 invoice' name='tax_val1' value='0' hidden></td><td class='text-center'><input id='t-taxboxx" + i + "' class='includes_tax mx-auto t-taxboxx invoice' type='checkbox' name='tax2' checked value='1' ><input type='text' id='tax_vall" + i + "' class='tax_val2 invoice' name='tax_val2' value='0' hidden></td><td class='grey line_item_subtotal nowrap'><span><input type='text' name='amount_price' value='0' id='TOTAL" + i + "' class='border-0 text-right amount invoice' name='amount_price' />{{$invoice->currency->currency_symbol}}</span></td></tr>").insertBefore('#tr_n')
    i++;
  
  }
 
  function delete2(id) {
    var j = "tr" + id;
    var sum = parseFloat(document.getElementById('sub_total').value);
    var sum_tax1 = parseFloat(document.getElementById('sum_tax1').value);
    var sum_tax2 = parseFloat(document.getElementById('sum_tax2').value);
    var sum_total = 0;
    $(document).find('#' + j).each(function(){
        $(this).find('.amount').each(function(){
            sum -= parseFloat($(this).val());
        })
        $(this).find('.tax_val1').each(function(){
            sum_tax1 -= parseFloat($(this).val());
        })
        $(this).find('.tax_val2').each(function(){
            sum_tax2 -= parseFloat($(this).val());
        })
    });
    sum_total += sum + sum_tax1 + sum_tax2;
    document.getElementById('sub_total').value = sum.toFixed(2);
    document.getElementById('sum_tax1').value = sum_tax1.toFixed(2);
    document.getElementById('sum_tax2').value = sum_tax2.toFixed(2);
    document.getElementById('sum_total').value = sum_total.toFixed(2);
    $('#' + j).remove();
  }

  function Subtotal($id) {
    a = Number(document.getElementById('QTY'+$id).value);
    b = Number(document.getElementById('PPRICE'+$id).value);

    c = a * b;
    var tax1 = 0;
    var tax1 = 0;
    tax1 = c * tax_per1;
    tax2 = c * tax_per2;

    document.getElementById('TOTAL'+$id).value = c.toFixed(2);
    document.getElementById('tax_val' + $id).value = tax1.toFixed(2);
    document.getElementById('tax_vall' + $id).value = tax2.toFixed(2);

    getSum();

  }

  function getSum() {
    var sum = 0;
    var sum_tax1 = 0;
    var sum_tax2 = 0;
    var sum_total = 0

    $(document).find('.tr').each(function(){
        $(this).find('.amount').each(function(){
          sum += parseFloat($(this).val());
        })
        $(this).find('.tax_val1').each(function(){
          if($(this).parent().children().eq(0).prop('checked') == true){
            sum_tax1 += parseFloat($(this).val());
          }
        })
        $(this).find('.tax_val2').each(function(){
          if($(this).parent().children().eq(0).prop('checked') == true){
            sum_tax2 += parseFloat($(this).val());
          }
        })
    });
    sum_total += sum + sum_tax1 + sum_tax2;
    document.getElementById('sub_total').value = sum.toFixed(2);
    document.getElementById('sum_tax1').value = sum_tax1.toFixed(2);
    document.getElementById('sum_tax2').value = sum_tax2.toFixed(2);
    document.getElementById('sum_total').value = sum_total.toFixed(2);
  }

  $(document).on('click','.t-taxbox',function(){
    if ($(this).prop('checked') == true)
    {
      var tax1 = parseFloat($(this).parent().children().eq(1).val());
      var sum_tax1 = parseFloat(document.getElementById('sum_tax1').value);
      var sum_total = parseFloat(document.getElementById('sum_total').value);
      sum_tax1 += tax1;
      sum_total += tax1;
      document.getElementById('sum_tax1').value = sum_tax1.toFixed(2);
      document.getElementById('sum_total').value = sum_total.toFixed(2);
    } else {
      var tax1 = parseFloat($(this).parent().children().eq(1).val());
      var sum_tax1 = parseFloat(document.getElementById('sum_tax1').value);
      var sum_total = parseFloat(document.getElementById('sum_total').value);
      sum_tax1 -= tax1;
      sum_total -= tax1;
      document.getElementById('sum_tax1').value = sum_tax1.toFixed(2);
      document.getElementById('sum_total').value = sum_total.toFixed(2);
    }
  })

  $(document).on('click','.t-taxboxx',function(){
    if ($(this).prop('checked') == true)
    {
      var tax2 = parseFloat($(this).parent().children().eq(1).val());
      var sum_tax2 = parseFloat(document.getElementById('sum_tax2').value);
      var sum_total = parseFloat(document.getElementById('sum_total').value);
      sum_tax2 += tax2;
      sum_total += tax2;
      document.getElementById('sum_tax2').value = sum_tax2.toFixed(2);
      document.getElementById('sum_total').value = sum_total.toFixed(2);
    } else {
      var tax2 = parseFloat($(this).parent().children().eq(1).val());
      var sum_tax2 = parseFloat(document.getElementById('sum_tax2').value);
      var sum_total = parseFloat(document.getElementById('sum_total').value);
      sum_tax2 -= tax2;
      sum_total -= tax2;
      document.getElementById('sum_tax2').value = sum_tax2.toFixed(2);
      document.getElementById('sum_total').value = sum_total.toFixed(2);
    }
  })

  $('.sel_inventory').click(function(){
    $("<tr id='tr" + i + "' class='fields tr'><td class='no-space'><div class='controls'><div class='outset_left_container'><span id='" + i + "'  class='delete" + i + "  remove_line_item' onClick='delete2(this.id)'><i class='fa fa-remove'></i></span></div></div></td><td><textarea class='form-control line_item invoice' name='description' rows='1'  style='height: 30px;'>" + $(this).attr('attr-description') + "</textarea></td><td><input id='QTY" + i + "' class='form-control line_item_quantity form-4 invoice' name='quality' value='1' type='text' onKeyUp='Subtotal(" + i + ")'></td><td class='nowrap'><input id='PPRICE" + i + "'  class='form-5 form-control inline line_item_rate invoice' name='unit_price' value='" + $(this).attr('attr-price') + "' type='text' onKeyUp='Subtotal(" + i + ")'></td><td class='text-center'><input id='t-taxbox" + i +"' class='includes_tax mx-auto t-taxbox invoice' type='checkbox' name='tax1' checked value='1' ><input type='text' id='tax_val" + i + "' class='tax_val1 invoice' name='tax_val1' value='0' hidden></td><td class='text-center'><input id='t-taxboxx" + i + "' class='includes_tax mx-auto t-taxboxx invoice' name='tax2' type='checkbox' checked value='1' ><input type='text' id='tax_vall" + i + "' class='tax_val2 invoice' name='tax_val2' value='0' hidden></td><td class='grey line_item_subtotal nowrap'><span><input type='text' name='amount_price' value='0' id='TOTAL" + i + "' class='border-0 text-right amount invoice' />{{$invoice->currency->currency_symbol}}</span></td></tr>").insertBefore('#tr_n');
    Subtotal(i);
    i++;
  })

  var height = $("#side").height();

  $(window).scroll(function(){
    $("#side").css("top",Math.max(15,227-$(this).scrollTop()));
                      
    if( ($("#side").offset().top+height) >= $('footer').offset().top ){
        $("#side").hide();       
    } 
     
    if( ($(this).scrollTop()+height) < ($('footer').offset().top) ){
        $("#side").show();       
    }
     
  });

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $(document).on('click','#save-invoice',function(e){
      e.preventDefault();
      var send_data = {
        'id' : '<?php echo $invoice->id?>',
        'recipient_name' : $('#recipient_name').val(),
        'recipient_address' : $('#recipient_address').val(),
        'date_issued' : $('#date_issued').val(),
        'payment_due' : $('#payment_due').val(),
        'recipient_description' : $('#recipient_description').val(),
        'sum_total' : $('#sum_total').val(),
        'sub_total' : $('#sub_total').val(),
        'sum_tax1' : $('#sum_tax1').val(),
        'sum_tax2' : $('#sum_tax2').val(),
        'invoice_footer' : $('#invoice_footer').val(),
      };

      send_data['invoice_description'] = [];

      $(document).find('.tr').each(function(){
          var data_invoice_description = {};
          $(this).find('.invoice').each(function(){
            if($(this).attr('type') == 'checkbox'){
              if($(this).prop('checked') == true) {
                data_invoice_description[$(this).attr('name')] = $(this).val();
              } else {
                data_invoice_description[$(this).attr('name')] = 0;
              }
            } else {
              data_invoice_description[$(this).attr('name')] = $(this).val();
            }
          })

          send_data['invoice_description'].push(data_invoice_description);
      });

      $.ajax({
          type:'POST',
          url:'{{ url('/invoices/update') }}',
          data:send_data,
          success:function(data){
              toastr['success'](data.success,'Success');
              setTimeout(function() {
                  window.location.href = '{{url('/invoices/'.$invoice->id)}}';
              }, 1000);
          }
      });
  })

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
</script>
@endpush