<!DOCTYPE html>
<html lang="en">
<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- site metas -->
    <title>DP FOODY</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{asset('customer/css/bootstrap.min.css')}}">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="{{asset('customer/css/style.css')}}">

    <!-- Responsive-->
    <link rel="stylesheet" href="{{asset('customer/css/responsive.css')}}">
    <!-- fevicon -->
    <link rel="icon" href="{{asset('customer/images/logo.png')}}" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{asset('customer/css/jquery.mCustomScrollbar.min.css')}}">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--  -->
    <!-- owl stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Poppins:400,700&display=swap&subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('customer/css/owl.carousel.min.css')}}">
    <link rel="stylesoeet" href="{{asset('customer/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <!-- Link CSS của Font Awesome v5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Link JS của Font Awesome v5 (nếu bạn muốn sử dụng các tính năng JavaScript) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>


</head>
<body>
<!-- banner bg main start -->
<div class="banner_bg_main">
    <!-- header top section start -->
    <div class="container">
        <div class="header_section_top">
            <div class="row">
                <div class="col-sm-12">
                    <div class="custom_menu">
                        <ul>
                            <li><a href="{{route('home.index')}}">Home</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header top section start -->
    <!-- logo section start -->
    <div class="logo_section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="logo"><a href="{{route('home.index')}}"><h1 style="font-weight: bold;font-size: 50px;color: white">DP FOODY</h1></a></div>
                </div>
            </div>
        </div>
    </div>
    <!-- logo section end -->
    <!-- header section start -->
    <div class="header_section">
        <div class="container">
            <div class="containt_main">



                <div class="main">

                </div>
                <div class="header_box">

                    <div class="login_menu">
                        <ul>
                            <li><a href="{{route('cart.index',auth()->id())}}">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span class="padding_10">Cart</span>
                                </a>
                            </li>


                       <li>



                                    {{--Tài khoản--}}
                                    <div class="dropdown-toggle"">

                                        @if (Route::has('login'))
                                            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                                                @auth
                                                    <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
                                                       href="#"
                                                       role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i
                                                            class="bx bx-user fs-3"></i>
                                                        <div class="user-info">
                                                            <p class="user-name mb-0">{{ \Illuminate\Support\Facades\Auth::user()->name }}</p>
                                                            <p class="designattion mb-0">{{ \Illuminate\Support\Facades\Auth::user()->email }}</p>
                                                        </div>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item d-flex align-items-center"
                                                                   href={{route('profile.edit')}}><i
                                                                        class="bx bx-user fs-5"></i><span>Profile</span></a>
                                                            </li>
                                                            <form method="POST" action="{{ route('logout') }}">
                                                                @csrf
                                                                <a class="dropdown-item d-flex align-items-center"
                                                                   href="{{route('logout') }}"
                                                                   onclick="event.preventDefault(); this.closest('form').submit()"><i
                                                                        class="bx bx-log-out-circle"></i><span>Logout</span></a>
                                                            </form>

                                                        </ul>
                                                    </a>
                                                @else
                                                    <a href="{{ route('login') }}" class="nav-link menu-title">Log in</a>

                                                    @if (\Illuminate\Routing\Route::has('register'))
                                                        <a href="{{ route('register') }}" class="nav-link menu-title">Register</a>
                                                    @endif
                                                @endauth
                                            </div>
                                        @endif

                                    </div>


                    </li>


                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<!-- banner bg main end -->
<!-- fashion section start -->


<!-- jewellery  section start -->
@yield('content')
<!-- jewellery  section end -->

<!-- footer section end -->
<!-- copyright section start -->
<div class="copyright_section">
    <div class="container">
        <p class="copyright_text">© 2020 All Rights Reserved. Design by <a href="https://html.design">Free html  Templates</a></p>
    </div>
</div>
<!-- copyright section end -->
<!-- Javascript files-->
<script src="{{asset('customer/js/jquery.min.js')}}"></script>
<script src="{{asset('customer/js/popper.min.js')}}"></script>
<script src="{{asset('customer/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('customer/js/jquery-3.0.0.min.js')}}"></script>
<script src="{{asset('customer/js/plugin.js')}}"></script>
<script src="{{asset('customer/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{asset('customer/js/custom.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.login_menu .dropdown-toggle').click(function(e) {
            e.preventDefault();
            $(this).parent().toggleClass('open');
        });

        // Đóng danh sách dropdown nếu click bên ngoài nút
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.login_menu .dropdown').length) {
                $('.login_menu .dropdown').removeClass('open');
            }
        });
    });
</script>

<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
        document.getElementById('checkout-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);

        // Gửi AJAX request tới route 'place.order'
        fetch('/place-order', {
        method: 'POST',
        body: formData,
        headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    })
        .then(response => {
        if (response.ok) {
        // Nếu request thành công, chuyển hướng tới trang thông báo đặt hàng thành công
        window.location.href = '/checkout/success';
    } else {
        // Nếu có lỗi xảy ra, hiển thị thông báo lỗi
        alert('An error occurred while processing your order.');
    }
    })
        .catch(error => {
        // Nếu có lỗi xảy ra, hiển thị thông báo lỗi
        alert('An error occurred while processing your order.');
    });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
