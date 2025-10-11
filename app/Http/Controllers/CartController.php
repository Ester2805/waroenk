<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    // 🛒 Tampilkan isi keranjang
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.keranjang', ['items' => $cart]);
    }

    // ➕ Tambah produk ke keranjang
    public function add($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "quantity" => 1,
                "image" => $product->image ?? null,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // ✏️ Update jumlah produk di keranjang
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $quantity = max(1, (int) $request->quantity);
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Jumlah produk berhasil diperbarui!');
    }

    // ❌ Hapus produk dari keranjang
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    // 🧾 Tampilkan halaman checkout
    public function showCheckout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong!');
        }

        $total = 0;
        foreach ($cart as $id => $item) {
            $cart[$id]['subtotal'] = $item['price'] * $item['quantity'];
            $total += $cart[$id]['subtotal'];
        }

        $shipping_cost = 10000; // contoh ongkir default Rp10.000
        $grand_total = $total + $shipping_cost;

        return view('cart.checkout', compact('cart', 'total', 'shipping_cost', 'grand_total'));
    }

    // ✅ Simpan pesanan ke database
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong!');
        }

        $validated = $request->validate([
            'customer_name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string|max:50',
            'shipping_cost' => 'required|numeric|min:0',
        ]);

        $total = collect($cart)->reduce(fn($sum, $item) => $sum + ($item['price'] * $item['quantity']), 0);
        $grand_total = $total + $validated['shipping_cost'];

        // Simpan order
        $order = Order::create([
            'user_id' => auth()->id() ?? null,
            'customer_name' => $validated['customer_name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'payment_method' => $validated['payment_method'],
            'shipping_cost' => $validated['shipping_cost'],
            'total' => $grand_total,
            'status' => 'pending',
        ]);

        // Simpan item ke order_items
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'price' => $item['price'],
                'qty' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        session()->forget('cart');
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat!');
    }
}
