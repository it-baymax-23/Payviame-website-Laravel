@extends('layouts.app')

@section('title','Dashboard')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('includes.partial.msg')
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Filter Company</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option value="0">Any Company</option>
                            @foreach($accounts as $account)
                            <option value="{{ $account->id }}" <?php echo ($account->id == $accountID) ? 'selected' : '' ?>>{{ $account->user->profile->business_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Filter Currency</label>
                        <select class="form-control" id="exampleFormControlSelect2">
                            @foreach($currencies as $currency)
                            <option value="{{ $currency->id }}" <?php echo ($currency->id == $current_currency->id) ? 'selected' : '' ?>>{{ $currency->currency_description }} ({{ $currency->currency_code }}&nbsp;{{ $currency->currency_symbol }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="orange">
                                    <i class="material-icons">library_books</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">{{ __('Total Quotes') }}</p>
                                    <h3 class="title">{{ $quoteCount }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="green">
                                    <i class="material-icons">info_outline</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">{{ __('DRAFTED') }}</p>
                                    <h3 class="title">{{$current_currency->currency_symbol}} {{$draft_total_sum}} {{$current_currency->currency_code}}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="red">
                                    <i class="material-icons">info_outline</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">{{ __('SENT') }}</p>
                                    <h3 class="title">{{$current_currency->currency_symbol}} {{$sent_total_sum}} {{$current_currency->currency_code}}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="green">
                                    <i class="material-icons">info_outline</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">{{ __('ACCEPTED') }}</p>
                                    <h3 class="title">{{$current_currency->currency_symbol}} {{$accepted_total_sum}} {{$current_currency->currency_code}}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="red">
                                    <i class="material-icons">info_outline</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">{{ __('DECLINED') }}</p>
                                    <h3 class="title">{{$current_currency->currency_symbol}} {{$declined_total_sum}} {{$current_currency->currency_code}}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="blue">
                                    <i class="material-icons">info_outline</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">{{ __('TOTAL Amount') }}</p>
                                    <h3 class="title">{{$current_currency->currency_symbol}} {{$total_sum}} {{$current_currency->currency_code}}
                                    </h3>
                                </div>
                            </div>
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
        $('#exampleFormControlSelect1').change(function(){
            var account_id = $('option:selected', this).val();
            var currency_id = $('option:selected', '#exampleFormControlSelect2').val();
            if (currency_id == 0)
                currency_id = 1;
            url = '{{config('app.url')}}' + '/admin/quote/' + account_id + '/' + currency_id;
            window.location.href = url;
        })
        $('#exampleFormControlSelect2').change(function(){
            var currency_id = $('option:selected', this).val();
            var account_id = $('option:selected', '#exampleFormControlSelect1').val();
            if (currency_id == 0)
                currency_id = 1;
            url = '{{config('app.url')}}' + '/admin/quote/' + account_id + '/' + currency_id;
            window.location.href = url;
        })
    </script>
@endpush