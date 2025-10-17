<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status');

        $orders = Order::with('items.product')
            ->when($status, fn($query) => $query->where('status', $status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $summary = [
            'total_orders' => Order::count(),
            'unpaid' => Order::where('status', 'belum bayar')->count(),
            'pending' => Order::where('status', 'pending')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'revenue' => Order::where('status', 'completed')->sum('total'),
        ];

        return view('admin.sales.index', compact('orders', 'summary', 'status'));
    }

    public function update(Request $request, Order $order)
    {
        $allowedStatuses = ['belum bayar', 'pending', 'diproses', 'dikirim', 'completed'];

        $data = $request->validate([
            'status' => 'required|in:' . implode(',', $allowedStatuses),
        ]);

        $order->update(['status' => $data['status']]);

        return redirect()->back()->with('success', 'Status pesanan #' . $order->id . ' berhasil diperbarui.');
    }
}
