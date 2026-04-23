@extends('layouts.app')

@section('title', 'MMTT | Shop')

@section('content')

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Shop</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active text-white">Shop</li>
    </ol>
</div>
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-4">
                    <div class="col-xl-3">
                        <form action="{{ route('search') }}" method="GET">
                            <div class="input-group w-100 mx-auto d-flex">
                                <input type="text" name="q" class="form-control p-3" placeholder="Search products..." aria-describedby="search-icon-1">
                                <button type="submit" id="search-icon-1" class="input-group-text p-3 btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-6"></div>
                    <div class="col-xl-3">
                        <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                            <label for="fruits">Default Sorting:</label>
                            <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3" form="fruitform">
                                <option value="volvo">Nothing</option>
                                <option value="saab">Popularity</option>
                                <option value="opel">Organic</option>
                                <option value="audi">Fantastic</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4>Categories</h4>
                                    <ul class="list-unstyled fruite-categorie">
                                        <li>
                                            <div class="d-flex fruite-name">
                                                <a href="{{ route('shop.index') }}"><i class="fas fa-th me-2"></i>All Products</a>
                                            </div>
                                        </li>
                                        @foreach($categories as $cat => $count)
                                        <li>
                                            <div class="d-flex justify-content-between fruite-name">
                                                <a href="{{ route('search', ['category' => $cat]) }}"><i class="fas fa-apple-alt me-2"></i>{{ ucfirst($cat) }}</a>
                                                <span>({{ $count }})</span>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row g-4 justify-content-center">

                            @if($product_data->isEmpty())
                                <div class="col-12 text-center">
                                    <h3>No Products Found</h3>
                                </div>
                            @else
                                @foreach ($product_data as $data)
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item border border-secondary">
                                            <div class="fruite-img">
                                                <img src="{{ $data->getImage() }}" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
                                                {{ $data->category ?? 'General' }}
                                            </div>
                                            {{-- Early Access badge shown to Tier 3 users for upcoming products --}}
                                            @auth
                                                @if(Auth::user()->tier && Auth::user()->tier->title === 'Tier 3' && $data->classification === 'upcoming')
                                                    <div class="text-white bg-primary px-2 py-1 rounded position-absolute" style="top: 10px; right: 10px; font-size:0.75rem;">
                                                        <i class="fas fa-star me-1"></i>Early Access
                                                    </div>
                                                @endif
                                            @endauth
                                            <div class="p-4 border-top-0 rounded-bottom">
                                                <h4>{{ $data->title }}</h4>
                                                <p class="text-muted small">{{ Str::limit($data->short_description, 80) }}</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">${{ $data->getPrice() }}</p>
                                                    <a href="{{ route('cart.addfromstorepage', ['id' => $data->id]) }}" class="btn border border-secondary rounded-pill px-3 text-primary">
                                                        <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                                                    </a>
                                                </div>
                                                <div class="text-center mt-3">
                                                     <a href="{{ $data->getLink() }}" class="small text-muted">View Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            <div class="col-12">
                                @include('components.core.pagination-call', ['data' => $product_data])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
