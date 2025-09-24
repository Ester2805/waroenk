<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

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

// Landing Page (for guests and authenticated users)
// Both logged-in and logged-out users will be directed to this page.
Route::get('/', function () {
    return view('landing');
})->name('landing');
