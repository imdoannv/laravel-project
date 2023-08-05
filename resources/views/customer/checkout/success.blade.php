@extends('customer.layout.layout')
@section('content')
    <div class="jumbotron text-center">
        <h1 class="display-3">Thank You!</h1>
        <p class="lead"><strong>Please check your email</strong> for further instructions on how to complete your order.</p>
        <hr>
        <h2>
            Having trouble? <a href=#">Contact us</a>
        </h2>
        <p class="lead">
            <a class="btn btn-success btn-sm" role="button" href="{{route('home.index')}}">Continue to homepage</a>
        </p>
    </div>
@endsection
