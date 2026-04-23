@extends('layouts.app')

@section('title', 'MMTT | Message Sent')

@section('content')

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Message Sent</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('contact') }}" class="text-white-50">Contact</a></li>
        <li class="breadcrumb-item active text-white">Thank You</li>
    </ol>
</div>

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">

                <i class="fas fa-envelope-open-text fa-4x text-primary mb-4 d-block"></i>
                <h2 class="mb-3">Thank you for reaching out!</h2>
                <p class="text-muted mb-5">
                    We've received your message and will get back to you within 1–2 business days.
                    In the meantime, feel free to explore our store.
                </p>

                <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                    <a href="{{ route('shop.index') }}" class="btn btn-primary rounded-pill px-5 py-2">
                        <i class="fas fa-store me-2"></i> Browse Products
                    </a>
                    <a href="{{ route('contact') }}" class="btn border border-secondary rounded-pill px-5 py-2 text-primary">
                        <i class="fas fa-envelope me-2"></i> Send Another Message
                    </a>
                    <a href="{{ route('home') }}" class="btn border border-secondary rounded-pill px-5 py-2 text-muted">
                        <i class="fas fa-home me-2"></i> Home
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
