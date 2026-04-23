@extends('layouts.app')

@section('title', 'MMTT | Terms & Conditions')

@section('content')

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Terms &amp; Conditions</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active text-white">Terms</li>
    </ol>
</div>

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="mb-4">
                    <p class="text-muted">Last updated: January 2026</p>
                    <p class="text-muted">
                        By using Mobile Market TT, you agree to the following terms. Please read them carefully.
                        This is a student project application and these terms are for demonstration purposes.
                    </p>
                </div>

                <div class="mb-4">
                    <h5 class="text-primary">1. Use of the Platform</h5>
                    <p class="text-muted">
                        You must be at least 18 years old to create an account. You agree to provide
                        accurate information during registration and to keep your account credentials
                        secure.
                    </p>
                </div>

                <div class="mb-4">
                    <h5 class="text-primary">2. Orders and Payments</h5>
                    <p class="text-muted">
                        All orders are subject to availability. Payments are processed through Stripe.
                        Once an order is confirmed, it cannot be cancelled unless otherwise arranged.
                        Prices are shown in TTD equivalent and are subject to change.
                    </p>
                </div>

                <div class="mb-4">
                    <h5 class="text-primary">3. Returns and Refunds</h5>
                    <p class="text-muted">
                        Due to the perishable nature of fresh produce, we do not accept returns. If
                        you receive an item that is damaged or incorrect, please contact us within
                        24 hours and we will arrange a replacement or credit.
                    </p>
                </div>

                <div class="mb-4">
                    <h5 class="text-primary">4. Loyalty Points and Tiers</h5>
                    <p class="text-muted">
                        Points are awarded at 10 points per dollar spent. Tier upgrades are automatic
                        based on total spend. Points and tier status have no cash value and cannot
                        be transferred to another account.
                    </p>
                </div>

                <div>
                    <h5 class="text-primary">5. Limitation of Liability</h5>
                    <p class="text-muted">
                        Mobile Market TT is a student project and is provided as-is. We are not
                        liable for any losses arising from the use of this platform beyond the value
                        of a disputed order.
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
