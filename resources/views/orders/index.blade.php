@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

@section('content')
<style>
    .orders-page {
        background: radial-gradient(circle at top left, rgba(102, 187, 106, 0.12), transparent 55%),
            radial-gradient(circle at bottom right, rgba(46, 125, 50, 0.12), transparent 55%),
            #f4f7fb;
        min-height: calc(100vh - 120px);
        padding: clamp(48px, 8vw, 80px) clamp(16px, 4vw, 48px) clamp(64px, 12vw, 120px);
    }

    .orders-hero {
        display: flex;
        flex-direction: column;
        gap: 18px;
        background: linear-gradient(135deg, rgba(46, 125, 50, 0.08), rgba(102, 187, 106, 0.16));
        padding: clamp(24px, 4vw, 40px);
        border-radius: 24px;
        box-shadow: 0 18px 48px rgba(15, 23, 42, 0.08);
        margin-bottom: clamp(24px, 4vw, 36px);
    }

    .orders-hero h1 {
        margin: 0;
        font-weight: 700;
        color: #1f2933;
    }

    .orders-table-card {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(15, 23, 42, 0.08);
        overflow: hidden;
    }

    .orders-empty-card {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(15, 23, 42, 0.08);
        padding: clamp(40px, 6vw, 64px);
    }

    .orders-empty-icon {
        width: 78px;
        height: 78px;
        border-radius: 20px;
        background: rgba(46, 125, 50, 0.12);
        color: #2e7d32;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin: 0 auto 16px;
    }

    .btn-outline-success {
        border-radius: 999px;
        padding: 10px 24px;
        border-width: 2px;
    }

    .btn-success {
        border-radius: 999px;
        padding: 10px 24px;
    }

    @media (max-width: 767.98px) {
        .orders-hero {
            text-align: center;
        }
    }
</style>

<section class="orders-page">
    <div class="container-fluid" style="max-width:1180px;">
        <div class="orders-hero">
            <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center gap-3">
                <div>
                    <span class="badge bg-success text-white mb-2">Riwayat Pesanan</span>
                    <h1>Pesanan Saya</h1>
                    <p class="text-muted mb-0">Lihat status dan detail setiap pembelian yang sudah kamu lakukan.</p>
                </div>
                <a href="{{ route('products.index') }}" class="btn btn-outline-success">Belanja Lagi</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($orders->count() > 0)
            <div class="orders-table-card">
                <div class="table-responsive">
                    <table class="table mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td class="fw-semibold">ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                                    <td>Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                                    <td>@include('orders.partials.status-badge', ['status' => $order->status])</td>
                                    <td class="text-end">
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-success">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="orders-empty-card text-center">
                <div class="orders-empty-icon">🛍️</div>
                <h3 class="fw-semibold mb-2 text-dark">Belum ada pesanan</h3>
                <p class="text-muted mb-4">Mulai jelajahi produk lokal favoritmu dan buat pesanan pertamamu.</p>
                <a href="{{ route('products.index') }}" class="btn btn-success">Lihat Produk</a>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
