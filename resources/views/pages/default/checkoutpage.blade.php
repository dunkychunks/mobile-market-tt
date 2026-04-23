@extends('layouts.app')

@section('title', 'MMTT | Checkout')

@section('content')

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Checkout</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('cart.index') }}" class="text-white-50">Cart</a></li>
        <li class="breadcrumb-item active text-white">Checkout</li>
    </ol>
</div>

<div class="container-fluid py-5">
    <div class="container py-5">

        {{-- server-side validation errors --}}
        @if($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('checkout.submit') }}" method="POST" id="checkout-form">
            @csrf
            <div class="row g-5">
                {{-- billing details --}}
                <div class="col-md-12 col-lg-6 col-xl-7">
                    <h4 class="mb-4">Billing Details</h4>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">First Name <sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" placeholder="John">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Last Name <sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="Doe">
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Island / Country <sup class="text-danger">*</sup></label>
                        <select class="form-select" name="country">
                            <option value="Trinidad" {{ old('country') == 'Trinidad' ? 'selected' : '' }}>Trinidad</option>
                            <option value="Tobago" {{ old('country') == 'Tobago' ? 'selected' : '' }}>Tobago</option>
                            <option value="Barbados" {{ old('country') == 'Barbados' ? 'selected' : '' }}>Barbados</option>
                            <option value="Jamaica" {{ old('country') == 'Jamaica' ? 'selected' : '' }}>Jamaica</option>
                            <option value="USA" {{ old('country') == 'USA' ? 'selected' : '' }}>United States of America</option>
                            <option value="UK" {{ old('country') == 'UK' ? 'selected' : '' }}>United Kingdom</option>
                        </select>
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Address <sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control mb-2" name="address" value="{{ old('address') }}" placeholder="#1 Short Street">
                        <input type="text" class="form-control" name="address2" value="{{ old('address2') }}" placeholder="Apartment, Suite, Unit, etc. (optional)">
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Town / City <sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" name="city" value="{{ old('city') }}" placeholder="Port of Spain">
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Post Code / Zip</label>
                        <input type="text" class="form-control" name="postcode" value="{{ old('postcode') }}" placeholder="00000">
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <label class="form-label">Mobile <sup class="text-danger">*</sup></label>
                            <input type="tel" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="+1-868-123-1234">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email Address <sup class="text-danger">*</sup></label>
                            <input type="email" class="form-control" name="email" value="{{ old('email', Auth::user()->email) }}" placeholder="johndoe@mail.com">
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Order Notes (Optional)</label>
                        <textarea name="notes" class="form-control" rows="4" placeholder="Any special instructions...">{{ old('notes') }}</textarea>
                    </div>
                </div>

                {{-- order summary + payment --}}
                <div class="col-md-12 col-lg-6 col-xl-5">
                    <h4 class="mb-4">Your Order</h4>

                    {{-- order items --}}
                    <div class="border border-secondary rounded p-3 mb-4">
                        @foreach ($cart_data as $data)
                        <div class="d-flex justify-content-between align-items-center py-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                            <div class="d-flex align-items-center">
                                <img src="{{ $data->getImage() }}" class="rounded-circle me-2"
                                     style="width:40px;height:40px;object-fit:cover;" alt="">
                                <div>
                                    <p class="mb-0 fw-semibold small">{{ $data->title }}</p>
                                    <small class="text-muted">Qty: {{ $data->pivot->quantity }}</small>
                                </div>
                            </div>
                            <span class="fw-semibold">${{ app('CustomHelper')->formatPrice($data->getCartQuantityPrice()) }}</span>
                        </div>
                        @endforeach
                    </div>

                    {{-- totals --}}
                    <div class="border border-secondary rounded p-3 mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal</span>
                            <span>${{ app('CustomHelper')->formatPrice($cart_data->getSubtotal()) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Shipping</span>
                            <span class="text-muted">Calculated by provider</span>
                        </div>
                        <div class="d-flex justify-content-between fw-bold border-top border-secondary pt-2">
                            <span>Estimated Total</span>
                            <span class="text-primary">${{ app('CustomHelper')->formatPrice($cart_data->getTotal()) }}</span>
                        </div>
                    </div>

                    {{-- payment method --}}
                    <div class="border border-secondary rounded p-3 mb-4">
                        <h5 class="text-primary mb-3">Payment Method</h5>

                        <div class="mb-3">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="pm_credit_card"
                                       value="credit_card" {{ old('payment_method') == 'credit_card' ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="pm_credit_card">
                                    <i class="fas fa-credit-card me-2 text-primary"></i> Credit Card (via Stripe)
                                </label>
                            </div>
                            <p class="text-muted small ms-4 mb-3">Pay securely online. You will be redirected to Stripe to complete your payment.</p>

                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="pm_bank_transfer"
                                       value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="pm_bank_transfer">
                                    <i class="fas fa-university me-2 text-primary"></i> Bank Transfer
                                </label>
                            </div>
                            <p class="text-muted small ms-4 mb-3">Transfer directly to our bank account using your order number as the reference.</p>

                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="pm_cheque"
                                       value="cheque" {{ old('payment_method') == 'cheque' ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="pm_cheque">
                                    <i class="fas fa-file-alt me-2 text-primary"></i> Cheque
                                </label>
                            </div>
                            <p class="text-muted small ms-4 mb-3">Make your cheque payable to Mobile Market TT. Your order will be processed on clearance.</p>

                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="pm_cash"
                                       value="cash_on_delivery" {{ old('payment_method') == 'cash_on_delivery' ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="pm_cash">
                                    <i class="fas fa-money-bill-wave me-2 text-primary"></i> Cash on Delivery
                                </label>
                            </div>
                            <p class="text-muted small ms-4 mb-0">Pay in cash when your order arrives.</p>
                        </div>
                    </div>

                    {{-- terms checkbox --}}
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input @error('terms') is-invalid @enderror"
                                   type="checkbox" name="terms" id="terms" value="1"
                                   {{ old('terms') ? 'checked' : '' }}>
                            <label class="form-check-label" for="terms">
                                I have read and accept the
                                <a href="{{ route('terms') }}" target="_blank" class="text-primary">Terms &amp; Conditions</a>
                            </label>
                            @error('terms')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary rounded-pill w-100 py-3 text-uppercase fw-semibold">
                        Place Order
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>

@endsection
