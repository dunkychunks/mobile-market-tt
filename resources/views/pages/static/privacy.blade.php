@extends('layouts.app')

@section('title', 'MMTT | Privacy Policy')

@section('content')

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Privacy Policy</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active text-white">Privacy Policy</li>
    </ol>
</div>

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="mb-4">
                    <p class="text-muted">Last updated: January 2026</p>
                    <p class="text-muted">
                        This Privacy Policy explains how Mobile Market TT collects, uses, and protects
                        any information you provide when you use this website. This is a student project
                        and no personal data is used for any commercial purpose.
                    </p>
                </div>

                <div class="mb-4">
                    <h5 class="text-primary">Information We Collect</h5>
                    <p class="text-muted">
                        We collect your name, email address, and order details when you register and
                        place an order. Payment details are processed securely through Stripe and we
                        do not store any card information on our servers.
                    </p>
                </div>

                <div class="mb-4">
                    <h5 class="text-primary">How We Use Your Information</h5>
                    <ul class="text-muted">
                        <li>To process and fulfil your orders</li>
                        <li>To manage your loyalty points and tier status</li>
                        <li>To send order confirmation emails</li>
                        <li>To improve the application experience</li>
                    </ul>
                </div>

                <div class="mb-4">
                    <h5 class="text-primary">Data Security</h5>
                    <p class="text-muted">
                        We take reasonable precautions to protect your information. Passwords are
                        encrypted and payment data is handled entirely by Stripe's secure infrastructure.
                    </p>
                </div>

                <div class="mb-4">
                    <h5 class="text-primary">Cookies</h5>
                    <p class="text-muted">
                        This application uses session cookies to keep you logged in and maintain your
                        cart. No third-party tracking cookies are used.
                    </p>
                </div>

                <div>
                    <h5 class="text-primary">Contact</h5>
                    <p class="text-muted">
                        If you have questions about this policy, please use the
                        <a href="{{ route('contact') }}" class="text-primary">Contact page</a>.
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
