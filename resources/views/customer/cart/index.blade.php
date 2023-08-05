@extends('customer.layout.layout')
@section('content')
    <section class="h-100" style="background-color: #eee;">
        <div class="container h-100 py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-10">
                    <form action="{{ route('checkout.index') }}" method="POST">
                        @csrf

                        <div class="card rounded-3 mb-4">
                            <div class="card-body p-4">

                                @if($cartItems->isEmpty())
                                    <h1>No items in cart</h1>
                                @else
                                    @foreach($cartItems as $item)
                                        <div class="row d-flex justify-content-between align-items-center">
                                            <div class="col-md-1 col-lg-1 col-xl-1">
                                                <input type="checkbox" name="selected_products[]"
                                                       value="{{ $item->product->id }}">
                                            </div>
                                            <div class="col-md-2 col-lg-2 col-xl-2">
                                                <img
                                                    src="{{asset($item->product->images->img1)}}"
                                                    class="img-fluid rounded-3" alt="Cotton T-shirt">
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-3">
                                                <p class="lead fw-normal mb-2">{{$item->product->name}}</p>
                                                <p><span class="text-muted">Size: </span>{{$item->product->size->name}}
                                                </p>
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                <button class="btn btn-link px-2" onclick="decreaseQuantity(this)">
                                                    <i class="fas fa-minus"></i>
                                                </button>

                                                <input min="0" name="quantity" readonly value="{{$item->quantity}}"
                                                       type="number"
                                                       class="form-control form-control-sm"/>

                                                <button class="btn btn-link px-2" onclick="increaseQuantity(this)">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                <h5 class="mb-0">${{$item->product->price * $item->quantity}}</h5>
                                            </div>
                                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                <button type="button" class="btn btn-link btn-delete" data-product-id="{{ $item->product->id }}">
                                                    <i class="fas fa-trash fa-lg"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        @if($cartItems->isNotEmpty())
                        <input type="hidden" name="prices[]" value="{{ $item->product->price }}">
                        <input type="hidden" name="names[]" value="{{ $item->product->name }}">
                        <input type="hidden" name="quantities[]" value="{{ $item->quantity }}">
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <button type="submit" class="btn btn-success btn-block btn-lg">
                                    Proceed to Pay
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        function decreaseQuantity(button) {
            const input = button.parentNode.querySelector('input[type=number]');
            if (parseInt(input.value) > 0) {
                input.stepDown();
            }
        }

        function increaseQuantity(button) {
            const input = button.parentNode.querySelector('input[type=number]');
            input.stepUp();
        }

        document.addEventListener('DOMContentLoaded', function () {
            const btnDeleteList = document.querySelectorAll('.btn.btn-link.btn-delete');
            btnDeleteList.forEach(btn => {
                btn.addEventListener('click', () => {
                    const productId = btn.getAttribute('data-product-id');
                    deleteProduct(productId);
                });
            });

            function deleteProduct(productId) {
                // Gửi yêu cầu xóa sản phẩm thông qua Ajax
                fetch('/customer/cart/' + productId, {  // Thêm "/customer" vào đường dẫn tại đây
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                })
                    .then(response => {
                        if (response.ok) {
                            // Nếu xóa thành công, cập nhật lại trang
                            window.location.reload();
                        } else {
                            // Nếu có lỗi xảy ra, hiển thị thông báo lỗi
                            alert('An error occurred while deleting the product.');
                        }
                    })
                    .catch(error => {
                        alert('An error occurred while deleting the product.');
                    });
            }
        })
    </script>
@endsection
