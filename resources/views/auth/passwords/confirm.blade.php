@extends('layouts.app')

@section('content')
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5">
                <div class="bg-light rounded p-4 p-md-5">
                    <h2 class="mb-4 text-center">Confirm Password</h2>
                    <p class="text-muted mb-4">{{ __('Please confirm your password before continuing.') }}</p>

<form method="POST" action="{{ route('password.confirm') }}">
    @csrf

    <div class="mb-4">
        <label for="password" class="form-label">{{ __('Password') }}</label>
        <input id="password" type="password"
               class="form-control @error('password') is-invalid @enderror"
               name="password" required autocomplete="current-password">
        @error('password')
            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
        @enderror
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary rounded-pill py-2">{{ __('Confirm Password') }}</button>
        @if (Route::has('password.request'))
            <a class="btn btn-outline-secondary rounded-pill py-2" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
        @endif
    </div>
</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
