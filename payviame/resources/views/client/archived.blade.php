@extends('layouts.dashboard')

@section('title', __('Clients'))

@push('stylesheets')
    <link href="{{ asset('frontend/src/selectstyle.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
@endpush

@section('content')

    <div id="main">
        <div>
            <div id="page-head">
                <div class="page-title">
                    <div class="container">
                        <h1>
                            <a href="javascript:;">{{__('Clients')}}</a>
                        </h1>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="page-links">
                <div class="container">
                    <div class="left-penal">     
                        <div id="flip" class="flip-in" style="width: 127px;">{{__('Add a Client')}}</div>
                        <div id="panel">
                            <form class="dropdown_inline_form" method="POST">
                                @csrf
                                <h4 class="action-bar">{{__('New Client')}}</h4>
                                <!-- <select class="form-20 inline_input invalid select-action" placeholder="Business name" data-search="true">
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
                                </select> -->
                                <input type="text" name="business_name" class="form-20 inline_input invalid select-action" required>
                                <button class="flip-inner" id="client_store" type="submit" attr-url="{{ route('client.store', 'store') }}">
                                    {{__('Add Client')}}
                                </button>
                                <div class="or">or</div>
                                <button class="flip-inner" id="client_edit" type="submit" attr-url="{{route('client.store','edit')}}">
                                    {{__('Add and edit details')}}
                                </button>
                            </form>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="right-penal">   
                        <div style="position: relative;top: -32px;"> 
                            <ul class="nav nav-tabs page-tab">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('client.index') }}">{{__('Current')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ route('client.archived') }}">{{__('Archived')}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>   
                <!-- Tab panes -->
            <div class="tab-content">
                
                <div id="menu2" class="container tab-pane active">
                    <br>
                    <div class="row mt-4">
                        <table id="example" class="table table-striped table-bordered mb-5"  width="100%">
                            <thead>
                                <tr>
                                    <th style="width: 32%;"></th>
                                    <th class="th-sm">{{__('Unbilled')}}<i class="fa fa-arrows-v"></i>
                                    </th>
                                    <th class="th-sm">{{__('Owing')}}<i class="fa fa-arrows-v"></i>
                                    </th>
                                    <th class="th-sm">{{__('Quoted')}}<i class="fa fa-arrows-v"></i>
                                    </th>
                                    <th class="th-sm">{{__('Invoiced')}}<i class="fa fa-arrows-v"></i>
                                    </th>
                                    <th class="th-sm">{{__('Status')}}<i class="fa fa-arrows-v"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $key=>$client)
                                <tr>
                                    <td style="vertical-align: middle;height: 45px; border-bottom: 1px grey solid">
                                        <div class="client-business-name">
                                            <a href="{{route('client.show',$client->id)}}">
                                                <div class="badge " style="background-color: {{ $client->monogram_color }}">{{ $client->monogram_name}}</div>
                                                {{ $client->business_name }}
                                            </a>
                                        </div>
                                    </td>
                                    <td style="vertical-align: middle;height: 45px; border-bottom: 1px grey solid">-</td>
                                    <td style="vertical-align: middle;height: 45px; border-bottom: 1px grey solid">-</td>
                                    <td style="vertical-align: middle;height: 45px; border-bottom: 1px grey solid">-</td>
                                    <td style="vertical-align: middle;height: 45px; border-bottom: 1px grey solid">-</td>
                                    <td style="vertical-align: middle;height: 45px; border-bottom: 1px grey solid">Completed</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>

@endsection

@push('scripts')

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
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

        $('#example').dataTable( {
            language: {
                searchPlaceholder: "Search for a Client"
            },
            ordering: false,
        } ); 
        $(document).ready(function() {
            $('#example').DataTable();
        } );

        $(document).ready(function(){
          $("#flip").click(function(){
            $("#panel").slideToggle("slow");
          });
        });

        $('#client_store').click(function(){
            var action_url = $(this).attr('attr-url');
            $('.dropdown_inline_form').attr('action',action_url);
        });

        $('#client_edit').click(function(){
            var action_url = $(this).attr('attr-url');
            $('.dropdown_inline_form').attr('action',action_url);
        });
    </script>
@endpush