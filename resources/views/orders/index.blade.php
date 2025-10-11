<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pesanan - Waroenk</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f4f4f4; margin: 40px; color: #333; }
        .container { max-width: 900px; margin: 0 auto; background: #fff; padding: 24px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        h1 { text-align: center; color: #4CAF50; margin-bottom: 24px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #fafafa; font-weight: 600; }
        tr:hover { background: #f9f9f9; }
        .status { padding: 6px 10px; border-radius: 5px; font-size: 13px; font-weight: 600; }
        .status.pending { background: #fff3cd; color: #856404; }
        .status.completed { background: #d4edda; color: #155724; }
        .status.cancelled { background: #f8d7da; color: #721c24; }
        .btn-detail {
            background: #4CAF50;
            color: #fff;
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 14px;
        }
        .btn-detail:hover { background: #3e8e41; }
        .empty { text-align: center; padding: 30px; color: #777; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Riwayat Pesanan Kamu</h1>

        @if($orders->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                            <td>Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                            <td><span class="status {{ strtolower($order->status) }}">{{ ucfirst($order->status) }}</span></td>
                            <td><a href="{{ route('orders.show', $order->id) }}" class="btn-detail">Lihat Detail</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty">
                <p>Belum ada pesanan 😢</p>
                <a href="{{ route('products.index') }}" class="btn-detail">Belanja Sekarang</a>
            </div>
        @endif
    </div>
</body>
</html>
