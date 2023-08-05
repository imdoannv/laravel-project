@extends('customer.layout.layout')
@section('content')
@foreach($data as $key => $item)
    @if(count($item['productsInCategory']) > 0)
        <div class="fashion_section">
            <div id="main_slider_{{ $key }}" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @php $productCount = 0; @endphp
                    @foreach ($item['productsInCategory'] as $index => $product)

                        @if($productCount % 3 === 0)
                            <div class="carousel-item{{ $index === 0 ? ' active' : '' }}">
                                <div class="container">
                                    <h4 class="fashion_taital">{{ $item['categoryName'] }}</h4>
                                    <div class="fashion_section_2">
                                        <div class="row">
                                            @endif
                                            <div class="col-lg-4 col-sm-4">
                                                <div class="box_main">
                                                    <h4 style="height: 50px;margin-bottom: 10px" class="shirt_text">{{ $product->name }}</h4>
                                                    <p class="price_text">Price  <span style="color: #262626;">$ {{ $product->price }}</span></p>
                                                    <div class="tshirt_img"><img width="300px" height="500px" src="{{ asset($product->images->img1) }}"></div>
                                                    <div class="btn_main">
                                                        <div class="buy_bt">
                                                            <form action="{{route('cart.store')}}" method="POST">
                                                                @csrf
                                                                <input type="hidden" value="{{$product->id}}" name="product_id">
                                                                <input type="hidden" value="{{ auth()->id() }}" id="user_id" name="user_id">
                                                                <input type="hidden" name="quantity" id="quantity" value="1">
                                                                <a href="{{route('cart.index',auth()->id())}}"style="background: none;font-weight: bold; "> Add to cart</a>

                                                            </form>
                                                        </div>
                                                        <div class="seemore_bt"><a href="{{route('home.show', $product->id)}}">See More</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            @php $productCount++; @endphp
                                            @if($productCount % 3 === 0 || $loop->last)
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#main_slider_{{ $key }}" role="button" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="carousel-control-next" href="#main_slider_{{ $key }}" role="button" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>

            </div>
        </div>
    @endif
@endforeach
@endsection

