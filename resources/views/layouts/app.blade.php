<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>@yield('title', config('app.name'))</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ asset('theme/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <link href="{{ asset('theme/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('theme/css/style.css') }}" rel="stylesheet">
    <style>
        /* prevent horizontal overflow on small screens */
        body { overflow-x: hidden; }
        .table-responsive-always { overflow-x: auto; }
        /* reduce the inner-page banner height by ~45% */
        .page-header { padding-top: 1.5rem !important; padding-bottom: 1.5rem !important; }
        @media (max-width: 576px) {
            .page-header { padding-top: 1rem !important; padding-bottom: 1rem !important; }
            .page-header h1 { font-size: 1.5rem !important; }
        }
        /*
         * The Fruitables theme sets .pagination { display: inline-block; } which
         * collapses Bootstrap's flex layout and causes page buttons to stack vertically.
         * This overrides it to restore the expected horizontal row.
         */
        ul.pagination { display: flex !important; flex-direction: row; flex-wrap: wrap; }
    </style>
</head>

<body>

    <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <div class="container-fluid fixed-top">
        <div class="container topbar bg-primary d-none d-lg-block">
            <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">Port of Spain, Trinidad</a></small>
                    <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">info@mobilemarket.tt</a></small>
                </div>
                <div class="top-link pe-2">
                    <a href="{{ route('privacy') }}" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                    <a href="{{ route('terms') }}" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                    <a href="{{ route('terms') }}" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
                </div>
            </div>
        </div>
        <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-xl">
                <a href="{{ route('home') }}" class="navbar-brand">
                    <h1 class="text-primary mb-0" style="font-size: clamp(1.2rem, 4vw, 1.8rem);">Mobile Market</h1>
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="{{ route('home') }}" class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
                        <a href="{{ route('shop.index') }}" class="nav-item nav-link {{ Request::is('shop*') ? 'active' : '' }}">Shop</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a href="{{ route('cart.index') }}" class="dropdown-item">Cart</a>
                                <a href="{{ route('checkout.index') }}" class="dropdown-item">Checkout</a>
                            </div>
                        </div>
                        <a href="{{ route('contact') }}" class="nav-item nav-link {{ Request::is('contact') ? 'active' : '' }}">Contact</a>
                    </div>
                    <div class="d-flex m-3 me-0">
                        <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>

                        @auth
                            @php
                                $cartCount = \App\Models\Cart::where('user_id', Auth::id())->sum('quantity');
                            @endphp
                            <a href="{{ route('cart.index') }}" class="position-relative me-4 my-auto">
                                <i class="fa fa-shopping-bag fa-2x"></i>
                                <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">{{ $cartCount }}</span>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="position-relative me-4 my-auto">
                                <i class="fa fa-shopping-bag fa-2x"></i>
                            </a>
                        @endauth
                        @guest
                            <a href="{{ route('login') }}" class="my-auto" title="Login">
                                <i class="fas fa-user fa-2x"></i>
                            </a>
                        @else
                            <div class="nav-item dropdown my-auto">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="fas fa-user fa-2x"></i>
                                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                                    <span class="badge bg-secondary ms-1 d-none d-md-inline" title="Loyalty Points">
                                        <i class="fas fa-star me-1" style="font-size:0.65rem;"></i>{{ number_format(Auth::user()->points_balance) }}
                                    </span>
                                </a>
                                <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                    @if(Auth::user()->role === 'admin')
                                        <a class="dropdown-item" href="/admin">Admin Dashboard</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('user.profile') }}">My Profile</a>
                                    <a class="dropdown-item" href="{{ route('user.tiers.index') }}">My Rewards</a>
                                    <a class="dropdown-item" href="{{ route('user.orders.index') }}">Order History</a>
                                    <a class="dropdown-item" href="{{ route('cart.index') }}">My Cart</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endguest
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <form action="{{ route('search') }}" method="GET" class="w-75 mx-auto">
                        <div class="input-group d-flex">
                            <input type="text" name="q" class="form-control p-3" placeholder="Search products..." value="{{ request('q') }}" aria-describedby="search-icon-1">
                            <button type="submit" id="search-icon-1" class="input-group-text p-3 btn btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <main class="{{ (Route::is('home') || Route::is('home.index') || Request::is('/')) ? '' : 'mt-5 pt-5' }}">
        @yield('content')
    </main>

    {{-- Product Advisor widget shown on shop and detail pages for logged-in users --}}
    @auth
        @if(Request::is('shop*') || Request::is('details/*') || Request::is('store*'))
            <x-core.product-advisor />
        @endif
    @endauth

    <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
        <div class="container py-5">
            <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <a href="#">
                            <h1 class="text-primary mb-0">Mobile Market TT</h1>
                            <p class="text-secondary mb-0">Fresh Produce Delivery</p>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative mx-auto">
                            <input class="form-control border-0 w-100 py-3 px-4 rounded-pill" type="number" placeholder="Your Email">
                            <button type="submit" class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white" style="top: 0; right: 0;">Subscribe Now</button>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="d-flex justify-content-end pt-3">
                            <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">About The Project</h4>
                        <p class="mb-4">
                            "The Mobile Market TT" is a comprehensive e-commerce web application designed for the sale
                            and delivery of fresh fruits and vegetables across Trinidad. It integrates gamification to
                            enhance user engagement.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Shop Info</h4>
                        <a class="btn-link" href="{{ route('about') }}">About Us</a>
                        <a class="btn-link" href="{{ route('contact') }}">Contact Us</a>
                        <a class="btn-link" href="{{ route('privacy') }}">Privacy Policy</a>
                        <a class="btn-link" href="{{ route('terms') }}">Terms & Condition</a>
                        <a class="btn-link" href="{{ route('terms') }}">Return Policy</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Account</h4>
                        <a class="btn-link" href="{{ route('login') }}">My Account</a>
                        <a class="btn-link" href="{{ route('shop.index') }}">Shop</a>
                        <a class="btn-link" href="{{ route('cart.index') }}">Shopping Cart</a>
                        <a class="btn-link" href="{{ route('user.tiers.index') }}">My Rewards</a>
                        <a class="btn-link" href="{{ route('user.orders.index') }}">Order History</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Contact</h4>
                        <p>Address: Port of Spain, Trinidad</p>
                        <p>Student ID: 2321563</p>
                        <p>Project: RMET / Undergraduate Project</p>
                        <img src="{{ asset('theme/img/payment.png') }}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Mobile Market TT</a>, All right reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">
                    Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                </div>
            </div>
        </div>
    </div>
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('theme/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('theme/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('theme/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('theme/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('theme/js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>
