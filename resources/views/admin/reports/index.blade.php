@extends('layouts.appAdmin')

@section('title', 'Laporan Penjualan')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold text-success mb-1">Laporan Penjualan</h1>
            <p class="text-muted mb-0">Analisis performa dalam rentang waktu tertentu.</p>
        </div>
        <form method="GET" class="d-flex gap-2">
            <select name="range" class="form-select">
                <option value="7" {{ $range == 7 ? 'selected' : '' }}>7 Hari</option>
                <option value="30" {{ $range == 30 ? 'selected' : '' }}>30 Hari</option>
                <option value="90" {{ $range == 90 ? 'selected' : '' }}>90 Hari</option>
                <option value="180" {{ $range == 180 ? 'selected' : '' }}>180 Hari</option>
            </select>
            <button class="btn btn-success" type="submit">Terapkan</button>
        </form>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-1">Pesanan</p>
                    <h4 class="fw-bold mb-0">{{ number_format($report['orders_count']) }}</h4>
                    <p class="text-muted small mb-0">Dalam {{ $report['range_days'] }} hari terakhir.</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-1">Selesai</p>
                    <h4 class="fw-bold mb-0">{{ number_format($report['completed_count']) }}</h4>
                    <p class="text-muted small mb-0">Pesanan berhasil terkirim.</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-1">Pendapatan</p>
                    <h4 class="fw-bold mb-0">Rp{{ number_format($report['revenue'], 0, ',', '.') }}</h4>
                    <p class="text-muted small mb-0">Status completed saja.</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-1">Rata-Rata Pesanan</p>
                    <h4 class="fw-bold mb-0">Rp{{ number_format($report['avg_order_value'] ?? 0, 0, ',', '.') }}</h4>
                    <p class="text-muted small mb-0">Dihitung dari pesanan selesai.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0">
            <h5 class="card-title mb-0">Top Produk {{ $report['range_days'] }} Hari Terakhir</h5>
        </div>
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
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
