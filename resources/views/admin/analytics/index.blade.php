@extends('layouts.appAdmin')

@section('title', 'Analitik Penjualan')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold text-success mb-1">Analitik Penjualan</h1>
            <p class="text-muted mb-0">Lihat performa toko berdasarkan pesanan, kategori, dan produk.</p>
        </div>
        <div class="d-flex gap-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body py-2 px-3">
                    <p class="text-uppercase text-muted small mb-1">Pendapatan Hari Ini</p>
                    <h5 class="fw-bold mb-0">Rp{{ number_format($todayRevenue, 0, ',', '.') }}</h5>
                </div>
            </div>
            <div class="card border-0 shadow-sm">
                <div class="card-body py-2 px-3">
                    <p class="text-uppercase text-muted small mb-1">Pesanan Hari Ini</p>
                    <h5 class="fw-bold mb-0">{{ number_format($todayOrders) }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0">
                    <h5 class="card-title mb-0">Pendapatan 12 Bulan Terakhir</h5>
                </div>
                <div class="card-body">
                    @if($ordersByMonth->isEmpty())
                        <p class="text-muted mb-0">Belum ada data penjualan.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-sm align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Bulan</th>
                                        <th class="text-end">Total Pesanan</th>
                                        <th class="text-end">Pendapatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ordersByMonth as $row)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($row->month . '-01')->translatedFormat('F Y') }}</td>
                                            <td class="text-end">{{ number_format($row->order_count) }}</td>
                                            <td class="text-end">Rp{{ number_format($row->total_amount, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0">
                    <h5 class="card-title mb-0">Kategori Terlaris</h5>
                </div>
                <div class="card-body">
                    @forelse($topCategories as $category)
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-grow-1">
                                <div class="fw-semibold">{{ $category->name }}</div>
                                <small class="text-muted">{{ $category->products_count }} produk</small>
                            </div>
                            <span class="badge bg-success-subtle text-success-emphasis">Top {{ $loop->iteration }}</span>
                        </div>
                    @empty
                        <p class="text-muted mb-0">Belum ada kategori dengan data penjualan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0">
            <h5 class="card-title mb-0">Produk Terlaris</h5>
            <span class="text-muted small">Berdasarkan jumlah terjual.</span>
        </div>
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th class="text-center">Terjual</th>
                        <th class="text-end">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bestSellingProducts as $product)
                        <tr>
                            <td>
                                <div class="fw-semibold">{{ $product->name }}</div>
                                <small class="text-muted">{{ $product->is_active ? 'Aktif' : 'Nonaktif' }}</small>
                            </td>
                            <td>{{ $product->category?->name ?? '-' }}</td>
                            <td class="text-center">{{ number_format($product->sold_qty ?? 0) }}</td>
                            <td class="text-end">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Belum ada data produk terjual.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
