<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pesanan #{{ $order->id }} - Waroenk</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f4f4f4; margin: 40px; color: #333; }
        .container { max-width: 800px; margin: 0 auto; background: #fff; padding: 24px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        h1 { color: #4CAF50; text-align: center; margin-bottom: 24px; }
        .order-info { margin-bottom: 20px; line-height: 1.8; }
        .order-info strong { width: 150px; display: inline-block; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th, td { padding: 10px; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #fafafa; font-weight: 600; }
        tr:hover { background: #f9f9f9; }
        .total { text-align: right; font-size: 18px; font-weight: 600; margin-top: 16px; }
        .back { display: inline-block; background: #ddd; padding: 8px 12px; border-radius: 6px; text-decoration: none; color: #333; margin-top: 20px; }
        .back:hover { background: #ccc; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detail Pesanan #{{ $order->id }}</h1>

        <div class="order-info">
            <p><strong>Tanggal Pesanan:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Alamat:</strong> {{ $order->address }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $order->payment_method ?? 'COD' }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name ?? 'Produk dihapus' }}</td>
                        <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="total">Total Pembayaran: Rp{{ number_format($order->total, 0, ',', '.') }}</p>

        <a href="{{ route('orders.index') }}" class="back">← Kembali ke Riwayat Pesanan</a>
    </div>
</body>
</html>
