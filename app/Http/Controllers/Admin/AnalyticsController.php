<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index()
    {
        $ordersByMonth = Order::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total) as total_amount, COUNT(*) as order_count')
            ->groupBy('month')
            ->orderBy('month')
            ->take(12)
            ->get();

        $topCategories = Category::withCount('products')
            ->orderByDesc('products_count')
            ->take(5)
            ->get();

        $bestSellingProducts = Product::with('category')
            ->withCount(['orderItems as sold_qty' => function ($query) {
                $query->selectRaw('COALESCE(SUM(qty), 0)');
            }])
            ->orderByDesc('sold_qty')
            ->take(5)
            ->get();

        $today = Carbon::today();
        $todayRevenue = Order::whereDate('created_at', $today)->sum('total');
        $todayOrders = Order::whereDate('created_at', $today)->count();

        return view('admin.analytics.index', compact(
            'ordersByMonth',
            'topCategories',
            'bestSellingProducts',
            'todayRevenue',
            'todayOrders'
        ));
    }
}
