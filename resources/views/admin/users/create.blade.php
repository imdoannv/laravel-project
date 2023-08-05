@extends('admin.layout.layout')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card mt-5">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Create User</h4>
            </div>
        </div>
        <div class="card-body">

            <form id="create" method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="row mb-3">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="card-title">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>

                        <div class="form-group">
                            <label class="card-title">Role</label>
                            <select class="form-control" name="role_id" name="role_id">
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label class="card-title">Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="card-title">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <div class="form-group">
                            <label class="card-title">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>

                        <div class="form-group">
                            <label class="card-title">Address</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                    </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@endsection
