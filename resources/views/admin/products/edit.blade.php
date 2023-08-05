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
                <h4 class="card-title">Edit Product</h4>
            </div>
        </div>
        <div class="card-body">
            <form id="edit" action="{{ route('products.update', $data->id) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{--                {{$data->category->id}}--}}
                <div class="row mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="card-title">Name</label>
                                <input type="text" value="{{$data->name}}" class="form-control" id="name" name="name"
                                       placeholder="name">
                            </div>
                            <br>

                            <div class="form-group">
                                <label class="card-title">Price</label>
                                <input type="text" value="{{$data->price}}" class="form-control" id="price" name="price"
                                       placeholder="Image">
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="card-title">Description</label>
                                <input type="text" value="{{$data->descrip}}" class="form-control" id="descrip"
                                       name="descrip" placeholder="Image">
                            </div>
                            <br>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="card-title">Category_id</label>
                                <select class="form-control" id="category_id" name="category_id">
                                    @foreach($categories as $category)
                                        <option
                                            <?= $category->id == $data->category->id ? 'selected' : '' ?> value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                        <div class="form-group">
                            <label class="card-title">Quantity</label>
                            <input type="text" value="{{$data->quantity}}" class="form-control" id="quantity"
                                   name="quantity" placeholder="Image">
                        </div>
                            <br>
                            <div class="form-group">
                                <label class="card-title">Size_id</label>
                                <select class="form-control" id="size_id" name="size_id">
                                    @foreach($sizes as $size)
                                        <option
                                            <?= $data->size->id == $size->id ? 'selected' : '' ?> value="{{$size->id}}">{{$size->name}}</option>
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
                            <br>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
