@extends('layouts.app')

@section('title','Users')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('admin.user.create')}}" class="btn btn-primary">{{__('Add New')}}</a>
                    @include('includes.partial.msg')
                    <div class="card">
                        <div class="card-header" data-background-color="purple">
                            <h4 class="title">{{__('All User')}}</h4>
                        </div>
                        <div class="card-content table-responsive">
                            <table id="table" class="table"  cellspacing="0" width="100%">
                                <thead class="text-primary">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Membership</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach($users as $key=>$cursor_user)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $cursor_user->name }}</td>
                                            <td>{{ $cursor_user->email }}</td>
                                            <td>{{ $cursor_user->role->role_name }}
                                            </td>
                                            <td>@if(!isset($cursor_user->membership_id))
                                                    None
                                                @else
                                                    {{ $cursor_user->membership->membership_name }}
                                                @endif
                                            </td>
                                            <td>@if($cursor_user->active == 0)
                                                    Not Active
                                                @else
                                                    Active
                                                @endif
                                            </td>
                                            <td>{{ $cursor_user->created_at }}</td>
                                            <td>{{ $cursor_user->updated_at }}</td>
                                            <td>
                                                @if($cursor_user->role_id == 1)
                                                <a href="{{ route('admin.user.edit',$cursor_user->id) }}" class="btn btn-info btn-sm"><i class="material-icons">mode_edit</i></a>
                                                @endif

                                                <form id="delete-form-{{$cursor_user->id}}" action="{{ route('admin.user.destroy',$cursor_user->id) }}" style="display: none;" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? You want to delete this?')){
                                                    event.preventDefault();
                                                    document.getElementById('delete-form-{{$cursor_user->id}}').submit();
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