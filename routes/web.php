<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;

// Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LogixZnController::class, 'login'])->name('login.post');

// Logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('landing');
})->name('logout');

// Landing Page (sebelum login)
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Home (setelah login)
Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');



Route::get('/keranjang', [CartController::class, 'index']);