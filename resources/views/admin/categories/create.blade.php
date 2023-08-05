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
                <h4 class="card-title">Add Category</h4>
            </div>
        </div>
        <div class="card-body">

            <form id="create" method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="card-title">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="name">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                        <div class="form-group">
                            <label class="card-title">Image</label>
                            <input type="file" class="form-control" id="image" name="image" placeholder="Image">
                            <br>
                        </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>
        </div>
    </div>
@endsection
