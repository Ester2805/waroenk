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
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ShippingOptionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

Route::middleware(['web'])->group(function () {

    // ---------------- Landing Page ----------------
    Route::get('/', [HomeController::class, 'landing'])->name('landing');
    Route::get('/home', [HomeController::class, 'catalog'])->name('home');
    Route::view('/about', 'about')->name('about');

    // ---------------- Produk ----------------
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/{product}', [ProductController::class, 'show'])->name('show');
    });

    // ---------------- Keranjang ----------------
    Route::prefix('cart')->name('cart.')->middleware(['auth', 'customer'])->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{id}', [CartController::class, 'add'])->name('add');
        Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('remove');
        Route::patch('/update/{id}', [CartController::class, 'update'])->name('update');

        Route::get('/checkout', [CartController::class, 'showCheckout'])->name('checkout.show');
        Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
    });

    // ---------------- Riwayat Pesanan ----------------
    Route::prefix('orders')->name('orders.')->middleware(['auth', 'customer'])->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/{id}', [OrderController::class, 'show'])->name('show');
        Route::post('/{order}/items/{item}/rate', [OrderController::class, 'rateItem'])->name('items.rate');
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

        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

        // Admin routes (hanya untuk admin)
        Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('dashboard');
            Route::resource('products', AdminProductController::class)->except(['show']);
            Route::resource('categories', AdminCategoryController::class)->except(['show']);
            Route::get('analytics', [AnalyticsController::class, 'index'])->name('analytics.index');
            Route::get('sales', [SalesController::class, 'index'])->name('sales.index');
            Route::patch('sales/{order}', [SalesController::class, 'update'])->name('sales.update');
            Route::get('reports', [ReportsController::class, 'index'])->name('reports.index');
            Route::resource('users', AdminUserController::class)->only(['index', 'update']);
            Route::resource('shipping-options', ShippingOptionController::class)->except(['show']);
        });
    });
});
