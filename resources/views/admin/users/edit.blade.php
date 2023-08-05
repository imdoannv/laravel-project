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
                <h4 class="card-title">Edit User</h4>
            </div>
        </div>
        <div class="card-body">
    <form id="edit" action="{{ route('users.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <div class="col-md-6">
        <div class="form-group"  >
            <label class="card-title">Name</label>
            <input type="text" value="{{$data -> name}}" class="form-control" id="name" name="name"  placeholder="name">
        </div>

        <div class="form-group">
            <label class="card-title">Role</label>
            {{$data->role->id}}
            <select class="form-control" id="role_id" name="role_id">
                @foreach($roles as $role)
                    <option value="{{$role->id}}" <?= $data->role->id == $role->id ? 'selected' : '' ?>>{{$role->name}}</option>
                @endforeach

            </select>
        </div>

        <div class="form-group">
            <label class="card-title">User Name</label>
            <input type="text" value="{{$data -> username}}" class="form-control" id="username" name="username" placeholder="Image">
        </div>
        </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
        <div class="form-group">

            <input type="hidden" value="{{$data -> password}}" class="form-control" id="password" name="password" placeholder="Image">
        </div>

        <div class="form-group">
            <label class="card-title">Email</label>
            <input type="text" value="{{$data -> email}}" class="form-control" id="email" name="email" placeholder="Image">
            <br>
        </div>

        <div class="form-group">
            <label class="card-title">Address</label>
            <input type="text" value="{{$data -> address}}" class="form-control" id="address" name="address" placeholder="Image">
        </div>
        </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
        </div>
    </div>
@endsection
