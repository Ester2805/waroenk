<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        $range = $request->get('range', '30');
        $days = (int) $range;

        $from = now()->subDays($days);

        $orders = Order::where('created_at', '>=', $from);
        $completedOrders = Order::where('status', 'completed')->where('created_at', '>=', $from);

        $report = [
            'range_days' => $days,
            'orders_count' => $orders->count(),
            'completed_count' => $completedOrders->count(),
            'revenue' => $completedOrders->sum('total'),
            'avg_order_value' => $completedOrders->avg('total'),
            'products_sold' => Product::with('category')
                ->withCount(['orderItems as sold_qty' => function ($query) use ($from) {
                    $query->where('created_at', '>=', $from)
                        ->selectRaw('COALESCE(SUM(qty), 0)');
                }])
                ->orderByDesc('sold_qty')
                ->take(10)
                ->get(),
        ];

        return view('admin.reports.index', compact('report', 'range'));
    }
}
