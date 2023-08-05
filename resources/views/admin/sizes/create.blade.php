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
                <h4 class="card-title">Add Size</h4>
            </div>
        </div>
        <div class="card-body">
            <form id="create" method="POST" action="{{ route('sizes.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">

                            <label class="card-title">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="name">
                            <br>

                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary mt-4">Submit</button>
            </form>
        </div>
    </div>
@endsection
