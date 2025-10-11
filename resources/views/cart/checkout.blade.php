<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checkout - Waroenk</title>
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f4f4f4; margin: 40px; color: #333; }
        .checkout-container { max-width: 800px; margin: 0 auto; background: #fff; padding: 24px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        h1 { text-align: center; color: #4CAF50; margin-bottom: 30px; }
        label { display: block; margin-top: 16px; font-weight: 600; }
        input, select, textarea { width: 100%; padding: 10px; margin-top: 6px; border: 1px solid #ccc; border-radius: 6px; }
        .btn { background: #4CAF50; color: #fff; border: none; padding: 12px 20px; border-radius: 6px; cursor: pointer; margin-top: 20px; }
        .btn:hover { background: #3e8e41; }
        .summary { background: #fafafa; padding: 16px; border-radius: 6px; margin-top: 20px; }
        .total { font-weight: bold; font-size: 18px; text-align: right; }
    </style>
</head>
<body>
    <div class="checkout-container">
        <h1>Checkout</h1>

        <form action="{{ route('cart.checkout') }}" method="POST">
            @csrf

            <label for="customer_name">Nama Lengkap:</label>
            <input type="text" id="customer_name" name="customer_name" required>

            <label for="phone">Nomor Telepon:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="address">Alamat Pengiriman:</label>
            <textarea id="address" name="address" rows="3" required placeholder="Masukkan alamat lengkap..."></textarea>

            <label for="payment_method">Metode Pembayaran:</label>
            <select id="payment_method" name="payment_method" required>
                <option value="COD">Bayar di Tempat (COD)</option>
                <option value="Transfer Bank">Transfer Bank</option>
                <option value="E-Wallet">E-Wallet</option>
            </select>

            <label for="shipping_cost">Ongkir (Rp):</label>
            <input type="number" id="shipping_cost" name="shipping_cost" value="{{ $shipping_cost }}" required>

            <div class="summary">
                <p>Subtotal Barang: Rp{{ number_format($total, 0, ',', '.') }}</p>
                <p>Ongkir: Rp{{ number_format($shipping_cost, 0, ',', '.') }}</p>
                <p class="total">Total Bayar: Rp{{ number_format($grand_total, 0, ',', '.') }}</p>
            </div>

            <button type="submit" class="btn">Konfirmasi Pesanan</button>
        </form>
    </div>
</body>
</html>
