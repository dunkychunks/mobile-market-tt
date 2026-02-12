@extends('layouts.app')

@section('content')
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5">
                <div class="bg-light rounded p-4 p-md-5">
                    <h2 class="mb-4 text-center">Reset Password</h2>
                    @if (session('status'))
    <div class="alert alert-success" role="alert">{{ session('status') }}</div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="mb-4">
        <label for="email" class="form-label">{{ __('Email Address') }}</label>
        <input id="email" type="email"
               class="form-control @error('email') is-invalid @enderror"
               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
        @enderror
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary rounded-pill py-2">{{ __('Send Password Reset Link') }}</button>
        <a class="btn btn-outline-secondary rounded-pill py-2" href="{{ route('login') }}">Back to login</a>
    </div>
</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
