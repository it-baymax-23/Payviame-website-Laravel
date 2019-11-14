@extends('layouts.app')

@section('title','Create')

@push('css')

@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('includes.partial.msg')
                    <div class="card">
                        <div class="card-header" data-background-color="purple">
                            <h4 class="title">{{ __('Add New Language') }}</h4>
                        </div>
                        <div class="card-content">
                            <form method="POST" action="{{ route('admin.lang.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">{{ __('Language Code') }}</label>
                                            <input type="text" class="form-control" name="code">
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('admin.lang.index',$user->profile->lang) }}" class="btn btn-danger">{{ __('Back') }}</a>
                                <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush