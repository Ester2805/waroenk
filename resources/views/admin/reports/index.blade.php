@extends('layouts.appAdmin')

@section('title', 'Laporan Penjualan')

@section('content')
<div class="admin-page">
    <div class="admin-hero">
        <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center gap-3">
            <div>
                <span class="badge">Laporan</span>
                <h1>Laporan Penjualan</h1>
                <p>Analisis performa toko dalam rentang waktu tertentu dan identifikasi produk yang paling diminati pelanggan.</p>
            </div>
            <form method="GET" class="actions d-flex gap-2">
                <select name="range" class="form-select" style="min-width: 140px;">
                    <option value="7" {{ $range == 7 ? 'selected' : '' }}>7 Hari</option>
                    <option value="30" {{ $range == 30 ? 'selected' : '' }}>30 Hari</option>
                    <option value="90" {{ $range == 90 ? 'selected' : '' }}>90 Hari</option>
                    <option value="180" {{ $range == 180 ? 'selected' : '' }}>180 Hari</option>
                </select>
                <button class="btn btn-accent" type="submit">Terapkan</button>
            </form>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="admin-card h-100">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-1">Pesanan</p>
                    <h4 class="fw-bold mb-0">{{ number_format($report['orders_count']) }}</h4>
                    <p class="text-muted small mb-0">Dalam {{ $report['range_days'] }} hari terakhir.</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="admin-card h-100">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-1">Selesai</p>
                    <h4 class="fw-bold mb-0">{{ number_format($report['completed_count']) }}</h4>
                    <p class="text-muted small mb-0">Pesanan berhasil terkirim.</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="admin-card h-100">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-1">Pendapatan</p>
                    <h4 class="fw-bold mb-0">Rp{{ number_format($report['revenue'], 0, ',', '.') }}</h4>
                    <p class="text-muted small mb-0">Dari pesanan selesai.</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="admin-card h-100">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-1">Rata-Rata Pesanan</p>
                    <h4 class="fw-bold mb-0">Rp{{ number_format($report['avg_order_value'] ?? 0, 0, ',', '.') }}</h4>
                    <p class="text-muted small mb-0">Nilai rata-rata per transaksi.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="admin-table-card mb-4">
        <div class="card-header bg-white border-0">
            <h5 class="card-title mb-0">Top Produk {{ $report['range_days'] }} Hari Terakhir</h5>
        </div>
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th class="text-center">Jumlah Terjual</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($report['products_sold'] as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $product->name }}</td>
                            <td>{{ $product->category?->name ?? '-' }}</td>
                            <td class="text-center">{{ number_format($product->sold_qty ?? 0) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Data penjualan produk belum tersedia untuk periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
