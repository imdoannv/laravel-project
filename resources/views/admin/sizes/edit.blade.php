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
                <h4 class="card-title">Edit Size</h4>
            </div>
        </div>
        <form id="edit" action="{{ route('sizes.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="col-md-6">
                <div class="form-group">
                    <label class="card-title">Name</label>
                    <input type="text" class="form-control" value="{{$data->name}}" id="name" name="name"
                           placeholder="name">
                    <br>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection