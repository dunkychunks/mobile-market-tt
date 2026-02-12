@extends('layouts.app')

@section('content')

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Cart</h1>
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
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart_data as $data)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $data->getImage() }}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{ $data->title }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">${{ app('CustomHelper')->formatPrice($data->getPrice()) }}</p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <input type="text" class="form-control form-control-sm text-center border-0" value="{{ $data->pivot->quantity }}" readonly>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">${{ app('CustomHelper')->formatPrice($data->getCartQuantityPrice()) }}</p>
                                </td>
                                <td>
                                    <form action="{{ route('cart.destroy', ['id' => $data->pivot->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-md rounded-circle bg-light border mt-4" type="submit">
                                            <i class="fa fa-times text-danger"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0">${{ app('CustomHelper')->formatPrice($cart_data->getSubtotal()) }}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Shipping</h5>
                                <div class="">
                                    <p class="mb-0">Flat rate: $0.00</p>
                                </div>
                            </div>
                            <p class="mb-0 text-end"></p>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4">${{ app('CustomHelper')->formatPrice($cart_data->getTotal()) }}</p>
                        </div>
                        <a href="{{ route('checkout.index') }}" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Proceed Checkout</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
