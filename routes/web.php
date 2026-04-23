<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CheckoutPaymentController;
use App\Http\Controllers\CheckoutSuccessController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StaticController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\tiers\TierController;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

Route::get('/shop', [ProductController::class, 'index'])->name('shop.index');
Route::get('/store', [ProductController::class, 'index'])->name('store.index');

Route::get('/details/{id}', [DetailController::class, 'index'])->name('shop.details');
Route::get('/store/details/{id}', [DetailController::class, 'index'])->name('store.details');

Route::get('/search', [SearchController::class, 'index'])->name('search');

// static info pages
Route::get('/contact', [StaticController::class, 'contact'])->name('contact');
Route::get('/about', [StaticController::class, 'about'])->name('about');
Route::get('/privacy', [StaticController::class, 'privacy'])->name('privacy');
Route::get('/terms', [StaticController::class, 'terms'])->name('terms');

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::put('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart/add/{id}', [CartController::class, 'addToCartFromStore'])->name('cart.addfromstorepage');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/points', [CheckoutController::class, 'points'])->name('checkout.points');

    // Handles the outbound redirect to the payment provider
    Route::get('/checkout/payment/{payment}', [CheckoutPaymentController::class, 'index'])
        ->name('checkout.payment.index');

    // Handles the inbound return from the payment provider with the dynamic session ID
    Route::get('/checkout/success/{id}', [CheckoutSuccessController::class, 'index'])
        ->name('checkout.success');
});

include('filament-routes.php');

Route::prefix('user')->middleware(['auth'])->name('user.')->group(function () {
    Route::get('/tiers', [TierController::class, 'index'])->name('tiers.index');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/orders', [UserController::class, 'orders'])->name('orders.index');
});
