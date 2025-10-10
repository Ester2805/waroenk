<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CheckoutController; // PASTIKAN INI ADA!

// ====================================================================
// AUTHENTICATION ROUTES
// ====================================================================

// Register routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Logout route
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('landing');
})->name('logout');


// ====================================================================
// E-COMMERCE & UTILITY ROUTES
// ====================================================================

// Route Keranjang (Cart)
Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');

// Route Checkout (YANG HILANG)
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/order/success', function () {
    return view('order.success');
})->name('order.success');


// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');


// ====================================================================
// LANDING PAGE
// ====================================================================

Route::get('/', function () {
    return view('landing');
})->name('landing');
