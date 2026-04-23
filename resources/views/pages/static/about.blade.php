@extends('layouts.app')

@section('title', 'MMTT | About')

@section('content')

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">About Us</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active text-white">About</li>
    </ol>
</div>

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center mb-5">
            <div class="col-lg-6">
                <h2 class="mb-4">The Mobile Market TT</h2>
                <p class="text-muted mb-3">
                    The Mobile Market TT is an undergraduate project developed as part of an e-commerce
                    web application module. It is a fresh produce marketplace designed specifically
                    for the Trinidadian context.
                </p>
                <p class="text-muted mb-3">
                    Our platform bridges the gap between traditional markets and modern convenience,
                    offering an efficient way to browse, order, and receive fresh fruits and vegetables
                    across Trinidad.
                </p>
                <p class="text-muted">
                    A key feature is our gamification engine — shoppers earn loyalty points with every
                    purchase and progress through tiers that unlock exclusive benefits and early access
                    to new products.
                </p>
            </div>
            <div class="col-lg-6">
                <div class="row g-4">
                    <div class="col-6">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-3 mx-auto">
                                <i class="fas fa-truck-moving fa-2x text-white"></i>
                            </div>
                            <h6>Nationwide Delivery</h6>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-3 mx-auto">
                                <i class="fas fa-trophy fa-2x text-white"></i>
                            </div>
                            <h6>Loyalty Rewards</h6>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-3 mx-auto">
                                <i class="fas fa-leaf fa-2x text-white"></i>
                            </div>
                            <h6>Fresh Produce</h6>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-3 mx-auto">
                                <i class="fas fa-shield-alt fa-2x text-white"></i>
                            </div>
                            <h6>Secure Payments</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="border border-secondary rounded p-4">
                    <h5 class="text-primary mb-3">Project Details</h5>
                    <p class="text-muted mb-1"><strong>Project Title:</strong> The Mobile Market TT — A Gamified Fresh Produce E-Commerce Platform</p>
                    <p class="text-muted mb-1"><strong>Type:</strong> Undergraduate Final Year Project</p>
                    <p class="text-muted mb-0"><strong>Technology:</strong> Laravel 11, MySQL, Stripe Payments, Bootstrap 5</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
