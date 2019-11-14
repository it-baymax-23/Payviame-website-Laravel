@extends('layouts.app')

@section('title','Language')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('admin.lang.create',$user->profile->lang) }}" class="btn btn-primary">{{ __('Add New') }}</a>
                    @include('includes.partial.msg')

                    <div class="row">

                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="list-group">
                                        @foreach($user->profile->languages() as $lang)
                                            
                                            <a href="{{route('admin.lang.index', $lang)}}" class="list-group-item list-group-item-action @if($currentLang == $lang) active @endif" style="border: none;">
                                                {{Str::upper($lang)}}
                                            </a>
                                            
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-header card-header-tabs" data-background-color="purple">
                                  <div class="nav-tabs-navigation">
                                    <div class="nav-tabs-wrapper">
                                      <ul class="nav nav-tabs" data-tabs="tabs">
                                        <li class="nav-item">
                                          <a class="nav-link active" href="#labels" data-toggle="tab">
                                            {{ __('Labels')}}
                                            <div class="ripple-container"></div>
                                          </a>
                                        </li>
                                        <li class="nav-item">
                                          <a class="nav-link" href="#messages" data-toggle="tab">
                                            {{ __('Messages')}}
                                            <div class="ripple-container"></div>
                                          </a>
                                        </li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="{{ route('admin.lang.update', $currentLang) }}">
                                        @csrf
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="labels">
                                                <div class="row">
                                                    @foreach($arrLabel as $label => $value)
                                                    <div class="col-lg-4 col-lg-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">{{$label}}</label>
                                                            <input type="text" class="form-control" name="label[{{$label}}]" value="{{$value}}">
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="messages">
                                                @foreach($arrMessage as $fileName => $fileValue)
                                                    <div class="row">
                                                        <div class="col-lg-10 col-lg-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                                                            <h3>{{ucfirst($fileName)}}</h3>
                                                        </div>
                                                        @foreach($fileValue as $label => $value)
                                                            @if(is_array($value))
                                                                @foreach($value as $label2 => $value2)
                                                                    @if(is_array($value2))
                                                                        @foreach($value2 as $label3 => $value3)
                                                                            @if(is_array($value3))
                                                                                @foreach($value3 as $label4 => $value4)
                                                                                    @if(is_array($value4))
                                                                                        @foreach($value4 as $label5 => $value5)
                                                                                            <div class="col-lg-4 col-lg-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                                                                                                <div class="form-group label-floating  mb-3">
                                                                                                    <label class="control-label">{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}.{{$label4}}.{{$label5}}</label>
                                                                                                    <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}][{{$label4}}][{{$label5}}]" value="{{$value5}}">
                                                                                                </div>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    @else
                                                                                        <div class="col-lg-4 col-lg-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                                                                                            <div class="form-group label-floating  mb-3">
                                                                                                <label class="control-label">{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}.{{$label4}}</label>
                                                                                                <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}][{{$label4}}]" value="{{$value4}}">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endforeach
                                                                            @else
                                                                                <div class="col-lg-4 col-lg-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                                                                                    <div class="form-group label-floating  mb-3">
                                                                                        <label class="control-label">{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}</label>
                                                                                        <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}]" value="{{$value3}}">
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                    @else
                                                                        <div class="col-lg-4 col-lg-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                                                                            <div class="form-group label-floating  mb-3">
                                                                                <label class="control-label">{{$fileName}}.{{$label}}.{{$label2}}</label>
                                                                                <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}]" value="{{$value2}}">
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                <div class="col-lg-4 col-lg-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                                                                    <div class="form-group label-floating  mb-3">
                                                                        <label class="control-label">{{$fileName}}.{{$label}}</label>
                                                                        <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}]" value="{{$value}}">
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit" style="margin-left: 20px">{{ __('Save')}}</button>
                                    </form>
                                </div>
                            </div>
                            <!-- end card-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        } );
    </script>
@endpush