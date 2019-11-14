@extends('layouts.dashboard')

@php
$client_name = $client->business_name;
@endphp

@section('title', $client_name)

@push('stylesheets')
    <link href="{{ asset('frontend/src/selectstyle.css') }}" rel="stylesheet" type="text/css">
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
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
                                <a class="nav-link active" href="{{route('client.show',$client->id)}}">{{__('Overview')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('client.edit',$client->id)}}"><i class="fa fa-edit"></i> {{__('Edit Client')}}</a>
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
            <div id="home" class="container tab-pane active">
                <div class="position-relative"> 
                    <div class="left-ot span-11">   
                        <a class="flip-inner" href="{{ route('quote.create', $client->id) }}">{{__('New Quote')}}</a>
                        <a class="flip-inner" href="{{ route('quote.new', $client->id) }}">{{__('New Invoice')}}</a>
                        <div class="clear"></div>   
                         
                    </div>
                </div>
                <div class="span-24">
                    <div class="mt-4 summary-row">
                        <div class="span-5">
                            <div class="summary-heading">
                                <a href="#">{{__('Unbilled')}}</a>
                            </div>
                            <div class="currency-summary">
                                <span>$0</span>
                                <small class="grey">USD</small>
                            </div>
                        </div>
                        <div class="span-5">
                            <div class="summary-heading">
                                <a href="#">{{__('Unbilled')}}</a>
                            </div>
                            <div class="currency-summary">
                                <span>$0</span>
                                <small class="grey">USD</small>
                            </div>
                        </div>
                        <div class="span-5">
                            <div class="summary-heading">
                                <a href="#">{{__('Unbilled')}}</a>
                            </div>
                            <div class="currency-summary">
                                <span>$0</span>
                                <small class="grey">USD</small>
                            </div>
                        </div>
                        <div class="span-5">
                            <div class="summary-heading">
                                <a href="#">{{__('Unbilled')}}</a>
                            </div>
                            <div class="currency-summary">
                                <span>$0</span>
                                <small class="grey">USD</small>
                            </div>
                        </div>
                        <div class="last span-4">
                            <div class="summary-heading">
                                <a href="#">{{__('Unbilled')}}</a>
                            </div>
                            <div class="currency-summary">
                                <span>$0</span>
                                <small class="grey">USD</small>
                            </div>
                        </div>
                        <div class="clear"></div>       
                    </div>
                    <div class="clear"></div>       
                </div>
                <div class="clear"></div>       
            </div>
            <!--edit client-->
                <!-- edit page Content-->
        </div>
    </div>
</div>
<div class="clear"></div>

@endsection

@push('scripts')

    <script src="{{ asset('frontend/src/selectstyle.js') }}"></script>
    <script>
        jQuery(document).ready(function($) {
          $('select').selectstyle({
            width  : 400,
            height : 300,
            theme  : 'light',
            onchange : function(val){}
          });
        });
          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-36251023-1']);
          _gaq.push(['_setDomainName', 'jqueryscript.net']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();


        google_ad_client = "ca-pub-2783044520727903";
        /* jQuery_demo */
        google_ad_slot = "2780937993";
        google_ad_width = 728;
        google_ad_height = 90;

    </script>
    <script> 
    $(document).ready(function(){
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
@endpush