@extends('layouts.dashboard')

@section('title', __('Membership'))

@section('content')
	
<div id="main">

		<div id="page-head">
			<div class="page-title">
      	<div class="container">
          <h1>
            <a href="javascript:;">{{ __('Upgrade Membership') }}</a>
            <!-- <i class="fa fa-angle-right"></i>
            Project Budgets -->
          </h1>
        </div>
      </div>
      <div class="clear"></div>
		</div>
  	<!-- <div class="page-links"></div> -->
    <div id="middle">
      <div class="container">
        <div class="row">
          <div style="width: 20%; padding: 0 10px 0 10px;">
            <table style="width: 100%">
              <thead>
                <tr>
                  <th class="text-left" style="border-bottom: 5px solid blue; vertical-align: middle; color: blue;">
                    <p style="font-size: 25px">Starter</p>
                    <span style="font-size: 15px">10 &euro; / month </span>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="vertical-align: middle; padding: 20px 0 20px 0; border-bottom: 1px solid lightgrey;">
                    Single user
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: middle; padding: 20px 0 20px 0; border-bottom: 1px solid lightgrey;">
                    Unlimited Qoutes & Invoices
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: middle; padding: 20px 0 20px 0;">
                    20 Clients
                  </td>
                </tr>
                <tr>
                  <td class="text-left" style="vertical-align: middle;">
                    @if(isset($user->membership_id))
                      @if($user->membership_id == 1)
                        <a href="https://www.payvia.me/payment/?post_type=product&add-to-cart=11" role="button" class="btn btn-success"> Your Current Plan </a>
                      @else
                        <a href="https://www.payvia.me/payment/?post_type=product&add-to-cart=11" role="button" class="btn btn-info"> Downgrade Plan </a>
                      @endif
                    @else
                      <a href="https://www.payvia.me/payment/?post_type=product&add-to-cart=11" role="button" class="btn btn-primary"> Buy Plan </a>
                    @endif
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div style="width: 20%; padding: 0 10px 0 10px;">
            <table style="width: 100%">
              <thead>
                <tr>
                  <th class="text-left" style="border-bottom: 5px solid green; vertical-align: middle; color: green;">
                    <p style="font-size: 25px">Small Team</p>
                    <span style="font-size: 15px">15 &euro; / month </span>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="vertical-align: middle; padding: 20px 0 20px 0; border-bottom: 1px solid lightgrey;">
                    2 team members
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: middle; padding: 20px 0 20px 0; border-bottom: 1px solid lightgrey;">
                    Unlimited Qoutes & Invoices
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: middle; padding: 20px 0 20px 0;">
                    50 Clients
                  </td>
                </tr>
                <tr>
                  <td class="text-left" style="vertical-align: middle;">
                    @if(isset($user->membership_id))
                      @if($user->membership_id == 2)
                        <a href="https://www.payvia.me/payment/?post_type=product&add-to-cart=29" role="button" class="btn btn-success"> Your Current Plan </a>
                      @elseif($user->membership_id > 2)
                        <a href="https://www.payvia.me/payment/?post_type=product&add-to-cart=29" role="button" class="btn btn-info"> Downgrade Plan </a>
                      @else
                        <a href="https://www.payvia.me/payment/?post_type=product&add-to-cart=29" role="button" class="btn btn-primary"> Upgrade Plan </a>
                      @endif
                    @else
                      <a href="https://www.payvia.me/payment/?post_type=product&add-to-cart=29" role="button" class="btn btn-primary"> Buy Plan </a>
                    @endif
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div style="width: 20%; padding: 0 10px 0 10px;">
            <table style="width: 100%">
              <thead>
                <tr>
                  <th class="text-left" style="border-bottom: 5px solid orange; vertical-align: middle; color: orange;">
                    <p style="font-size: 25px">Medium Team</p>
                    <span style="font-size: 15px">22 &euro; / month </span>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="vertical-align: middle; padding: 20px 0 20px 0; border-bottom: 1px solid lightgrey;">
                    4 team members
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: middle; padding: 20px 0 20px 0; border-bottom: 1px solid lightgrey;">
                    Unlimited Qoutes & Invoices
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: middle; padding: 20px 0 20px 0;">
                    100 Clients
                  </td>
                </tr>
                <tr>
                  <td class="text-left" style="vertical-align: middle;">
                    @if(isset($user->membership_id))
                      @if($user->membership_id == 3)
                        <a href="https://www.payvia.me/payment/?post_type=product&add-to-cart=30" role="button" class="btn btn-success"> Your Current Plan </a>
                      @elseif($user->membership_id > 3)
                        <a href="https://www.payvia.me/payment/?post_type=product&add-to-cart=30" role="button" class="btn btn-info"> Downgrade Plan </a>
                      @else
                        <a href="https://www.payvia.me/payment/?post_type=product&add-to-cart=30" role="button" class="btn btn-primary"> Upgrade Plan </a>
                      @endif
                    @else
                      <a href="https://www.payvia.me/payment/?post_type=product&add-to-cart=30" role="button" class="btn btn-primary"> Buy Plan </a>
                    @endif
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div style="width: 20%; padding: 0 10px 0 10px;">
            <table style="width: 100%">
              <thead>
                <tr>
                  <th class="text-left" style="border-bottom: 5px solid red; vertical-align: middle; color: red;">
                    <p style="font-size: 25px">Large Team</p>
                    <span style="font-size: 15px">36 &euro; / month </span>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="vertical-align: middle; padding: 20px 0 20px 0; border-bottom: 1px solid lightgrey;">
                    8 team members
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: middle; padding: 20px 0 20px 0; border-bottom: 1px solid lightgrey;">
                    Unlimited Qoutes & Invoices
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: middle; padding: 20px 0 20px 0;">
                    250 Clients
                  </td>
                </tr>
                <tr>
                  <td class="text-left" style="vertical-align: middle;">
                    @if(isset($user->membership_id))
                      @if($user->membership_id == 4)
                        <a href="https://www.payvia.me/payment/?post_type=product&add-to-cart=31" role="button" class="btn btn-success"> Your Current Plan </a>
                      @elseif($user->membership_id > 4)
                        <a href="https://www.payvia.me/payment/?post_type=product&add-to-cart=31" role="button" class="btn btn-info"> Downgrade Plan </a>
                      @else
                        <a href="https://www.payvia.me/payment/?post_type=product&add-to-cart=31" role="button" class="btn btn-primary"> Upgrade Plan </a>
                      @endif
                    @else
                      <a href="https://www.payvia.me/payment/?post_type=product&add-to-cart=31" role="button" class="btn btn-primary"> Buy Plan </a>
                    @endif
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div style="width: 20%; padding: 0 10px 0 10px;">
            <table style="width: 100%">
              <thead>
                <tr>
                  <th class="text-left" style="border-bottom: 5px solid purple; vertical-align: middle; color: purple;">
                    <p style="font-size: 25px">Enterprise</p>
                    <span style="font-size: 15px">50 &euro; / month </span>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="vertical-align: middle; padding: 20px 0 20px 0; border-bottom: 1px solid lightgrey;">
                    Unlimited team members
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: middle; padding: 20px 0 20px 0; border-bottom: 1px solid lightgrey;">
                    Unlimited Qoutes & Invoices
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: middle; padding: 20px 0 20px 0;">
                    Unlimited Clients
                  </td>
                </tr>
                <tr>
                  <td class="text-left" style="vertical-align: middle;">
                    @if(isset($user->membership_id))
                      @if($user->membership_id == 5)
                        <a href="https://www.payvia.me/payment/?post_type=product&add-to-cart=32" role="button" class="btn btn-success"> Your Current Plan </a>
                      @else
                        <a href="https://www.payvia.me/payment/?post_type=product&add-to-cart=32" role="button" class="btn btn-primary"> Upgrade Plan </a>
                      @endif
                    @else
                      <a href="https://www.payvia.me/payment/?post_type=product&add-to-cart=32" role="button" class="btn btn-primary"> Buy Plan </a>
                    @endif
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection