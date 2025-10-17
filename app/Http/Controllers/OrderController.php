<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Tampilkan semua pesanan
    public function index()
    {
        $orders = Order::with('items.product')
            ->where(function ($query) {
                $query->where('user_id', auth()->id())
                    ->orWhereNull('user_id');
            })
            ->latest()
            ->get();
        return view('orders.index', compact('orders'));
    }

    // Tampilkan detail satu pesanan
    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        if ($order->user_id && auth()->id() !== $order->user_id) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }

    public function rateItem(Request $request, Order $order, OrderItem $item)
    {
        if ($order->id !== $item->order_id) {
            abort(404);
        }

        if ($order->user_id && auth()->id() !== $order->user_id) {
            abort(403);
        }

        if ($order->status !== 'completed') {
            return redirect()->route('orders.show', $order->id)->with('error', 'Pesanan belum selesai, rating belum bisa diberikan.');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        $item->update([
            'rating' => $validated['rating'],
            'review' => $validated['review'] ?? null,
            'rated_at' => now(),
        ]);

        return redirect()->route('orders.show', $order->id)->with('success', 'Terima kasih, rating berhasil disimpan.');
    }
}
