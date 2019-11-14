@extends('layouts.app')

@section('title','User')

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
                            <h4 class="title">Add New User</h4>
                        </div>
                        <div class="card-content">
                            <form method="POST" action="{{ route('admin.user.update',$currentUser->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group label-floating">
                                            <!-- <label class="control-label">Admin</label> -->
                                            <select class="form-control" name="role">
                                                <option {{ $currentUser->role_id == 1 ? 'selected' : '' }} value="1"> Account Creator </option>
                                                <!-- <option {{ $currentUser->role_id == 2 ? 'selected' : '' }} value="2"> Admin </option> -->
                                                <!-- <option {{ $currentUser->role_id == 3 ? 'selected' : '' }} value="3"> User </option> -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group label-floating">
                                            <!-- <label class="control-label">Status</label> -->
                                            <select class="form-control" name="active">
                                                <option {{ $currentUser->active == 0 ? 'selected' : '' }} value="0"> Not Activate </option>
                                                <option {{ $currentUser->active == 1 ? 'selected' : '' }} value="1"> Active </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group label-floating">
                                            <!-- <label class="control-label">Status</label> -->
                                            <select class="form-control" name="membership">
                                                <option {{ $currentUser->membership_id == null ? 'selected' : '' }}  value="0">NULL</option>
                                                @foreach($memberships as $membership)
                                                    <option {{ $membership->id == $currentUser->membership_id ? 'selected' : '' }}  value="{{ $membership->id }}">{{ $membership->membership_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ $currentUser->name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Email</label>
                                            <input type="email" class="form-control" name="email" value="{{ $currentUser->email }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label  class="control-label" for="password">New Password</label>
                                            <input id="password" name="password" type="text" class="form-control">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label  class="control-label" for="confirm-password">Confirm New Password</label>
                                            <input id="confirm-password" name="confirm-password" type="text" class="form-control">

                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('admin.user.index') }}" class="btn btn-danger">Back</a>
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