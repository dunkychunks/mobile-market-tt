@extends('layouts.app')

@section('title', 'MMTT | Order History')

@section('content')

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Order History</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active text-white">Orders</li>
    </ol>
</div>

<x-mylayouts.inner-layout-user>

    <h3 class="text-primary mb-1">Order History</h3>
    <p class="text-muted mb-4">A record of all your past purchases.</p>
    <hr class="border-secondary mb-4">

    @if($orders->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-shopping-bag fa-3x text-muted mb-3 d-block"></i>
            <h5 class="text-muted">No orders yet</h5>
            <p class="text-muted">Head to the shop and place your first order.</p>
            <a href="{{ route('shop.index') }}" class="btn border border-secondary rounded-pill px-4 text-primary">Browse Shop</a>
        </div>
    @else
        @foreach($orders as $order)
            @php $isPaid = $order->payment_status === 'paid'; @endphp
            <div class="border border-secondary rounded p-4 mb-3">
                {{-- order header --}}
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h6 class="mb-1 text-primary">Order #{{ $order->order_no }}</h6>
                        <small class="text-muted">{{ $order->created_at->format('d M Y, g:i A') }}</small>
                    </div>
                    <span class="badge {{ $isPaid ? 'bg-success' : 'bg-warning text-dark' }}">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </div>

                {{-- items --}}
                @foreach($order->products as $product)
                    <div class="d-flex align-items-center py-2 border-top">
                        <img src="{{ $product->getImage() }}" class="rounded-circle me-3" style="width:40px;height:40px;object-fit:cover;" alt="">
                        <div class="flex-grow-1">
                            <p class="mb-0 fw-semibold">{{ $product->title }}</p>
                            <small class="text-muted">Qty: {{ $product->pivot->quantity }}</small>
                        </div>
                        <span class="text-muted">${{ app('CustomHelper')->formatPrice($product->pivot->price * $product->pivot->quantity) }}</span>
                    </div>
                @endforeach

                {{-- full financial breakdown --}}
                <div class="mt-3 pt-2 border-top">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted small">Subtotal</span>
                        <span class="small">${{ app('CustomHelper')->formatPrice($order->subtotal) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted small">Shipping</span>
                        <span class="small">
                            @if($order->shipping)
                                {{ $order->shipping->title }} — ${{ app('CustomHelper')->formatPrice($order->shipping->price) }}
                            @else
                                —
                            @endif
                        </span>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted small">Payment Method</span>
                        <span class="small">{{ ucwords(str_replace('_', ' ', $order->payment_method ?? 'Credit Card')) }}</span>
                    </div>
                    <div class="d-flex justify-content-between fw-bold border-top border-secondary pt-2 mt-1">
                        <span>Total {{ $isPaid ? 'Paid' : 'Due' }}</span>
                        <span class="text-primary">${{ app('CustomHelper')->formatPrice($order->total) }}</span>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="mt-3">
            {{ $orders->links() }}
        </div>
    @endif

</x-mylayouts.inner-layout-user>

@endsection
