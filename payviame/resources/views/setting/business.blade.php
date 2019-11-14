@extends('layouts.dashboard')

@section('title', __('Business Detail'))

@push('stylesheets')
    <style type="text/css">
        #main {
            min-height: 600px;
            background-color: #f5f0ea;
        }
        #middle {
            padding: 30px 50px;
            background: transparent;
        }
        .container {
            min-width: 950px;
            max-width: 1200px;
        }
        #settings_navigation {
            width: 200px;
            float: left;
            font-size: 14px;
            position: relative;
        }
        #settings_navigation ul {
            margin: 0;
            padding: 15px 0;
            overflow: hidden;
            position: relative;
            border-right: 1px solid #c2c2c2;
        }
        #settings_navigation li.heading {
            margin: 8px 0 0 0;
            padding: 8px 0;
            font-weight: 600;
            color: #41829c;
        }
        #settings_navigation ul li {
            display: block;
            line-height: 18px;
            border-bottom: 1px solid #d8d8d8;
        }
        #settings_navigation a {
            display: block;
            padding: 5px;
            color: #808080;
            transition-property: all;
            transition-duration: 0.2s;
            transition-timing-function: ease;
        }
        #settings_navigation li.current a {
            color: #000000;
            font-weight: bold;
            padding-left: 5px;
            background: rgba(0,0,0,0.05);
        }
        #settings_navigation ul:after {
            content: "";
            display: block;
            width: 100px;
            height: 96%;
            position: absolute;
            top: 2%;
            right: -100px;
            background: transparent;
            border-radius: 100px;
            box-shadow: 0 0 35px 0 rgba(0,0,0,0.15);
        }

        .container1 input[type=text], input[type=file], select {
          width: 50% !important;
          padding: 5px 20px;
          margin: 8px 0;
          display: block;
          border: 1px solid #ccc;
          border-radius: 4px;
          box-sizing: border-box;
        }

        .container1 input[type=submit] {
          width: 50%;
          background-color: #1a1a1a;
          color: white;
          padding: 10px 20px;
          margin: 8px 0;
          border: none;
          border-radius: 4px;
          cursor: pointer;
          font-size: 20px;
        }

        .container1 input[type=submit]:hover {
          background-color: #45a049;
        }

        div.container1 {
          border-radius: 5px;
          background-color: #ffffff;
          padding: 20px;
            margin-left: 252px;
        }

        .container1 label{
            color: #444;
            font-size: 13px;
            /*height: 46px;
            line-height: 46px;*/
            font-weight: bold;
        }

        span.field-desc {
            display: block;
            color: #888;
            font-size: 0.9em;
            padding: 5px 0 10px 3px;
        }
        .title {
            height: 55px;
            line-height: 45px;
            padding: 15px;
            background-color: #fcfaf8;
            border: 1px solid rgba(0,0,0,0.06);
            border-width: 0 0 1px 0;
            border-radius: 3px 3px 0 0;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.5);
            margin-left: 252px;
        }

        .title h2{
            color: #415664;
            font-size: 20px;
            font-weight: 600;
            text-transform: none;
            text-shadow: 0 1px 0 white;
        }
        label {
            display: inline-block;
            margin-bottom: 0px; 
        }

    </style>
@endpush

@section('content')

    <div id="main">
        <div id="middle">
            <div class="container">

                <div id="settings_navigation">
                    <ul>
                        <li class="heading">About Me</li>
                        <li >
                            <a href="{{ route('setting.profile.index',$user->profile->id) }}">My Profile</a>
                        </li>
                        <li>
                            <a href="{{ route('setting.password.index') }}">My Password</a>
                        </li>
                        @if($user->role_id != 1)
                        <li class="heading">Invoices &amp; Quotes</li>
                        <li>
                            <a href="{{ route('setting.performence.index') }}">Performence</a>
                        </li>
                        @endif
                        @if($user->role_id == 1)
                        <li class="heading">Account</li>
                        <li class="current">
                            <a href="{{ route('setting.business.detail') }}">Business Details</a>
                        </li>
                        <li>
                            <a href="{{ route('report.membership') }}">Membership Plans</a>
                        </li>
                        <li class="heading">Invoices &amp; Quotes</li>
                        <li>
                            <a href="{{ route('setting.default.index') }}">Default</a>
                        </li>
                        <li>
                            <a href="{{ route('setting.inventory.index') }}">Inventory</a>
                        </li>
                        @endif
                        <li class="heading">Team</li>
                        <li>
                            <a href="{{ route('team.index') }}">Team Members</a>
                        </li>
                        <li>
                            <a href="{{ route('team.create') }}">Invite Member</a>
                        </li>
                        <!-- <li class="heading">Extensions</li> -->
                    </ul>
                </div>
                
                <div class="title">
                        <h2>Your Business Details</h2>
                    </div>
                <div class="container1">
                    
                    <form method="POST" action="{{ route('setting.business.update', $user->profile->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div style="padding-left: 65px;">
                            <label>Business name</label>
                            <input type="text" name="business_name" value="{{ $user->profile->business_name }}" >
                        
                        </div>
                        <hr>
                        <div style="padding-left: 65px;">
                            <label>Contact name</label>
                            <input type="text" name="contact_name" value="{{ $user->profile->contact_name }}" >
                            <span class="field-desc">This appears on quotes and invoices. Use your full name.</span>
                        </div>
                        <hr>
                        <div style="padding-left: 65px;">
                            <label>Company Registration Number</label>
                            <input type="text" name="company_number" value="{{ $user->profile->company_number }}"  >
                            <span class="field-desc">This appears on quotes and invoices. Use your Company Registration Number.</span>
                        </div>
                        <hr>
                        <div style="padding-left: 65px;">
                            <label>VAT Number</label>
                            <input type="text" name="vat_number" value="{{ $user->profile->vat_number }}"  >
                            <span class="field-desc">This appears on quotes and invoices. Use your VAT Number.</span>
                        </div>
                        <hr>
                        <div style="padding-left: 65px;">
                            <label >Business address</label>
                            <textarea name="business_address" rows="4" cols="50"  >{{ $user->profile->business_address }}</textarea>
                            <span class="field-desc">This address is displayed on your quotes and invoices.</span>
                        </div>
                        <hr>
                        <div style="padding-left: 65px;">
                            <input type="submit" value="Save Business Details">
                        </div>
                    </form>   
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#flip").click(function() {
                $("#panel").slideToggle("slow");
            });
        });
    </script>
@endpush