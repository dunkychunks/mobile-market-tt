@extends('layouts.app')

@section('content')
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5">
                <div class="bg-light rounded p-4 p-md-5">
                    <h2 class="mb-4 text-center">Verify Your Email</h2>
                    @if (session('resent'))
    <div class="alert alert-success" role="alert">
        {{ __('A fresh verification link has been sent to your email address.') }}
    </div>
@endif

<p class="mb-3">{{ __('Before proceeding, please check your email for a verification link.') }}</p>
<p class="mb-4">{{ __('If you did not receive the email') }},</p>

<form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
    @csrf
    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary rounded-pill py-2">{{ __('click here to request another') }}</button>
        <a class="btn btn-outline-secondary rounded-pill py-2" href="{{ route('home') }}">Back to home</a>
    </div>
</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
