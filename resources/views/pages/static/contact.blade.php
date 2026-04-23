@extends('layouts.app')

@section('title', 'MMTT | Contact')

@section('content')

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Contact Us</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active text-white">Contact</li>
    </ol>
</div>

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-6">
                <h2 class="mb-4">Get In Touch</h2>
                <p class="text-muted mb-4">
                    We'd love to hear from you. Whether you have a question about our products, delivery,
                    or anything else — our team is ready to answer.
                </p>

                <div class="d-flex mb-3">
                    <i class="fas fa-map-marker-alt text-primary me-3 mt-1"></i>
                    <div>
                        <h6 class="mb-1">Address</h6>
                        <span class="text-muted">Port of Spain, Trinidad and Tobago</span>
                    </div>
                </div>
                <div class="d-flex mb-3">
                    <i class="fas fa-envelope text-primary me-3 mt-1"></i>
                    <div>
                        <h6 class="mb-1">Email</h6>
                        <span class="text-muted">info@mobilemarket.tt</span>
                    </div>
                </div>
                <div class="d-flex mb-3">
                    <i class="fas fa-phone text-primary me-3 mt-1"></i>
                    <div>
                        <h6 class="mb-1">Phone</h6>
                        <span class="text-muted">+1 (868) 555-0100</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="border border-secondary rounded p-4">
                    <h5 class="text-primary mb-4">Send a Message</h5>
                    <form>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Your Name</label>
                            <input type="text" class="form-control" placeholder="Enter your name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subject</label>
                            <input type="text" class="form-control" placeholder="Enter subject">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" rows="5" placeholder="Your message..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary rounded-pill px-5">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
