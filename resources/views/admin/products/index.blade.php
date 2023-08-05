@extends('admin.layout.layout')
@section('content')
    <div class="mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            <h1>Products</h1>
        </div>
        <div class="card-body">
            <a href="{{ route('products.create') }}" class="btn btn-primary add-list my-2"><i
                    class="las la-plus mr-3"></i>Add
                Product</a>
            <table id="list" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Description</th>
                        <th>Size</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item-> price }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ Str::limit($item->descrip, 50, '...') }}</td>
                        <td>{{ $item->size->name }}</td>
                        <td>
                            <img src="{{ asset($item->images->img1) }}" alt="Image 1" width="35px" height="35px">
                            @if($item->images->img2)
                                <img src="{{ asset($item->images->img2) }}" alt="Image 2" width="35px" height="35px">
                            @endif
                            @if($item->images->img3)
                                <img src="{{ asset($item->images->img3) }}" alt="Image 3" width="35px" height="35px">
                            @endif

                        </td>
                        <td style="display: flex;gap: 10px">
                            <a href="{{ route('products.edit', $item) }}">
                                <button class="btn btn-success px-4 py-2">Edit</button>
                            </a>

                            <button class="btn btn-danger px-4 py-2"
                                    onclick="
                                        if (confirm('Are you sure?')) {
                                        document.getElementById('item-{{ $item->id }}').submit();
                                        }
                                        ">Xóa
                            </button>

                            <form action="{{ route('products.destroy', $item) }}"
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
            {{--            {{ $data->links() }}--}}
        </div>
    </div>
@endsection
