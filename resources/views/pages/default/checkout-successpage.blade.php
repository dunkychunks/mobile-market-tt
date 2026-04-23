@extends('layouts.app')

@section('title', 'MMTT | Order Confirmed')

@section('content')

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Order Confirmed</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active text-white">Success</li>
    </ol>
</div>

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">

                {{-- success banner --}}
                <div class="text-center mb-5">
                    <i class="bi bi-check-circle display-1 text-primary mb-3 d-block"></i>
                    <h2 class="mb-2">Thank you for your order!</h2>
                    <p class="text-muted">We have received your order and will begin processing it shortly.</p>
                </div>

                {{-- order summary card --}}
                <div class="border border-secondary rounded p-4 mb-4">
                    <h5 class="text-primary mb-3"><i class="fas fa-receipt me-2"></i>Order Summary</h5>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Order Number</span>
                        <strong>{{ $order->order_no }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Payment Status</span>
                        <span class="badge bg-success">{{ ucfirst($order->payment_status) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span>${{ app('CustomHelper')->formatPrice($order->subtotal) }}</span>
                    </div>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total Paid</span>
                        <span class="text-primary">${{ app('CustomHelper')->formatPrice($order->total) }}</span>
                    </div>
                </div>

                {{-- items ordered --}}
                <div class="border border-secondary rounded p-4 mb-4">
                    <h5 class="text-primary mb-3"><i class="fas fa-shopping-bag me-2"></i>Items Ordered</h5>

                    @foreach ($order->products as $product)
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <div class="d-flex align-items-center">
                            <img src="{{ $product->getImage() }}" class="rounded-circle me-3" style="width:45px;height:45px;object-fit:cover;" alt="">
                            <div>
                                <p class="mb-0 fw-semibold">{{ $product->title }}</p>
                                <small class="text-muted">Qty: {{ $product->pivot->quantity }}</small>
                            </div>
                        </div>
                        <span>${{ app('CustomHelper')->formatPrice($product->pivot->price * $product->pivot->quantity) }}</span>
                    </div>
                    @endforeach
                </div>

                {{-- points earned --}}
                <div class="border border-secondary rounded p-4 mb-4">
                    <h5 class="text-primary mb-2"><i class="fas fa-star me-2"></i>Loyalty Points</h5>
                    <p class="text-muted mb-1">You earned <strong class="text-primary">{{ (int)($order->total * 10) }} points</strong> from this order.</p>
                    <p class="mb-0 text-muted">Your current balance: <strong class="text-primary">{{ Auth::user()->fresh()->points_balance }} points</strong></p>
                </div>

                {{-- tier status --}}
                @if ($tier_helper->tier)
                <div class="border border-secondary rounded p-4 mb-5">
                    <h5 class="text-primary mb-2"><i class="fas fa-trophy me-2"></i>Your Tier</h5>
                    <p class="mb-1 text-muted">Current tier: <strong class="text-primary">{{ Str::ucfirst($tier_helper->tier->title) }}</strong></p>
                    @if ($tier_helper->hasNextTier())
                        <p class="mb-2 text-muted">Spend <strong class="text-primary">${{ app('CustomHelper')->formatPrice($tier_helper->next_tier_amount) }}</strong> more to reach {{ $tier_helper->next_tier->title }}.</p>
                        <div class="progress rounded-pill" style="height:10px;">
                            <div class="progress-bar bg-secondary" style="width:{{ $tier_helper->next_tier_percent }}%"></div>
                        </div>
                    @else
                        <p class="mb-0 text-muted">You are at the highest tier!</p>
                    @endif
                </div>
                @endif

                <div class="text-center">
                    <a href="{{ route('shop.index') }}" class="btn border-secondary rounded-pill py-3 px-5 text-primary">
                        Continue Shopping
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
