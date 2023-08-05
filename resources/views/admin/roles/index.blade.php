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
    <div class=" mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            <h1>Roles</h1>
        </div>
        <div class="card-body">
            <a href="{{ route('roles.create') }}" class="btn btn-primary add-list my-2"><i class="las la-plus mr-3"></i>Add
                Roles</a>
            <table id="list" class="table table-striped" style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td style="display: flex;gap: 10px ">



                            <a href="{{ route('roles.edit', $item) }}"><button class="btn btn-success px-4 py-2">Edit</button></a>

                            <button class="btn btn-danger px-4 py-2"
                                    onclick="
                                        if (confirm('Are you sure?')) {
                                        document.getElementById('item-{{ $item->id }}').submit();
                                        }
                                        ">Xóa
                            </button>

                            <form action="{{ route('roles.destroy', $item) }}"
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
