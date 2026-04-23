@extends('layouts.app')

@section('title', 'MMTT | My Rewards')

@section('content')

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">My Rewards</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active text-white">Tiers</li>
    </ol>
</div>

<x-mylayouts.inner-layout-user>
    @include('pages.additional.tiers.user-tier-design-main')
</x-mylayouts.inner-layout-user>

@endsection
