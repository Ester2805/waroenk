@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<style>
    .order-container { max-width: 900px; margin: 40px auto; background: #fff; padding: 24px; border-radius: 12px; box-shadow: 0 4px 16px rgba(0,0,0,0.06); }
    .order-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
    .order-table th { background: #f5f7fa; font-weight: 600; }
    .order-table td, .order-table th { padding: 12px; }
    .rating-form { background: #f8fafc; border-radius: 10px; padding: 16px; margin-top: 12px; }
    .rating-display span { color: #facc15; }
</style>

<div class="order-container">
    <div class="order-header">
        <div>
            <h2 class="fw-bold mb-1">Detail Pesanan #{{ $order->id }}</h2>
            <p class="text-muted mb-0">Tanggal: {{ $order->created_at->format('d M Y, H:i') }}</p>
        </div>
        <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">← Kembali</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row mb-4">
        <div class="col-md-6">
            <h5 class="fw-semibold">Informasi Pengiriman</h5>
            <p class="mb-1"><strong>Status:</strong> @include('orders.partials.status-badge', ['status' => $order->status])</p>
            <p class="mb-1"><strong>Alamat:</strong> {{ $order->address }}</p>
            <p class="mb-1"><strong>Metode Pembayaran:</strong> {{ $order->payment_method ?? 'COD' }}</p>
            @if($order->delivery_note)
                <p class="mb-1"><strong>Catatan:</strong> {{ $order->delivery_note }}</p>
            @endif
            @if($order->virtual_account && in_array($order->status, ['belum bayar', 'pending']))
                <div class="alert alert-warning mt-2">
                    <strong>Nomor Virtual Account:</strong><br>
                    <code style="font-size:1.2rem;">{{ $order->virtual_account }}</code>
                    <p class="mb-0 mt-2">Selesaikan pembayaran dan hubungi admin agar pesanan diproses.</p>
                </div>
            @endif
        </div>
        <div class="col-md-6 text-md-end">
            <h5 class="fw-semibold">Ringkasan</h5>
            <p class="mb-1"><strong>Ongkir:</strong> Rp{{ number_format($order->shipping_cost ?? 0, 0, ',', '.') }}</p>
            <p class="fs-5 fw-bold">Total: Rp{{ number_format($order->total, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table order-table align-middle">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Rating</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ $item->product->name ?? 'Produk dihapus' }}</div>
                            @if($item->review)
                                <small class="text-muted">"{{ $item->review }}"</small>
                            @endif
                        </td>
                        <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        <td>
                            @if($item->rating)
                                <div class="rating-display">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span>{!! $i <= $item->rating ? '&#9733;' : '&#9734;' !!}</span>
                                    @endfor
                                    <div class="text-muted small">Diberi rating {{ $item->rating }}/5</div>
                                </div>
                            @elseif($order->status === 'completed')
                                <form class="rating-form js-rating-form" method="POST" action="{{ route('orders.items.rate', [$order->id, $item->id]) }}" data-item-id="{{ $item->id }}">
                                    @csrf
                                    <div class="mb-2">
                                        <label class="form-label">Beri rating produk ini</label>
                                        <select name="rating" class="form-select" required>
                                            <option value="">Pilih rating</option>
                                            @for($i = 5; $i >= 1; $i--)
                                                <option value="{{ $i }}">{{ $i }} - {{ ['Buruk','Kurang','Cukup','Bagus','Sangat Bagus'][$i-1] }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <textarea name="review" class="form-control" rows="2" placeholder="Tuliskan ulasan (opsional)"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm">Kirim Rating</button>
                                </form>
                            @else
                                <span class="text-muted small">Rating tersedia setelah pesanan selesai</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
