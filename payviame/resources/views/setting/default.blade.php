@extends('layouts.dashboard')

@section('title', __('Quote and Invoice Default'))

@push('stylesheets')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
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
          width: 50%;
          padding: 12px 20px;
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
        .title-tax{
            height: 55px;
            line-height: 45px;
            padding: 15px;
            background-color: #fcfaf8;
            border: 1px solid rgba(0,0,0,0.06);
            border-width: 0 0 1px 0;
            border-radius: 3px 3px 0 0;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.5);
            margin-left: 252px;
            margin-top: 30px;
        }
        .setting_description {
            border: 1px solid #bfe4f4;
            border-width: 1px 0;

            margin-left: 252px;
        }

        .setting_description, .setting_description p{
            margin-bottom: 0px !important;
        }

        .fifteen {
            padding: 15px;
            margin-left: 252px;
            background-color: #ffffff;
        }
        .span-6 {
            min-height: 1px;
            float: left;
            width: 23.5%;
            margin: 0 2% 0 0;
        }
        .span-4 {
            min-height: 1px;
            float: left;
            width: 15%;
            margin: 0 2% 0 0;
        }
        .span-14 {
            min-height: 1px;
            float: left;
            width: 57.5%;
            margin: 0 2% 0 0;
        }

        .app-wid{
            width: 40% !important;
            float: left;
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
                        <li>
                            <a href="{{ route('setting.business.detail') }}">Business Details</a>
                        </li>
                        <li>
                            <a href="{{ route('report.membership') }}">Membership Plans</a>
                        </li>
                        <li class="heading">Invoices &amp; Quotes</li>
                        <li class="current">
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
                    <h2>Your Settings</h2>
                </div>

                <div class="container1">
                    
                    <form method="POST" action="{{ route('setting.default.update', $user->profile->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div style="padding-left: 65px;">
                            <label style="display: block;" >Primary currency</label>
                            <select id="js-example-basic-single" class="form-20 js-example-basic-single" name="currency_id">
                                @foreach($currencies as $currency)
                                <option value="{{ $currency->id }}" <?php echo ($currency->id == $user->profile->currency_id) ? 'selected' : '' ?>>{{ $currency->currency_description }} ({{ $currency->currency_code }}&nbsp;{{ $currency->currency_symbol }})</option>
                                @endforeach
                            </select>
                            <span class="field-desc"> </span>
                        </div>
                        <hr>
                        <div style="padding-left: 65px;">
                            <label style="display: block;" >Payment terms</label>
                            <input type="number" name="payment_term" value="{{ $user->profile->payment_term }}" min="1" style="display: inline-flex; width: 10%;"><span style="display:inline-flex; margin-left: 10px; color: #888">days</span>
                            <span class="field-desc">You can override this default on any invoice.</span>
                        </div>
                        <hr>
                        <div style="padding-left: 65px;">
                            <label >Invoice footer</label>
                            <textarea rows="4" cols="50" name="invoice_footer">{{ $user->profile->invoice_footer }}</textarea>
                            <span class="field-desc">Included on the bottom of your invoices. You might include your bank account details or other payment preferences.</span>
                        </div>
                        <hr>
                        <div style="padding-left: 65px;">
                            <label >Quote footer</label>
                            <textarea rows="4" cols="50" name="quote_footer">{{ $user->profile->quote_footer }}</textarea>
                            <span class="field-desc">Included on the bottom of your quotes. You might include your terms and conditions or other fine print.</span>
                        </div>
                        <hr>
                        <div style="padding-left: 65px;">
                            <label for="lname">Logo</label>
                            <br>
                            @if(!isset($user->profile->company_logo))
                            <img src="{{asset('frontend/images/logo_here.png')}}" height="100">
                            @else
                            <img src="{{asset($user->profile->company_logo)}}" height="100">
                            @endif
                            <input type="file" name="company_logo" accept="image/*">
                            <span class="field-desc">Maximum logo width: 769px, height: 300px. Larger images will be resized.</span>
                        </div>
                        <hr>
                        <div style="padding-left: 65px;">
                            <input type="submit" value="Save My Settings">
                        </div>
                    </form>   
                </div>


                <div class="title-tax">
                    <h2 style="float: left;">Default Taxes</h2>
                    <button type="button" class="btn btn-success" style="float: right; font-size: 15px;" id="btn1" 
                    @if(count($taxes)==2)
                        disabled 
                    @endif
                    >Add Texes</button>
                </div>
                <div class="setting_description info">
                    <p>These taxes are automatically applied to new quotes and invoices. You can have up to 2 default taxes.</p>
                </div>
                <div class="pad fifteen clearfix">
                    <div class="clearfix">
                        <div class="span-14">
                            <label>Name</label>
                        </div>
                        <div class="span-4">
                            <label>Percentage</label>
                        </div>
                        <div class="span-4">&nbsp;</div>
                    </div>
                    <hr class="both">
                    @if(!(count($taxes)))
                    <div class="row-items" id="taxes">
                        <div class="empty hide" id="default1" style="display: block;">
                            <p>Your account doesn't have any default taxes.</p>
                        </div>
                    </div>
                    @else
                    @foreach($taxes as $tax)
                    <div class="clearfix content" onClick="show({{$tax->id}})" style="cursor: pointer;">
                        <div class="span-14">
                            <p>{{ $tax->tax_description }}</p>
                        </div>
                        <div class="span-4">
                            <p>{{ $tax->tax_percentage }}%</p>
                        </div>
                        <div class="span-4" style="float: right;">
                            <a href="javascript:;" class="exit{{$tax->id}}" style="float: right; display: none;" onClick="exit({{$tax->id}})"><i class="fa fa-times"></i>&nbsp;&nbsp;&nbsp;</a>
                            <a href="javascript:;" class="remove{{$tax->id}}" style="float: right; display: none;" onclick="(confirm('Are you sure? You want to delete it?')?document.getElementById('delete-form-{{$tax->id}}').submit(): '');"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;</a>
                              <form id="delete-form-{{$tax->id}}" action="{{ route('setting.tax.destroy', $tax->id) }}" method="POST" style="display: none;">
                                  @csrf
                                  @method('DELETE')
                              </form>
                            <a href="javascript:;" class="edit{{$tax->id}}" style="float: right; display: none;" onClick="edit({{$tax->id}})"><i class="fa fa-edit"></i>&nbsp;&nbsp;&nbsp;</a>
                        </div>
                        <div class="span-14">
                            <input type="text" name="edit_description" class="edit_desc_{{$tax->id}}" placeholder="Description" style="display: none;">
                        </div>
                        <div class="span-4">
                            <input type="number" min="0" name="edit_price" class="edit_price_{{$tax->id}}" style="display: none;">
                        </div>
                        <div class="span-4" style="float: right;">
                            <div class="action{{$tax->id}}" style="margin-top: 10px; float: right; display: none;">
                                <a href="javascript:;" class="cancel1" onClick="cancel({{$tax->id}})">Cancel</a>
                                <span>&nbsp;or&nbsp;</span>
                                <a href="javascript:;" class="btn btn-primary update{{$tax->id}}" style="font-size: 10px" onClick="update({{$tax->id}})">Update</a>
                            </div>
                        </div>
                        <br>
                    </div>
                    @endforeach
                    @endif
                    <p id="abc"></p>
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

            $("#flip").click(function(){
              $("#panel").slideToggle("slow");
            });
        });
    </script>
    <script>
        i=0;
       
        $(document).ready(function(){
          $('#btn1').click(function() {
            $('<div class="content_input"><div class="span-14"><input type="text" name="tax_description" class="tax_description" placeholder="Description"></div><div class="span-4"><input type="number" min="0" name="tax_percentage" class="tax_percentage" value="0"></div><div class="span-4" style="float: right;"><div style="margin-top: 10px; float: right;"><a href="javascript:;" id="cancel">Cancel</a><span>&nbsp;&nbsp;&nbsp;or&nbsp;&nbsp;&nbsp;</span><a href="javascript:;" class="btn btn-primary save_item" style="font-size: 10px">Save</a></div></div></div>').insertBefore('#abc');
            $(this).attr('disabled', true);
          });
        });

        $(document).on('click','#cancel',function(){
            $('.content_input').remove();
            $('#btn1').attr('disabled', false);
        })

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click','.save_item',function(e){
            e.preventDefault();
            var tax_description = $('.tax_description').val();
            var tax_percentage = $('.tax_percentage').val();
            $.ajax({
                type:'POST',
                url:'{{ url('/setting/tax_store') }}',
                data:{tax_description:tax_description, tax_percentage:tax_percentage},
                success:function(data){
                    toastr['success'](data.success,'Success');
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                }
            });
        })

        function update(id){

            var tax_description = $('.edit_desc_' + id).val();
            var tax_percentage = $('.edit_price_' + id).val();
            $.ajax({
                type:'POST',
                url:'{{ url('/setting/tax_update') }}',
                data:{id: id, tax_description: tax_description, tax_percentage: tax_percentage},
                success:function(data){
                    toastr['success'](data.success,'Success');
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                }
            });
        }

        function remove(id){
            
            $.ajax({
                type:'POST',
                url:'{{ url('/setting/tax_destroy') }}',
                data:{id: id},
                success:function(data){
                    toastr['success'](data.success,'Success');
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                }
            });
        }

        function exit(id){
            window.setTimeout(()=>{
                $('.edit' + id).hide();
                $('.remove' + id).hide();
                $('.exit' + id).hide();
                $('.action' + id).hide();
                $('.edit_desc_' + id).hide();
                $('.edit_price_' + id).hide();    
            },100)
            
            
            return false;
        }

        function show(id){
            $('.edit' + id).show();
            $('.remove' + id).show();
            $('.exit' + id).show();
        }

        function edit(id){
            $('.edit_desc_' + id).show();
            $('.edit_price_' + id).show();
            $('.action' + id).show();
        }

        function cancel(id){
            $('.action' + id).hide();
            $('.edit_desc_' + id).hide();
            $('.edit_price_' + id).hide();
        }


        
    </script>
@endpush