@extends('layouts.dashboard')

@section('title', __('Team'))

@push('stylesheets')
    <style type="text/css">
        .btn-info{
            background: #387087;
            border: 1px solid #2d5b6e;
        }
        #middle {
            padding: 30px 50px;
            background: transparent;
        }
        .user {
            background-color: #fff;
            border-radius: 3px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            position: relative;
            float: left;
            margin: 0 15px 15px 0;
            width: 250px;
            padding: 20px;
            box-sizing: border-box;
            border-radius: 3px;
            height: 300px;
        }
        a.user-add:after, .user:after {
            content: " ";
            display: block;
            height: 0;
            clear: both;
            visibility: hidden;
            overflow: hidden;
        }
        .ribbon-wrapper {
            width: 100px;
            height: 100px;
            overflow: hidden;
            position: absolute;
            top: -3px;
            right: -3px;
        }
        .ribbon-wrapper .ribbon {
            text-align: center;
            position: relative;
            padding: 0;
            top: 14px;
            right: -10px;
            width: 120px;
            height: 32px;
            line-height: 32px;
            transform: rotate(45deg);
            background-color: #579db9;
            color: white;
            box-shadow: 0px 0px 3px rgba(0,0,0,0.3);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .ribbon-wrapper .ribbon:before {
            left: 0;
        }
        .ribbon-wrapper .ribbon:after {
            right: 0;
        }
        .ribbon-wrapper .ribbon:before, .ribbon-wrapper .ribbon:after {
            content: "";
            border-top: 3px solid #39738a;
            border-left: 3px solid transparent;
            border-right: 3px solid transparent;
            position: absolute;
            bottom: -3px;
        }
        .t-center {
            text-align: center !important;
        }
        .user .avatar {
            margin: 0 0 15px 0;
        }
        .avatar.medium {
            width: 80px;
            height: 80px;
            border-radius: 80px;
        }
        .avatar {
            vertical-align: middle;
            margin: -2px 5px 0 0;
            width: 26px;
            height: 26px;
            display: inline-block;
            overflow: hidden;
            position: relative;
        }
        .user .user-attr {
            margin: 0 0 5px 0;
            text-align: center;
        }
        .user .user-attr span, .user .user-attr h3 {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .user h3 {
            margin: 0 0 15px 0;
        }
        .grey {
            color: #919191;
        }
        .btn-group {
            display: inline-block;
        }
        .btn-group {
            position: relative;
            font-size: 0;
            vertical-align: middle;
            white-space: nowrap;
            *margin-left: .3em;
        }
        .btn-group.open .btn.dropdown-toggle {
            background-color: #f2f2f2;
            box-shadow: inset 0 0 3px rgba(0,0,0,0.1), inset 0 0 2px rgba(0,0,0,0.1);
            color: #326478;
        }
        .user ul.user-permissions {
            font-size: 12px;
        }
        .user li.user-permission {
            text-align: left;
            height: 30px;
            line-height: 30px;
        }
        a.user-add {
            background: rgba(255,255,255,0.3);
            box-shadow: 0 0 7px rgba(0,0,0,0.1);
            text-align: center;
            color: #aaa;
            font-size: 16px;
            padding-top: 15px;
            transition-property: all;
            transition-duration: 0.2s;
            transition-timing-function: ease;
        }

        a.user-add, .user {
            float: left;
            margin: 0 15px 15px 0;
            width: 250px;
            padding: 20px;
            box-sizing: border-box;
            border-radius: 3px;
            height: 300px;
        }
        a.user-add .icon {
            font-size: 95px;
            display: block;
            margin: 0 auto 70px auto;
            color: #ccc;
            transition-property: all;
            transition-duration: 0.2s;
            transition-timing-function: ease;
        }
        .icon-plus-sign:before {
            content: "\f055";
        }
        a.user-add:hover {
            background-color: #fff;
            border-radius: 3px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            color: #579db9;
        }
    </style>
@endpush

@section('content')

    <div id="main">
        <div id="page-head">
            <div class="page-title">
                <div class="container">
                    <h1><a href="#">Your Team</a></h1>
                </div>
            </div>
            <div class="page-links" style="background-color: rgba(0,0,0,0.03);">
                <div class="container">
                   <div class="btn-group dropdown">
                      <a href="{{ route('team.create')}}" role="button" class="btn btn-info  ">Add a team member</a>
                      <!-- <button  style="margin-left: -4px;" type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('team.create') }}">Quick-add your team</a>
                        <a class="dropdown-item" href="#">Import team from Trello</a>
                        <a class="dropdown-item" href="#">Import team from Basecamp</a>
                        <a class="dropdown-item" href="#">Import team from Redbooth</a>
                      </div> -->
                    </div>
                </div>
            </div>
        </div>

        <div id="middle">
            <div class="container">
                <div class="title">
                    <h2>Current Team Members</h2>
                </div>
                <div class="users-list">
                    @foreach ($teams as $team)
                        <div class="user">
                            <div class="ribbon-wrapper">
                                @if ($team->user->role_id == 1)
                                    <div class="ribbon ">Owner</div>
                                @elseif($team->user->role_id == 2)
                                    <div class="ribbon bg-danger">Admin</div>
                                @else
                                    <div class="ribbon bg-success">User</div>
                                @endif
                            </div>
                            <div class="t-center">
                                <div class="medium">
                                    @if(!isset($team->user->profile->user_avatar))
                                    <img src="https://s3.amazonaws.com/paydirt-uploads-production/avatars/815760/medium/33d0fd69c689236c1bca957feae17fb9?1562936010" alt="33d0fd69c689236c1bca957feae17fb9?1562936010">
                                    @else
                                    <img src="{{asset($team->user->profile->user_avatar)}}" alt="avatar" width="100" height="100">
                                    @endif
                                </div>
                            </div>
                            <div class="user-attr">
                                <h3>{{ $team->user->name }}</h3>
                            </div>
                            <div class="user-attr">
                                <span class="grey">
                                    {{ $team->user->email }}
                                    <br>
                                    &nbsp;
                                </span>
                            </div>
                            <div class="user-attr">
                                @if($team->user->role_id == 1)
                                <a href="javascript:;" class="btn " >
                                    Account Creator
                                </a>
                                @else
                                <div class="dropdown">
                                    <a href="javascript:;" class="btn dropdown-toggle" data-toggle="dropdown">
                                        Admin privileges
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <li class="user-permission text-center">
                                            <a class="dropdown-item" href="{{ route('team.changePermission', [$team->user_id, 2]) }}">Admin privilege</a>
                                        </li>
                                        <li class="user-permission text-center">
                                            <a class="dropdown-item" href="{{ route('team.changePermission', [$team->user_id, 3]) }}">User privilege</a>
                                        </li>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <hr class="both">
                            <div class="user-attr">
                                @if($team->user_id == $user->id)
                                    <a href="{{ route('setting.profile.index',$team->user->profile->id) }}">
                                        <i class="fa fa-pencil "></i>
                                        Edit My Settings
                                    </a>
                                @elseif($user->role_id == 1)
                                    <a href="{{ route('setting.profile.index',$team->user->profile->id) }}">
                                        <i class="fa fa-pencil "></i>
                                        Edit User
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <a class="user-add" href="{{ route('team.create') }}">
                        <i class="fa fa-plus-circle" style="font-size: 90px;"></i>
                        <div style="margin-top: 80px;">
                            add a new
                            <br>
                            team member
                        </div>
                    
                    </a>
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