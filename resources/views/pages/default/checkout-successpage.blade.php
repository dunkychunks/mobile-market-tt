@extends('layouts.app')

@section('content')

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Order Confirmed</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active text-white">Success</li>
    </ol>
</div>
<div class="container-fluid py-5">
    <div class="container py-5 text-center">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <i class="bi bi-check-circle display-1 text-primary mb-4"></i>

                <h1 class="mb-4">Your Purchase was <b>Successful</b></h1>
                <p class="mb-4">Thank you for purchasing from Mobile Market TT. We have received your order and will begin processing it shortly.</p>

                <a href="{{ route('shop.index') }}" class="btn border-secondary rounded-pill py-3 px-5 text-primary">
                    Return to Store
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
