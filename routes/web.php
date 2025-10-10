<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController; // 
use App\Models\Order;
use App\Http\Controllers\AdminController;

Route::middleware(['web'])->group(function () {

    // ---------------- Landing Page ----------------
    Route::get('/', function () {
        return view('landing');
    })->name('landing');

    // ---------------- Produk ----------------
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
    });

    // ---------------- Keranjang ----------------
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{id}', [CartController::class, 'add'])->name('add');
        Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('remove');
        Route::patch('/update/{id}', [CartController::class, 'update'])->name('update');
        
        Route::get('/checkout', [CartController::class, 'showCheckout'])->name('checkout.show');
        Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
    });

    // ---------------- Riwayat Pesanan ----------------
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/{id}', [OrderController::class, 'show'])->name('show');
    });

    // ---------------- Search ----------------
    Route::get('/search', [SearchController::class, 'index'])->name('search');

    // ---------------- Auth ----------------
    Route::middleware('guest')->group(function () {
        // Register
        Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

        // Login
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    });

    Route::middleware('auth')->group(function () {
        // Logout
        Route::post('/logout', function () {
            Auth::logout();
            return redirect()->route('landing');
        })->name('logout');

        // Admin routes (hanya untuk admin)
        Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('dashboard');
        });
    });
});
