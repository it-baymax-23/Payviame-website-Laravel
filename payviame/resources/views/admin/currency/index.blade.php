@extends('layouts.app')

@section('title','Currencies')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('admin.currency.create')}}" class="btn btn-primary">{{__('Add New')}}</a>
                    @include('includes.partial.msg')
                    <div class="card">
                        <div class="card-header" data-background-color="purple">
                            <h4 class="title">{{__('All Currency')}}</h4>
                        </div>
                        <div class="card-content table-responsive">
                            <table id="table" class="table"  cellspacing="0" width="100%">
                                <thead class="text-primary">
                                    <th>ID</th>
                                    <th>Description</th>
                                    <th>Code</th>
                                    <th>Symbol</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach($currencies as $key=>$currency)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $currency->currency_description }}</td>
                                            <td>{{ $currency->currency_code }}</td>
                                            <td>{{ $currency->currency_symbol }}
                                            </td>
                                            <td>{{ $currency->created_at }}</td>
                                            <td>{{ $currency->updated_at }}</td>
                                            <td>
                                                
                                                <a href="{{ route('admin.currency.edit',$currency->id) }}" class="btn btn-info btn-sm"><i class="material-icons">mode_edit</i></a>

                                                <form id="delete-form-{{$currency->id}}" action="{{ route('admin.currency.destroy',$currency->id) }}" style="display: none;" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? You want to delete this?')){
                                                    event.preventDefault();
                                                    document.getElementById('delete-form-{{$currency->id}}').submit();
                                                }else {
                                                    event.preventDefault();
                                                        }"><i class="material-icons">delete</i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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