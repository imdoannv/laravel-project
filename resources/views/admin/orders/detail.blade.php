<?php //dd($user) ?><!----><!---->
@extends('admin.layout.layout')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Customer:
                <strong>{{$user->name}}</strong>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h6 class="mb-3">From:</h6>
                        <div>
                            <strong>{{$user->address}}</strong>
                        </div>
                        <div>Email: {{$user->email}}</div>
                    </div>

                </div>

                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="center">#</th>
                            <th>Item</th>

                            <th class="right">Unit Cost</th>
                            <th class="center">QuantiSSty</th>
                            <th class="right">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                                <?php $i = 1;
                                $total = 0;
                                ?>
                            <tr>
                                <td class="center">{{$i}}</td>
                                <td class="left strong">{{$item->product->name}}</td>

                                <td class="right">${{$item->product->price}}</td>
                                <td class="center">{{$item->quantity}}</td>
                                <td class="right">${{$item->product->price * $item->quantity}} </td>
                            </tr>
                                <?php $i++;
                                $total += $item->product->price * $item->quantity;
                                ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-5">

                </div>

                <div class="col-lg-4 col-sm-5 ml-auto">
                    <table class="table table-clear">
                        <tbody>
                        <tr>
                            <td class="left">
                                <strong>Subtotal</strong>
                            </td>
                            <td class="right">${{$total}}</td>
                        </tr>
                        <tr>
                            <td class="left">
                                <strong>VAT (10%)</strong>
                            </td>
                            <td class="right">${{$total * 10 /100}}</td>
                        </tr>
                        <tr>
                            <td class="left">
                                <strong>Total</strong>
                            </td>
                            <td class="right">
                                <strong>${{$total*110/100}}</strong>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
    </div>
</div>
@endsection
