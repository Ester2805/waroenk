@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

@section('content')
<section class="py-5" style="background:#f4f6f8; min-height:80vh;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold text-success mb-1">Pesanan Saya</h1>
                <p class="text-muted mb-0">Lihat status dan detail setiap pembelian yang sudah kamu lakukan.</p>
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-outline-success">Belanja Lagi</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($orders->count() > 0)
            <div class="card shadow-sm">
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
            <div class="card shadow-sm">
                <div class="card-body text-center py-5">
                    <h5 class="fw-semibold">Belum ada pesanan</h5>
                    <p class="text-muted">Mulai jelajahi produk lokal favoritmu dan buat pesanan pertama.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-success">Lihat Produk</a>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
