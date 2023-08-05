<?php //dd($productsData) ?><!---->
@extends('customer.layout.layout')
@section('content')
    <?php
    $nameParts = explode(' ', auth()->user()->name);
    ?>
<body class="bg-light">
<div class="container">
    <div class="py-5 text-center">
        <h1>Checkout form</h1>

    </div>

    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your items</span>
                <span class="badge badge-secondary badge-pill">{{count($productsData)}}</span>
            </h4>
            <ul class="list-group mb-3">
                <?php
                $total = 0;
                ?>
                @foreach($productsData as $item)

                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">{{$item['name']}}</h6>
                        <small class="text-muted">{{$item['quantity']}} x {{$item['price']}}</small>
                    </div>
                    <span class="text-muted">${{$item['quantity'] * $item['price']}}</span>
                </li>
                @endforeach
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (USD)</span>
                    <strong>$
                        <?php
                        foreach ($productsData as $item){
                            $total += $item['quantity'] * $item['price'];
                        }
                        echo $total;
                        ?>
                    </strong>
                </li>
            </ul>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing address</h4>
            <form class="needs-validation"  action="{{ route('checkout.place-order') }}" method="POST" novalidate>
                @csrf
                <input type="hidden" name="productsData" value="{{ json_encode($productsData) }}">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">First name</label>
                        <input type="text" class="form-control" id="firstName" placeholder="" value="{{$nameParts[0]}}" required>
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Last name</label>
                        <input type="text" class="form-control" id="lastName" placeholder="" value="{{isset($nameParts[1]) ? $nameParts[1] : ''}}" required>
                        <div class="invalid-feedback">
                            Valid last name is required.
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="username">Username</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" class="form-control" id="username" value="{{auth()->user()->username}}" placeholder="Username" required>
                        <div class="invalid-feedback" style="width: 100%;">
                            Your username is required.
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Email <span class="text-muted">(Optional)</span></label>
                    <input type="email" class="form-control" id="email" value="{{auth()->user()->email}}">
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" value="{{auth()->user()->address}}">
                    <div class="invalid-feedback">
                        Please enter your shipping address.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                    <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                </div>

                <hr class="mb-4">
                <button class="btn btn-success btn-lg btn-block" type="submit">Continue to checkout</button>
            </form>
        </div>
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2017-2019 Company Name</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Privacy</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
    </footer>
</div>
@endsection
