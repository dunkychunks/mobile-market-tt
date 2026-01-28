<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $store }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('template_default/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_default/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('template_default/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_default/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_default/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('template_default/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('template_default/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('template_default/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('template_default/css/jquery.timepicker.css') }}">


    <link rel="stylesheet" href="{{ asset('template_default/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('template_default/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('template_default/css/style.css') }}">

    {{-- Custom Accent Colors --}}
    <link rel="stylesheet" href="{{ asset('template_default/css/custom.css') }}">
</head>

<body class="goto-here">
    {{-- START nav --}}
    <div class="py-1 bg-black">
        <div class="container">
            <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
                <div class="col-lg-12 d-block">
                    <div class="row d-flex">
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                    class="icon-phone2"></span></div>
                            <span class="text">+ 1235 2355 98</span>
                        </div>
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                    class="icon-paper-plane"></span></div>
                            <span class="text">youremail@email.com</span>
                        </div>
                        <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                            <span class="text">3-5 Business days delivery &amp; Free Returns</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home.index') }}">{{ $store }}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="{{ route('home.index') }}" class="nav-link">Home</a></li>
                    @auth
                    <li class="nav-item"><a href="{{ route('filament.admin.pages.dashboard') }}" class="nav-link">Dashboard</a></li>
                    @endauth
                    <li class="nav-item"><a href="{{ route('store.index') }}" class="nav-link">Store</a></li>

                    @auth
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown04" aria-haspopup="true"
                                aria-expanded="false">Profile</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown04">
                                <a class="dropdown-item" href="{{ route('store.index') }}">Store</a>
                                <a class="dropdown-item" href="{{ route('cart.index') }}">Cart</a>
                                <a class="dropdown-item" href="#">Order History</a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endauth
                    <li class="nav-item"><a href="#" class="nav-link">Blog</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>


                    @guest
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                        <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                    @endguest


                    @auth
                        <li class="nav-item cta cta-colored"><a href="{{ route('cart.index') }}" class="nav-link">
                                <span class="icon-shopping_cart"></span>
                                <x-core.cart-icon />
                            </a></li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

    @isset($hideBanner)
        @empty($hideBanner)
            {{-- START hero --}}
            <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('template_default/images/bg_6.jpg') }}');">
                <div class="container">
                    <div class="row no-gutters slider-text align-items-center justify-content-center">
                        <div class="col-md-9 ftco-animate text-center">
                            <p class="breadcrumbs"><span class="mr-2">
                                    <a href="{{ route('home.index') }}">Home</a></span>
                                {{-- <span>Store</span> --}}
                            </p>
                            <h1 class="mb-0 bread">{{ $title }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            {{-- END hero --}}
        @endempty
    @else
        {{-- START hero --}}
        <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('template_default/images/bg_6.jpg') }}');">
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-center">
                    <div class="col-md-9 ftco-animate text-center">
                        <p class="breadcrumbs"><span class="mr-2">
                                <a href="{{ route('home.index') }}">Home</a></span>
                            {{-- <span>Store</span> --}}
                        </p>
                        <h1 class="mb-0 bread">Store</h1>
                    </div>
                </div>
            </div>
        </div>
        {{-- END hero --}}
    @endisset



    {{-- Slot for content --}}
    {{ $slot }}

    {{-- START footer --}}
    <footer class="ftco-footer ftco-section">
        <div class="container">
            <div class="row">
                <div class="mouse">
                    <a href="#" class="mouse-icon">
                        <div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
                    </a>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">{{ $store }}</h2>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                            <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-5">
                        <h2 class="ftco-heading-2">Menu</h2>
                        <ul class="list-unstyled">
                            <li><a href="#" class="py-2 d-block">Store</a></li>
                            <li><a href="#" class="py-2 d-block">About</a></li>
                            <li><a href="#" class="py-2 d-block">Journal</a></li>
                            <li><a href="#" class="py-2 d-block">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Help</h2>
                        <div class="d-flex">
                            <ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
                                <li><a href="#" class="py-2 d-block">Shipping Information</a></li>
                                <li><a href="#" class="py-2 d-block">Returns &amp; Exchange</a></li>
                                <li><a href="#" class="py-2 d-block">Terms &amp; Conditions</a></li>
                                <li><a href="#" class="py-2 d-block">Privacy Policy</a></li>
                            </ul>
                            <ul class="list-unstyled">
                                <li><a href="#" class="py-2 d-block">FAQs</a></li>
                                <li><a href="#" class="py-2 d-block">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Have a Questions?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain
                                        View, San Francisco, California, USA</span></li>
                                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929
                                            210</span></a></li>
                                <li><a href="#"><span class="icon icon-envelope"></span><span
                                            class="text">info@yourdomain.com</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">

                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i
                            class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com"
                            target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </footer>
    {{-- END footer --}}



    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="var(--primary-accent-color)" />
        </svg></div>


    <script src="{{ asset('template_default/js/jquery.min.js') }}"></script>
    <script src="{{ asset('template_default/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('template_default/js/popper.min.js') }}"></script>
    <script src="{{ asset('template_default/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template_default/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('template_default/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('template_default/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('template_default/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('template_default/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('template_default/js/aos.js') }}"></script>
    <script src="{{ asset('template_default/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('template_default/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('template_default/js/scrollax.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="{{ asset('template_default/js/google-map.js') }}"></script>
    <script src="{{ asset('template_default/js/main.js') }}"></script>

</body>

</html>
