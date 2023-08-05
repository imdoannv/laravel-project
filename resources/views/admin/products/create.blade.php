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
                <h4 class="card-title">Add Product</h4>
            </div>
        </div>
        <div class="card-body">
            <form id="create" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="card-title">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="name">
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="card-title">Price</label>
                                <input type="text" class="form-control" id="price" name="price">
                            </div>
                            <br>

                            <div class="form-group">
                                <label class="card-title">Description</label>
                                <input type="text" class="form-control" id="descrip" name="descrip">
                            </div>
                            <br>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="card-title">Category_id</label>
                                <select class="form-control" id="category_id" name="category_id">

                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>

                            <div class="form-group">
                                <label class="card-title">Quantity</label>
                                <input type="text" class="form-control" id="quantity" name="quantity">
                            </div>
                            <br>

                            <div class="form-group">
                                <label class="card-title">Size_id</label>
                                <select class="form-control" id="size_id" name="size_id">
                                    @foreach($sizes as $size)
                                        <option value="{{$size->id}}">{{$size->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="card-title">Image 1:</label>
                            <input type="file" class="form-control" id="img1" name="img1">
                        </div>
                        <br>

                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="card-title">Image 2:</label>
                            <input type="file" class="form-control" id="img2" name="img2">
                        </div>
                        <br>

                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="card-title">Image 3:</label>
                            <input type="file" class="form-control" id="img3" name="img3">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>
        </div>
    </div>
@endsection
