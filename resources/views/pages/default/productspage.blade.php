@extends('layouts.app')

@section('title', 'MMTT | Shop')

@section('content')

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Shop</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        @if($active_category)
            <li class="breadcrumb-item"><a href="{{ route('shop.index') }}" class="text-white-50">Shop</a></li>
            <li class="breadcrumb-item active text-white">{{ ucfirst($active_category) }}</li>
        @else
            <li class="breadcrumb-item active text-white">Shop</li>
        @endif
    </ol>
</div>

<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="row g-4">
            {{-- top search bar --}}
            <div class="col-12">
                <div class="row g-3 align-items-center mb-2">
                    <div class="col-md-5">
                        <form action="{{ route('search') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="q" class="form-control p-3" placeholder="Search products...">
                                <button type="submit" class="input-group-text p-3 btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    @if($active_category)
                    <div class="col-md-4">
                        <span class="text-muted">Showing: <strong>{{ ucfirst($active_category) }}</strong> &mdash; <a href="{{ route('shop.index') }}" class="text-primary">Clear filter</a></span>
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-3">
                {{-- category sidebar --}}
                <div class="mb-4">
                    <h5 class="mb-3">Categories</h5>
                    <ul class="list-unstyled fruite-categorie">
                        <li>
                            <div class="d-flex fruite-name">
                                <a href="{{ route('shop.index') }}"
                                   class="{{ !$active_category ? 'text-primary fw-bold' : '' }}">
                                    <i class="fas fa-th me-2"></i>All Products
                                </a>
                            </div>
                        </li>
                        @foreach($categories as $cat => $count)
                        <li>
                            <div class="d-flex justify-content-between fruite-name">
                                <a href="{{ route('shop.index', ['category' => $cat]) }}"
                                   class="{{ $active_category === $cat ? 'text-primary fw-bold' : '' }}">
                                    <i class="fas fa-apple-alt me-2"></i>{{ ucfirst($cat) }}
                                </a>
                                <span>({{ $count }})</span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row g-4">

                    @if($product_data->isEmpty())
                        <div class="col-12 text-center py-5">
                            <i class="fas fa-leaf fa-3x text-muted mb-3 d-block"></i>
                            <h5 class="text-muted">No products found in this category.</h5>
                            <a href="{{ route('shop.index') }}" class="btn border border-secondary rounded-pill px-4 text-primary mt-2">View All Products</a>
                        </div>
                    @else
                        @foreach ($product_data as $data)
                            <div class="col-md-6 col-xl-4">
                                <div class="rounded position-relative fruite-item border border-secondary h-100">
                                    <div class="fruite-img">
                                        <img src="{{ $data->getImage() }}" class="img-fluid w-100 rounded-top" alt="{{ $data->title }}">
                                    </div>
                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
                                        {{ $data->category ?? 'General' }}
                                    </div>
                                    {{-- Early Access badge for Tier 3 users on upcoming products --}}
                                    @auth
                                        @if(Auth::user()->tier && Auth::user()->tier->title === 'Tier 3' && $data->classification === 'upcoming')
                                            <div class="text-white bg-primary px-2 py-1 rounded position-absolute" style="top: 10px; right: 10px; font-size:0.75rem;">
                                                <i class="fas fa-star me-1"></i>Early Access
                                            </div>
                                        @endif
                                    @endauth
                                    <div class="p-4 border-top-0 rounded-bottom d-flex flex-column">
                                        <h5>{{ $data->title }}</h5>
                                        <p class="text-muted small flex-grow-1">{{ Str::limit($data->short_description, 80) }}</p>
                                        <p class="text-dark fs-5 fw-bold mb-3">${{ $data->getPrice() }}</p>

                                        {{-- add to cart with quantity selector, same pattern as the detail page --}}
                                        @auth
                                            <form action="{{ route('cart.store') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="product_id" value="{{ $data->id }}">
                                                <div class="d-flex align-items-center gap-2 mb-2">
                                                    <div class="input-group quantity" style="width:110px;">
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                                <i class="fa fa-minus"></i>
                                                            </button>
                                                        </div>
                                                        <input type="text" name="quantity" class="form-control form-control-sm text-center border-0" value="1">
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn border border-secondary rounded-pill px-3 text-primary flex-grow-1">
                                                        <i class="fa fa-shopping-bag me-1 text-primary"></i> Add to Cart
                                                    </button>
                                                </div>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}" class="btn border border-secondary rounded-pill px-3 text-primary w-100">
                                                <i class="fa fa-shopping-bag me-1 text-primary"></i> Add to Cart
                                            </a>
                                        @endauth

                                        <div class="text-center mt-2">
                                            <a href="{{ $data->getLink() }}" class="small text-muted">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    {{-- pagination --}}
                    <div class="col-12 mt-4">
                        @include('components.core.pagination-call', ['data' => $product_data])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
