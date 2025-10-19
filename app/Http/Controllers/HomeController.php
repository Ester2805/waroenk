<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;

class HomeController extends Controller
{
    public function landing()
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        $categories = Category::orderBy('name')->get();
        $featuredProducts = Product::with('category')
            ->where('is_active', true)
            ->withSum(['orderItems as sold_total' => function ($relation) {
                $relation->whereHas('order', function ($orderQuery) {
                    $orderQuery->where('status', 'completed');
                });
            }], 'qty')
            ->withAvg(['orderItems as rating_avg' => function ($relation) {
                $relation->whereNotNull('rating')
                    ->whereHas('order', function ($orderQuery) {
                        $orderQuery->where('status', 'completed');
                    });
            }], 'rating')
            ->latest()
            ->take(8)
            ->get();

        return view('pages.landing', compact('categories', 'featuredProducts'));
    }

    public function catalog()
    {
        $categories = Category::orderBy('name')->get();
        $featuredProducts = Product::with('category')
            ->where('is_active', true)
            ->withSum(['orderItems as sold_total' => function ($relation) {
                $relation->whereHas('order', function ($orderQuery) {
                    $orderQuery->where('status', 'completed');
                });
            }], 'qty')
            ->withAvg(['orderItems as rating_avg' => function ($relation) {
                $relation->whereNotNull('rating')
                    ->whereHas('order', function ($orderQuery) {
                        $orderQuery->where('status', 'completed');
                    });
            }], 'rating')
            ->latest()
            ->take(12)
            ->get();

        $recentOrders = collect();
        if (auth()->check()) {
            $recentOrders = Order::where('user_id', auth()->id())
                ->latest()
                ->take(3)
                ->get();
        }

        return view('pages.home', compact('categories', 'featuredProducts', 'recentOrders'));
    }
}
