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
                        <span class="text-muted">Payment Method</span>
                        <strong>{{ ucwords(str_replace('_', ' ', $order->payment_method ?? 'Credit Card')) }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Payment Status</span>
                        @php $isPaid = $order->payment_status === 'paid'; @endphp
                        <span class="badge {{ $isPaid ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </div>
                    <hr class="border-secondary">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span>${{ app('CustomHelper')->formatPrice($order->subtotal) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Shipping</span>
                        @if($order->shipping)
                            <span>{{ $order->shipping->title }} — ${{ app('CustomHelper')->formatPrice($order->shipping->price) }}</span>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </div>
                    <div class="d-flex justify-content-between fw-bold border-top border-secondary pt-2 mt-2">
                        <span>Total {{ $isPaid ? 'Paid' : 'Due' }}</span>
                        <span class="text-primary">${{ app('CustomHelper')->formatPrice($order->total) }}</span>
                    </div>

                    @if(!$isPaid)
                        @if($order->payment_method === 'bank_transfer')
                        <div class="alert alert-info mt-3 mb-0 small">
                            <i class="fas fa-university me-2"></i>
                            <strong>Bank Transfer Instructions</strong><br>
                            Please transfer <strong>${{ app('CustomHelper')->formatPrice($order->total) }}</strong> to:<br>
                            <span class="ms-2"><strong>Bank:</strong> Republic Bank Trinidad</span><br>
                            <span class="ms-2"><strong>Account Name:</strong> Mobile Market TT Ltd.</span><br>
                            <span class="ms-2"><strong>Account Number:</strong> 123-456-789-0</span><br>
                            <span class="ms-2"><strong>Reference:</strong> {{ $order->order_no }}</span><br>
                            Your order will be processed once payment is confirmed.
                        </div>
                        @elseif($order->payment_method === 'cheque')
                        <div class="alert alert-info mt-3 mb-0 small">
                            <i class="fas fa-file-alt me-2"></i>
                            <strong>Cheque Payment Instructions</strong><br>
                            Please make your cheque payable to <strong>Mobile Market TT Ltd.</strong> for
                            <strong>${{ app('CustomHelper')->formatPrice($order->total) }}</strong>.<br>
                            Write your order number <strong>{{ $order->order_no }}</strong> on the back.<br>
                            Mail or deliver to our office. Your order will be dispatched on clearance.
                        </div>
                        @elseif($order->payment_method === 'cash_on_delivery')
                        <div class="alert alert-success mt-3 mb-0 small">
                            <i class="fas fa-truck me-2"></i>
                            <strong>Cash on Delivery</strong><br>
                            Your order is confirmed! Please have <strong>${{ app('CustomHelper')->formatPrice($order->total) }}</strong>
                            ready in cash when your delivery arrives. Our team will contact you to confirm the delivery time.
                        </div>
                        @else
                        <div class="alert alert-info mt-3 mb-0 small">
                            <i class="fas fa-info-circle me-1"></i>
                            Your order is confirmed. Payment is pending — please follow the instructions for your chosen payment method.
                        </div>
                        @endif
                    @endif
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

                {{-- tier upgrade celebration --}}
                @if ($tier_helper->tier_upgraded > 0)
                <div class="border border-primary rounded p-4 mb-4 text-center" style="background:linear-gradient(135deg,#f0f7ff,#e8f4e8);">
                    <i class="fas fa-trophy fa-3x text-primary mb-3 d-block"></i>
                    <h4 class="text-primary mb-1">Tier Upgrade!</h4>
                    <p class="mb-0 text-muted">You've reached <strong class="text-primary">{{ Str::ucfirst($tier_helper->tier->title) }}</strong>. Enjoy your new benefits!</p>
                </div>
                @endif

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
