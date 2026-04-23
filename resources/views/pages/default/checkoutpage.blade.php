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

                    {{--
                        Points Redemption Rules (viva talking point):
                          100 pts = $1 | Min 500 pts | Max 50% of subtotal
                        Server-side validation mirrors these rules in CheckoutController::submit().
                    --}}
                    @if($pointsBalance >= 500)
                    <div class="border border-secondary rounded p-3 mb-4">
                        <h5 class="text-primary mb-2">
                            <i class="fas fa-star me-2 text-secondary"></i>Redeem Loyalty Points
                        </h5>
                        <p class="text-muted small mb-2">
                            Balance: <strong class="text-primary">{{ number_format($pointsBalance) }} pts</strong>
                            &mdash; 100 pts = $1 off &mdash; min 500 pts &mdash; max 50% of subtotal
                        </p>
                        <div class="input-group input-group-sm">
                            <input type="number" name="points_to_redeem" id="points_to_redeem"
                                   class="form-control" min="0" step="100"
                                   placeholder="e.g. 500"
                                   value="{{ old('points_to_redeem', 0) }}"
                                   max="{{ $pointsBalance }}">
                            <span class="input-group-text">pts</span>
                            <span class="input-group-text text-primary fw-semibold" id="pts-discount">= $0.00 off</span>
                        </div>
                    </div>
                    @else
                    <input type="hidden" name="points_to_redeem" value="0">
                    @endif

                    {{-- shipping method --}}
                    @php
                        $isTier3 = Auth::user()->load('tier')->tier?->title === 'Tier 3';
                        // Default selection: first shipping option the current user can actually use
                        $defaultShippingId = old('shipping_id', $shippings->first(fn($s) => $isTier3 || (float)$s->price > 0)?->id ?? $shippings->first()?->id);
                    @endphp
                    <div class="border border-secondary rounded p-3 mb-4">
                        <h5 class="text-primary mb-3">Shipping Method</h5>
                        @foreach($shippings as $shipping)
                        @php $isFreeExpress = (float) $shipping->price === 0.0; @endphp
                        <div class="form-check mb-2">
                            <input class="form-check-input shipping-radio" type="radio"
                                   name="shipping_id" id="ship_{{ $shipping->id }}"
                                   value="{{ $shipping->id }}"
                                   data-price="{{ $shipping->price }}"
                                   data-tier3-only="{{ $isFreeExpress ? '1' : '0' }}"
                                   {{ (string)$defaultShippingId === (string)$shipping->id ? 'checked' : '' }}>
                            <label class="form-check-label" for="ship_{{ $shipping->id }}">
                                <span class="fw-semibold">{{ $shipping->title }}</span>
                                <span class="text-muted ms-2">
                                    {{ $shipping->price > 0 ? '$'.number_format($shipping->price, 2) : 'Free' }}
                                </span>
                                @if($isFreeExpress && !$isTier3)
                                    <span class="badge bg-secondary ms-1" style="font-size:0.65rem;">Tier 3</span>
                                @endif
                            </label>
                        </div>
                        @endforeach
                        @error('shipping_id')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- totals --}}
                    <div class="border border-secondary rounded p-3 mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal</span>
                            <span>${{ app('CustomHelper')->formatPrice($cart_data->getSubtotal()) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Shipping</span>
                            <span id="shipping-display" class="fw-semibold">—</span>
                        </div>
                        @if($pointsBalance >= 500)
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Points Discount</span>
                            <span id="points-discount-display" class="text-success fw-semibold">—</span>
                        </div>
                        @endif
                        <div class="d-flex justify-content-between fw-bold border-top border-secondary pt-2">
                            <span>Estimated Total</span>
                            <span class="text-primary" id="total-display">${{ app('CustomHelper')->formatPrice($cart_data->getSubtotal()) }}</span>
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

@push('scripts')
<script>
    (function () {
        const subtotal   = {{ $cart_data->getSubtotal() }};
        const isTier3    = {{ $isTier3 ? 'true' : 'false' }};
        const radios     = document.querySelectorAll('.shipping-radio');
        const shipEl     = document.getElementById('shipping-display');
        const totalEl    = document.getElementById('total-display');
        const ptsInput    = document.getElementById('points_to_redeem');
        const ptsDisplay  = document.getElementById('pts-discount');
        const ptsDscLine  = document.getElementById('points-discount-display');

        function fmt(n) {
            return '$' + parseFloat(n).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }

        function getPointsDiscount() {
            if (!ptsInput) return 0;
            const pts = parseInt(ptsInput.value, 10) || 0;
            return pts >= 500 ? pts / 100 : 0;
        }

        function update() {
            const checked = document.querySelector('.shipping-radio:checked');
            if (!checked) return;

            if (!isTier3 && checked.dataset.tier3Only === '1') {
                // Revert to first shipping option the user can actually use
                const fallback = Array.from(radios).find(r => r.dataset.tier3Only !== '1');
                if (fallback) fallback.checked = true;
                alert('Free Express Shipping is a Tier 3 benefit. Spend $1,000 to unlock.');
                update();
                return;
            }

            const shipPrice = parseFloat(checked.dataset.price) || 0;
            const ptsDsc    = getPointsDiscount();

            shipEl.textContent  = shipPrice > 0 ? fmt(shipPrice) : 'Free';
            totalEl.textContent = fmt(Math.max(0, subtotal + shipPrice - ptsDsc));

            if (ptsDisplay) {
                ptsDisplay.textContent = ptsDsc > 0 ? '= ' + fmt(ptsDsc) + ' off' : '= $0.00 off';
            }
            if (ptsDscLine) {
                ptsDscLine.textContent = ptsDsc > 0 ? '−' + fmt(ptsDsc) : '—';
            }
        }

        radios.forEach(r => r.addEventListener('change', update));
        if (ptsInput) ptsInput.addEventListener('input', update);
        update();
    })();
</script>
@endpush

@endsection
