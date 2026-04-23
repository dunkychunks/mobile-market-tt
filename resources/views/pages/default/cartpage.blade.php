@extends('layouts.app')

@section('title', 'MMTT | Cart')

@section('content')

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Shopping Cart</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active text-white">Cart</li>
    </ol>
</div>

<div class="container-fluid py-5">
    <div class="container py-5">

        @if ($cart_data->isEmpty())
            <x-core.cart-empty />
        @else
            <div class="row g-4">
                {{-- cart items table --}}
                <div class="col-lg-8">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th scope="col" colspan="2">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Total</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart_data as $data)
                                    <tr>
                                        <td style="width:70px;">
                                            <img src="{{ $data->getImage() }}" class="img-fluid rounded-circle"
                                                 style="width:60px;height:60px;object-fit:cover;" alt="">
                                        </td>
                                        <td>
                                            <p class="mb-0 fw-semibold">{{ $data->title }}</p>
                                            <small class="text-muted">{{ ucfirst($data->category) }}</small>
                                        </td>
                                        <td>${{ app('CustomHelper')->formatPrice($data->getPrice()) }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-1">
                                                <form action="{{ route('cart.update', ['id' => $data->pivot->id]) }}" method="POST" class="d-inline">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="quantity" value="{{ max(0, $data->pivot->quantity - 1) }}">
                                                    <button type="submit" class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </form>
                                                <span class="px-2 fw-semibold" style="min-width:2rem;text-align:center;">{{ $data->pivot->quantity }}</span>
                                                <form action="{{ route('cart.update', ['id' => $data->pivot->id]) }}" method="POST" class="d-inline">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="quantity" value="{{ $data->pivot->quantity + 1 }}">
                                                    <button type="submit" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="fw-semibold">
                                            ${{ app('CustomHelper')->formatPrice($data->getCartQuantityPrice()) }}
                                        </td>
                                        <td>
                                            <form action="{{ route('cart.destroy', ['id' => $data->pivot->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm rounded-circle bg-light border" type="submit" title="Remove">
                                                    <i class="fa fa-times text-danger"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('shop.index') }}" class="btn border border-secondary rounded-pill px-4 py-2 text-primary">
                            <i class="fa fa-arrow-left me-2"></i> Continue Shopping
                        </a>
                    </div>
                </div>

                {{-- order summary sidebar --}}
                <div class="col-lg-4">
                    <div class="border border-secondary rounded p-4" style="position: sticky; top: 100px;">
                        <h5 class="text-primary mb-4">Order Summary</h5>

                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Subtotal</span>
                            <span class="fw-semibold">${{ app('CustomHelper')->formatPrice($cart_data->getSubtotal()) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Shipping</span>
                            <span class="text-muted">Calculated at checkout</span>
                        </div>

                        <div class="border-top border-secondary pt-3 d-flex justify-content-between mb-4">
                            <span class="fw-bold fs-5">Total</span>
                            <span class="fw-bold fs-5 text-primary">
                                ${{ app('CustomHelper')->formatPrice($cart_data->getTotal()) }}
                            </span>
                        </div>

                        <a href="{{ route('checkout.index') }}"
                           class="btn btn-primary rounded-pill w-100 py-3 text-uppercase fw-semibold">
                            Proceed to Checkout
                        </a>
                        <a href="{{ route('shop.index') }}" class="btn border border-secondary rounded-pill w-100 py-2 text-primary mt-2">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>

@endsection
