@extends('layouts.app')

@section('title','Add Currency')

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
                            <h4 class="title">Add New Currency</h4>
                        </div>
                        <div class="card-content">
                            <form method="POST" action="{{ route('admin.currency.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Currency Code</label>
                                            <input type="text" class="form-control" name="currency_code">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Currency Symbol</label>
                                            <input type="text" class="form-control" name="currency_symbol">
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Currency Rate</label>
                                            <input type="number" class="form-control" name="currency_rate" value="1" min="0.01" step="0.01">
                                        </div>
                                    </div> -->
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Currency Description</label>
                                            <input type="text" class="form-control" name="currency_description">
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('admin.currency.index') }}" class="btn btn-danger">Back</a>
                                <button type="submit" class="btn btn-primary">Save</button>
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