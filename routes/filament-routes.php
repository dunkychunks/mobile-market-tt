<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/admin/logout', function (Request $request) {
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('filament.admin.auth.logout');
