@extends('layouts.app')

@section('content')
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5">
                <div class="bg-light rounded p-4 p-md-5">
                    <h2 class="mb-4 text-center">Login</h2>
                    <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Email Address') }}</label>
        <input id="email" type="email"
               class="form-control @error('email') is-invalid @enderror"
               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">{{ __('Password') }}</label>
        <input id="password" type="password"
               class="form-control @error('password') is-invalid @enderror"
               name="password" required autocomplete="current-password">
        @error('password')
            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
        @enderror
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
        </div>

        @if (Route::has('password.request'))
            <a class="small text-primary" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
        @endif
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary rounded-pill py-2">{{ __('Login') }}</button>
        <a class="btn btn-outline-secondary rounded-pill py-2" href="{{ route('register') }}">Create an account</a>
    </div>
</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
