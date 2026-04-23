@extends('layouts.app')

@section('title', 'MMTT | Profile')

@section('content')

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">My Profile</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active text-white">Profile</li>
    </ol>
</div>

<x-mylayouts.inner-layout-user>

    <h3 class="text-primary mb-1">My Profile</h3>
    <p class="text-muted mb-4">Your account details and loyalty status at a glance.</p>
    <hr class="border-secondary mb-4">

    {{-- account info --}}
    <div class="border border-secondary rounded p-4 mb-4">
        <h5 class="text-primary mb-3"><i class="fas fa-user me-2"></i>Account Information</h5>

        <div class="d-flex justify-content-between mb-2">
            <span class="text-muted">Name</span>
            <strong>{{ $user->name }}</strong>
        </div>
        <div class="d-flex justify-content-between mb-2">
            <span class="text-muted">Email</span>
            <strong>{{ $user->email }}</strong>
        </div>
        <div class="d-flex justify-content-between">
            <span class="text-muted">Member Since</span>
            <strong>{{ $user->created_at->format('d M Y') }}</strong>
        </div>
    </div>

    {{-- loyalty summary --}}
    <div class="border border-secondary rounded p-4 mb-4">
        <h5 class="text-primary mb-3"><i class="fas fa-star me-2"></i>Loyalty Summary</h5>

        <div class="d-flex justify-content-between mb-2">
            <span class="text-muted">Points Balance</span>
            <strong class="text-primary">{{ number_format($user->points_balance) }} pts</strong>
        </div>
        <div class="d-flex justify-content-between mb-2">
            <span class="text-muted">Current Tier</span>
            <strong class="text-primary">{{ $tier_helper->tier ? Str::ucfirst($tier_helper->tier->title) : 'None' }}</strong>
        </div>

        @if($tier_helper->tier && $tier_helper->hasNextTier())
            <div class="mt-3">
                <div class="d-flex justify-content-between mb-1">
                    <small class="text-muted">Progress to {{ $tier_helper->next_tier->title }}</small>
                    <small class="text-muted">{{ $tier_helper->next_tier_percent }}%</small>
                </div>
                <div class="progress rounded-pill" style="height:10px;">
                    <div class="progress-bar bg-secondary" style="width:{{ $tier_helper->next_tier_percent }}%"></div>
                </div>
                <small class="text-muted">Spend ${{ app('CustomHelper')->formatPrice($tier_helper->next_tier_amount) }} more to reach the next tier.</small>
            </div>
        @endif
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('user.tiers.index') }}" class="btn border border-secondary rounded-pill px-4 text-primary">
            <i class="fas fa-trophy me-2"></i>View Tiers
        </a>
        <a href="{{ route('user.orders.index') }}" class="btn border border-secondary rounded-pill px-4 text-primary">
            <i class="fas fa-receipt me-2"></i>Order History
        </a>
    </div>

</x-mylayouts.inner-layout-user>

@endsection
