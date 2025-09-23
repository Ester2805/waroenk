<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CartController;

// cart
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Register routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LogixZnController::class, 'login'])->name('login.post');

// Logout route
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('landing');
})->name('logout');

// Landing Page (for guests and authenticated users)
// Both logged-in and logged-out users will be directed to this page.
Route::get('/', function () {
    return view('landing');
})->name('landing');



Route::get('/keranjang', [CartController::class, 'index']);