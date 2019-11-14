@extends('layouts.dashboard')

@php
$client_name = $client->business_name;
@endphp

@section('title', __('Edit') . '  ' . $client_name)

@push('stylesheets')
<link href="{{ asset('frontend/src/selectstyle.css') }}" rel="stylesheet" type="text/css">
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
    .selectstyle.ss_dib.light {
        float: none
        }
    div#side {
        top: 200px;
    }
</style>
@endpush

@section('content')

    
<div id="main">
    <div>
        <div id="page-head">
            <div class="page-title" style="padding-bottom: 69px;">
                <div class="container">
                    <h1>
                        <a href="{{route('client.index')}}">{{__('Clients')}}</a>
                        <i class="fa fa-angle-right"></i>
                        {{$client->business_name}}
                    </h1>
                </div>

            </div>
            <div class="clear"></div>
        </div>

        <div class="page-links">
            <div class="container">
                <div class="left-penal"></div>
                <div class="right-penal">   
                    <div style="position: relative;top: 0px;"> 
                        <ul class="nav nav-tabs page-tab">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('client.show',$client->id)}}">{{__('Tasks & Expenses')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{route('client.edit',$client->id)}}"><i class="fa fa-edit"></i> {{__('Edit Client')}}</a>
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
                <!-- show page Content-->
            <!--edit client-->
            <div id="menu2" class="container tab-pane active">
                <br>
                <div class="span-24 subview">
                    <div>
                        <form class="backbone client_form" id="save_change_client" method="POST" action="{{ route('client.update',$client->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="span-18 mt-4">
                                <div class="form myclients">
                                    <div>
                                        <div class="box settings top">
                                            <div class="title">
                                                <h2>{{__('Client Details')}}</h2>
                                            </div>
                                            <div class="pt-3"></div>
                                            <div class="option_label2">
                                                <label for="business_name">{{__('Business name')}}</label>
                                            </div>
                                            <div class="option_field2">
                                                <input id="business_name" type="text" name="business_name" value="{{ $client->business_name }}" required>
                                            </div>
                                            <div class="clear"></div>
                                            <hr>
                                            <div class="option_label2">
                                                <label for="billing_contact_name">{{__('Contact name')}}</label>
                                            </div>
                                            <div class="option_field2">
                                                <input id="billing_contact_name" type="text" name="contact_name" value="{{ $client->contact_name }}" required>
                                                <div class="field-desc">{{__('Who do you address your invoices to?')}}</div>
                                            </div>
                                            <div class="clear"></div>
                                            <hr>
                                            <div class="option_label2">
                                                <label for="billing_email_address">{{__('Email address')}}</label>
                                            </div>
                                            <div class="option_field2">
                                                <input id="billing_email_address" type="email" name="email_address" value="{{ $client->email_address }}" required>
                                                <span class="field-desc">{{__('What email address do you send your invoices to? You can add multiple email addresses here, separated by commas.')}}</span>
                                            </div>
                                            <div class="clear"></div>
                                            <hr>
                                            <div class="option_label2">
                                                <label for="billing_address">{{__('Address')}} &amp; {{__('details')}}</label>
                                            </div>
                                            <div class="option_field2">
                                                <textarea id="billing_address" rows="6" style="width: 250px" name="address_detail" placeholder="123 Main Street City, State">{{ $client->address_detail }}</textarea>
                                                <span class="field-desc">{{__('This information is displayed on invoices. You may add other information (like tax IDs) here, too.')}}</span>
                                            </div>
                                        </div>
                                        <!-- <div class="clear"></div>
                                        <hr class="space">
                                        <div class="box settings top">
                                            <div class="title">
                                                <h2>{{__('Billing Preferences')}}</h2>
                                            </div>
                                            <div class="option_label2">
                                                <label for="currency_id">Billing currency</label>
                                            </div>
                                            <div class="option_field2" style="margin-top: 10px" >
                                            
                                                <select id="js-example-basic-single" class="form-20 js-example-basic-single" name="currency_id">
                                                    @foreach($currencies as $currency)
                                                    <option value="{{ $currency->id }}" <?php echo ($currency->id == $client->currency_id) ? 'selected' : '' ?>>{{ $currency->currency_description }} ({{ $currency->currency_code }}&nbsp;{{ $currency->currency_symbol }})</option>
                                                    @endforeach
                                                </select>
                                            
                                                <div class="field-desc">
                                                    Changing this currency will also change the currency for all existing invoices, tasks, expenses, and time logs for this client
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                            <hr>
                                            <div class="option_label2">
                                                <label for="hourly_rate">Hourly rate</label>
                                            </div>
                                            <div class="option_field2">
                                                <input class="form-5" id="hourly_rate" type="text" value="$50">
                                                <span class="field-desc">What's your regular hourly rate for this client? You can change this on individual tasks if you need to.</span>
                                            </div>
                                            <div class="clear"></div>
                                            <hr>
                                            <div class="option_label2">
                                                <label for="locale">Invoice language</label>
                                            </div>
                                            <div class="option_field2">
                                                <div class="select2-container w-50 float-left" id="s2id_locale">
                                                    <select class="inline_input invalid select-action client-select" placeholder="Business name" data-search="true" style="position: relative;">
                                                        <option value="BO">Bolivia, Plurinational State of</option>
                                                        <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                                        <option value="BA">Bosnia and Herzegovina</option>
                                                        <option value="BW">Botswana</option>
                                                        <option value="BV">Bouvet Island</option>
                                                        <option value="BR">Brazil</option>
                                                        <option value="IO">British Indian Ocean Territory</option>
                                                        <option value="BN">Brunei Darussalam</option>
                                                        <option value="BG">Bulgaria</option>
                                                        <option value="BF">Burkina Faso</option>
                                                        <option value="BI">Burundi</option>
                                                        <option value="KH">Cambodia</option>
                                                        <option value="CM">Cameroon</option>
                                                        <option value="CA">Canada</option>
                                                        <option value="CV">Cape Verde</option>
                                                        <option value="KY">Cayman Islands</option>
                                                        <option value="CF">Central African Republic</option>
                                                        <option value="TD">Chad</option>
                                                        <option value="CL">Chile</option>
                                                        <option value="CN">China</option>
                                                        <option value="CX">Christmas Island</option>
                                                    </select>
                                                </div>
                                                <div class="w-50 float-left">
                                                    <div class="last span-12">
                                                        <input class="form-5 hide" id="shortname" type="text" value="">
                                                    </div>
                                                </div>
                                                <span class="field-desc">
                                                    Changing the invoice language will also change the language for all existing invoices for this client.
                                                    <br>
                                                    Want to see your language here? Drop us a line and we'll get onto it.
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <hr>
                                            <div class="option_label2">
                                                <label for="shortname">Invoice numbering</label>
                                            </div>
                                            <div class="option_field2">
                                                <div class="span-24">
                                                    <div class="span-12 float-left">
                                                        <select class="inline_input invalid select-action client-select" placeholder="Business name" data-search="true" style="position: relative;">
                                                            <option value="BO">Bolivia, Plurinational State of</option>
                                                            <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                                            <option value="BA">Bosnia and Herzegovina</option>
                                                            <option value="BW">Botswana</option>
                                                            <option value="BV">Bouvet Island</option>
                                                            <option value="BR">Brazil</option>
                                                            <option value="IO">British Indian Ocean Territory</option>
                                                            <option value="BN">Brunei Darussalam</option>
                                                            <option value="BG">Bulgaria</option>
                                                            <option value="BF">Burkina Faso</option>
                                                            <option value="BI">Burundi</option>
                                                            <option value="KH">Cambodia</option>
                                                            <option value="CM">Cameroon</option>
                                                            <option value="CA">Canada</option>
                                                            <option value="CV">Cape Verde</option>
                                                            <option value="KY">Cayman Islands</option>
                                                            <option value="CF">Central African Republic</option>
                                                            <option value="TD">Chad</option>
                                                            <option value="CL">Chile</option>
                                                            <option value="CN">China</option>
                                                            <option value="CX">Christmas Island</option>
                                                        </select>

                                                    </div>
                                                    <div class="last span-12 float-left ml-5">
                                                        <input class="form-5 hide" id="shortname" type="text" value="">
                                                    </div>
                                                </div>
                                                <span class="field-desc">
                                                    Invoice numbers are generated sequentially per prefix. Eg: abc-001, abc-002 &amp; xyz-001, xyz-002
                                                    <br>
                                                    If you prefer plain invoices numbers (001, 002, 003) choose "No prefix".
                                                    <a href="#">Learn more</a>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                            <hr>
                                            <div class="option_label2">
                                                <label for="invoicing_threshold">Invoicing threshold</label>
                                            </div>
                                            <div class="option_field2">
                                                <input class="form-5" id="invoicing_threshold" type="text" value="$1,000" data-behaviour="currency_input" data-currency-sign="$">
                                                <span class="field-desc">Remind me to invoice this client when I exceed this amount of unbilled work.</span>
                                            </div>
                                        </div> -->
                                        <div class="clear"></div>
                                        <hr class="space">
                                        <div class="box settings top">
                                            <div class="title">
                                                <h2>Paydirt Identity</h2>
                                            </div>
                                            <div class="info setting_description">
                                                <p>Paydirt uses a badge for each client so that you spot them at a glance. Upload your client's logo, or create a simple monogram.</p>
                                            </div>
                                            <hr class="space">
                                            <div class="option_label2">
                                                <label for="color">Color</label>
                                            </div>
                                            <div class="option_field2">
                                                
                                                <div id="color-picker-component" class="input-group colorpicker-component">
                                                    <input type="text" id="monogram_color" name="monogram_color" value="{{ $client->monogram_color }}" class="form-control"/>
                                                    <span class="input-group-addon" style="margin-top: 15px"><i></i></span>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                            <hr>
                                            <div class="option_label2" id="badge_type">
                                                <input id="monogram_radio" type="radio" name="badge_type" value="monogram" checked="">
                                                <label for="monogram_radio">Use a monogram</label>
                                                <hr class="clear space">
                                                <input id="logo_radio" type="radio" name="badge_type" value="logo">
                                                <label for="logo_radio">Upload an images</label>
                                            </div>
                                            <div class="option_field2">
                                                <div class="span-10">
                                                    <div id="monogram_selector" style="display: block;">
                                                        <input type="text" id="monogram" class="form-3" name="monogram_name" maxlength="2" value="{{ $client->monogram_name }}">
                                                        <div class="badge big" style="background-color: {{ $client->monogram_color }}">{{ $client->monogram_name }}</div>
                                                    </div>
                                                    <div id="logo_selector" style="display: block;">
                                                        <input id="logo" type="file" name="client_logo" accept="image/jpeg,image/jpg,image/bmp,image/png">
                                                    </div>
                                                </div>
                                                <!-- <div class="span-1">&nbsp;</div>
                                                <div class="last span-13">
                                                    <div class="demo">
                                                        <div class="badge big" style="background-color: #39d0b9">ab</div>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="last span-6" style="position: relative;">
                            <div class="fixed" id="side">
                                <div class="follow">
                                    <input class="massive" type="submit" value="Save changes" onclick="document.getElementById('save_change_client').submit()">
                                    <span class="cancel">
                                        or
                                        <a class="cancel" href="{{route('client.index')}}" data-behaviour="backbone_link">{{__('Cancel')}}</a>
                                    </span>
                                    <hr class="clear space">
                                    @if ($client->client_status == 0)
                                    <a class="action archive right" href="javascript:;" onclick="(confirm('Are you sure you want to move this client to your list of archived clients, and mark all of their tasks as finished?')?document.getElementById('archieve-form-{{$client->id}}').submit(): '');">
                                    {{__('Archive Client')}}
                                    </a>
                                    <form id="archieve-form-{{$client->id}}" action="{{ route('client.archived.update',$client->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('PUT')
                                    </form>
                                    @else
                                    <a class="action archive right" href="javascript:;" onclick="(confirm('Are you sure you want to move this client to your list of unarchived clients?')?document.getElementById('archieve-form-{{$client->id}}').submit(): '');">
                                    {{__('Unarchive Client')}}
                                    </a>
                                    <form id="archieve-form-{{$client->id}}" action="{{ route('client.unarchived.update',$client->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('PUT')
                                    </form>
                                    @endif
                                    <hr class="clear space">
                                    <a class="delete_client destroy right" href="javascript:;" onclick="(confirm('Deleting this client will also remove all tasks, expenses, quotes, invoices and time logs associated with it. Are you sure you want to delete it?')?document.getElementById('delete-form-{{$client->id}}').submit(): '');">{{__('Delete Client')}}</a>
                                    <form id="delete-form-{{$client->id}}" action="{{ route('client.destroy',$client->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<!-- <script src="{{ asset('frontend/src/selectstyle.js') }}"></script> -->
<script>
        // jQuery(document).ready(function($) {
        //   $('select').selectstyle({
        //     width  : 400,
        //     height : 300,
        //     theme  : 'light',
        //     onchange : function(val){}
        //   });
        // });
        //   var _gaq = _gaq || [];
        //   _gaq.push(['_setAccount', 'UA-36251023-1']);
        //   _gaq.push(['_setDomainName', 'jqueryscript.net']);
        //   _gaq.push(['_trackPageview']);

        //   (function() {
        //     var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        //     ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        //     var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        //   })();


        // google_ad_client = "ca-pub-2783044520727903";
        // /* jQuery_demo */
        // google_ad_slot = "2780937993";
        // google_ad_width = 728;
        // google_ad_height = 90;

</script>
<script> 
  $(document).ready(function() {
    $('#js-example-basic-single').select2();

    $("#flip").click(function(){
      $("#panel").slideToggle("slow");
    });
  });
</script>
<script>
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
</script>

<script>
  $(function () {
      $('#color-picker-component').colorpicker();
  });
</script>
<script type="text/javascript">
    $('#monogram_color').change(function(){
        var monogram_color = $(this).val();
        console.log(monogram_color);
        $('.big').attr('style','background-color:' + monogram_color);
    })
    $('#monogram').change(function(){
        var monogram_name = $(this).val();
        console.log(monogram_name);
        $('.big').html(monogram_name);
    })
</script>
@endpush