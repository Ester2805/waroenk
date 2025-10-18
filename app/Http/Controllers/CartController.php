<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingOption;

class CartController extends Controller
{
    // Tampilkan isi keranjang
    public function index()
    {
        $cart = session()->get($this->getCartSessionKey(), []);
        return view('cart.keranjang', ['items' => $cart]);
    }

    // Tambah produk ke keranjang
    public function add($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get($this->getCartSessionKey(), []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            $cart[$id]['image'] = $product->image_url ?? $cart[$id]['image'];
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "quantity" => 1,
                "image" => $product->image_url ?? null,
            ];
        }

        session()->put($this->getCartSessionKey(), $cart);
        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // Update jumlah produk di keranjang
    public function update(Request $request, $id)
    {
        $cart = session()->get($this->getCartSessionKey(), []);

        if (isset($cart[$id])) {
            $quantity = max(1, (int) $request->quantity);
            $cart[$id]['quantity'] = $quantity;
            session()->put($this->getCartSessionKey(), $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Jumlah produk berhasil diperbarui!');
    }

    // Hapus produk dari keranjang
    public function remove($id)
    {
        $cart = session()->get($this->getCartSessionKey(), []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put($this->getCartSessionKey(), $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    // Tampilkan halaman checkout
    public function showCheckout(Request $request)
    {
        $cart = session()->get($this->getCartSessionKey(), []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong!');
        }

        $submitted = $request->boolean('submitted');
        $selected = $request->input('selected', []);

        if ($submitted && empty($selected)) {
            return redirect()->route('cart.index')->with('error', 'Pilih produk yang ingin di-checkout.');
        }

        if (!empty($selected)) {
            $cart = array_filter($cart, function ($value, $key) use ($selected) {
                return in_array((string)$key, array_map('strval', $selected), true);
            }, ARRAY_FILTER_USE_BOTH);
        }

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong!');
        }

        session([$this->getCheckoutSelectionKey() => array_keys($cart)]);

        $total = 0;
        foreach ($cart as $id => $item) {
            $cart[$id]['subtotal'] = $item['price'] * $item['quantity'];
            $total += $cart[$id]['subtotal'];
        }

        $shippingOptions = ShippingOption::where('is_active', true)->orderBy('name')->get();
        $selectedShippingOption = old('shipping_option');
        $shipping_cost = 0;
        $grand_total = $total;

        if ($selectedOption = $shippingOptions->firstWhere('id', $selectedShippingOption)) {
            $shipping_cost = (float) $selectedOption->additional_cost;
            $grand_total = $total + $shipping_cost;
        }

        return view('cart.checkout', compact('cart', 'total', 'shipping_cost', 'grand_total', 'shippingOptions', 'selectedShippingOption'));
    }

    // Simpan pesanan ke database
    public function checkout(Request $request)
    {
        $sessionCart = session()->get($this->getCartSessionKey(), []);
        $selectedIds = session()->get($this->getCheckoutSelectionKey(), []);

        $cart = $sessionCart;
        if (!empty($selectedIds)) {
            $cart = array_filter($sessionCart, function ($value, $key) use ($selectedIds) {
                return in_array((string)$key, array_map('strval', $selectedIds), true);
            }, ARRAY_FILTER_USE_BOTH);
        }

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong!');
        }

        $validated = $request->validate([
            'customer_name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'delivery_note' => 'nullable|string|max:255',
            'payment_method' => 'required|in:COD,Transfer Bank',
            'shipping_option' => 'required|exists:shipping_options,id',
        ]);

        $total = collect($cart)->reduce(fn($sum, $item) => $sum + ($item['price'] * $item['quantity']), 0);
        $shippingOption = ShippingOption::find($validated['shipping_option']);
        $shipping_cost = $shippingOption?->additional_cost ?? 0;
        $grand_total = $total + $shipping_cost;

        $virtualAccount = null;
        $status = 'pending';

        if ($validated['payment_method'] === 'Transfer Bank') {
            $status = 'belum bayar';
            $virtualAccount = $this->generateVirtualAccount();
        }

        // Simpan order
        $order = Order::create([
            'user_id' => auth()->id() ?? null,
            'customer_name' => $validated['customer_name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'delivery_note' => $validated['delivery_note'] ?? null,
            'payment_method' => $validated['payment_method'],
            'virtual_account' => $virtualAccount,
            'shipping_cost' => $shipping_cost,
            'total' => $grand_total,
            'status' => $status,
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

        $remainingCart = array_diff_key($sessionCart, $cart);
        session()->put($this->getCartSessionKey(), $remainingCart);
        session()->forget($this->getCheckoutSelectionKey());

        $message = 'Pesanan berhasil dibuat!';
        if ($virtualAccount) {
            $message .= ' Silakan lakukan pembayaran ke virtual account: ' . $virtualAccount . '. Pesanan akan diproses setelah pembayaran diterima.';
        }

        return redirect()->route('orders.show', $order->id)->with('success', $message);
    }

    private function generateVirtualAccount(): string
    {
        $prefix = '8801';
        $random = str_pad((string) random_int(0, 99999999), 8, '0', STR_PAD_LEFT);

        return $prefix . $random;
    }

    private function getCartSessionKey(): string
    {
        $userId = auth()->id();

        if ($userId) {
            return 'cart_' . $userId;
        }

        return 'cart_guest_' . session()->getId();
    }

    private function getCheckoutSelectionKey(): string
    {
        $userId = auth()->id();

        if ($userId) {
            return 'checkout_selected_' . $userId;
        }

        return 'checkout_selected_guest_' . session()->getId();
    }
}
