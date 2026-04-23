@extends('layouts.app')

@section('title', 'MMTT | Search')

@section('content')

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Search Results</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active text-white">Search</li>
    </ol>
</div>

<div class="container-fluid fruite py-5">
    <div class="container py-5">

        {{-- search bar --}}
        <div class="row mb-4">
            <div class="col-lg-6 mx-auto">
                <form action="{{ route('search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control p-3" placeholder="Search products..." value="{{ $q }}">
                        @if($category)
                            <input type="hidden" name="category" value="{{ $category }}">
                        @endif
                        <button type="submit" class="input-group-text p-3 btn btn-primary"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row g-4">
            {{-- category filter sidebar --}}
            <div class="col-lg-3">
                <div class="mb-3">
                    <h5 class="mb-3">Filter by Category</h5>
                    <ul class="list-unstyled fruite-categorie">
                        <li>
                            <div class="d-flex fruite-name">
                                {{-- clears both search and category --}}
                                <a href="{{ route('search') }}" class="{{ !$category ? 'text-primary fw-bold' : '' }}">
                                    <i class="fas fa-th me-2"></i>All Categories
                                </a>
                            </div>
                        </li>
                        @foreach($categories as $cat)
                        <li>
                            <div class="d-flex fruite-name">
                                {{-- switching category clears the active search query --}}
                                <a href="{{ route('search', ['category' => $cat]) }}"
                                   class="{{ $category === $cat ? 'text-primary fw-bold' : '' }}">
                                    <i class="fas fa-apple-alt me-2"></i>{{ ucfirst($cat) }}
                                </a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- results --}}
            <div class="col-lg-9">
                @if($q || $category)
                    <p class="text-muted mb-4">
                        {{ $results->total() }} result(s)
                        @if($q) for "<strong>{{ $q }}</strong>"@endif
                        @if($category) in <strong>{{ ucfirst($category) }}</strong>@endif
                    </p>
                @endif

                @if($results->isEmpty())
                    <div class="text-center py-5">
                        <i class="fas fa-search fa-3x text-muted mb-3 d-block"></i>
                        <h4 class="text-muted">No products found</h4>
                        <p class="text-muted">Try a different keyword or browse the <a href="{{ route('shop.index') }}">full shop</a>.</p>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach($results as $data)
                            <div class="col-md-6 col-xl-4">
                                <div class="rounded position-relative fruite-item border border-secondary">
                                    <div class="fruite-img">
                                        <img src="{{ $data->getImage() }}" class="img-fluid w-100 rounded-top" alt="{{ $data->title }}">
                                    </div>
                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
                                        {{ $data->category ?? 'General' }}
                                    </div>
                                    <div class="p-4 border-top-0 rounded-bottom d-flex flex-column">
                                        <h5>{{ $data->title }}</h5>
                                        <p class="text-muted small flex-grow-1">{{ Str::limit($data->short_description, 80) }}</p>
                                        <p class="text-dark fs-5 fw-bold mb-3">${{ $data->getPrice() }}</p>

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
                    </div>

                    <div class="mt-4">
                        {{ $results->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
