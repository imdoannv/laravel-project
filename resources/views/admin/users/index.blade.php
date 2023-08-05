@extends('admin.layout.layout')
@section('content')
    <div class=" mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
           <h1>Users</h1>
        </div>
        <div class="card-body">
            <a href="{{ route('users.create') }}" class="btn btn-primary add-list my-2"><i class="las la-plus mr-3"></i>Add
                User</a>
            <table id="list" class="table table-striped" style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key +1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->role->name }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ md5($item->password) }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->address }}</td>
                        <td style="display: flex; gap : 10px">

                            <a href="{{ route('users.edit', $item) }}"><button class="btn btn-success px-4 py-2">Edit</button></a>

                            <button class="btn btn-danger px-4 py-2"
                                    onclick="
                                        if (confirm('Are you sure?')) {
                                        document.getElementById('item-{{ $item->id }}').submit();
                                        }
                                        ">Xóa
                            </button>

                            <form action="{{ route('users.destroy', $item) }}"
                                  id="item-{{ $item->id }}"
                                  method="post">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>
    </div>
@endsection