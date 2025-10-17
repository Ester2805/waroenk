@extends('layouts.appAdmin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid py-4">
    <div class="mb-4">
        <h1 class="h3 fw-bold text-success mb-1">Dashboard Admin</h1>
        <p class="text-muted mb-0">Ringkasan singkat aktivitas toko online Anda.</p>
    </div>

    {{-- Kartu Statistik --}}
    <div class="row g-3 mb-4">
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <p class="text-uppercase text-muted small mb-1">Total Produk</p>
                            <h3 class="fw-bold mb-0">{{ number_format($totalProducts) }}</h3>
                        </div>
                        <div class="bg-success-subtle text-success-emphasis rounded-circle p-3">
                            <i class="bi bi-box-seam fs-4"></i>
                        </div>
                    </div>
                    <p class="text-muted small mt-3 mb-0">
                        {{ number_format($activeProducts) }} produk aktif tersedia di katalog.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <p class="text-uppercase text-muted small mb-1">Pesanan Pending</p>
                            <h3 class="fw-bold mb-0">{{ number_format($pendingOrders) }}</h3>
                        </div>
                        <div class="bg-warning-subtle text-warning-emphasis rounded-circle p-3">
                            <i class="bi bi-hourglass-split fs-4"></i>
                        </div>
                    </div>
                    <p class="text-muted small mt-3 mb-0">
                        Dari total {{ number_format($totalOrders) }} pesanan masuk.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <p class="text-uppercase text-muted small mb-1">Pesanan Selesai</p>
                            <h3 class="fw-bold mb-0">{{ number_format($completedOrders) }}</h3>
                        </div>
                        <div class="bg-primary-subtle text-primary-emphasis rounded-circle p-3">
                            <i class="bi bi-bag-check fs-4"></i>
                        </div>
                    </div>
                    <p class="text-muted small mt-3 mb-0">
                        Tingkat penyelesaian {{ $totalOrders > 0 ? number_format(($completedOrders / $totalOrders) * 100, 1) : 0 }}%.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <p class="text-uppercase text-muted small mb-1">Pendapatan</p>
                            <h3 class="fw-bold mb-0">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                        </div>
                        <div class="bg-danger-subtle text-danger-emphasis rounded-circle p-3">
                            <i class="bi bi-cash-stack fs-4"></i>
                        </div>
                    </div>
                    <p class="text-muted small mt-3 mb-0">
                        Termasuk biaya pengiriman (+).
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Ringkasan Tambahan --}}
    <div class="row g-3 mb-4">
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-1">Kategori</p>
                    <h4 class="fw-bold mb-0">{{ number_format($totalCategories) }}</h4>
                    <p class="text-muted small mt-2 mb-0">Kelola kategori untuk memudahkan pencarian produk.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-1">Pengguna</p>
                    <h4 class="fw-bold mb-0">{{ number_format($totalUsers) }}</h4>
                    <p class="text-muted small mt-2 mb-0">Jumlah akun terdaftar di platform.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Tabel Pesanan Terbaru --}}
        <div class="col-xl-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Pesanan Terbaru</h5>
                    <span class="badge bg-success-subtle text-success-emphasis">{{ $recentOrders->count() }} pesanan</span>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#ID</th>
                                <th>Pelanggan</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                                <tr>
                                    <td class="fw-semibold">ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td>
                                        <div class="fw-semibold">{{ $order->customer_name ?? 'Guest' }}</div>
                                        <small class="text-muted">{{ $order->phone }}</small>
                                    </td>
                                    <td>
                                        @php($status = $order->status ?? 'pending')
                                        <span class="badge text-uppercase {{ $status === 'completed' ? 'bg-success-subtle text-success-emphasis' : ($status === 'pending' ? 'bg-warning-subtle text-warning-emphasis' : 'bg-secondary-subtle text-secondary-emphasis') }}">
                                            {{ $status }}
                                        </span>
                                    </td>
                                    <td class="fw-semibold">Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                                    <td>{{ optional($order->created_at)->format('d M Y, H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">Belum ada pesanan terbaru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Produk Stok Rendah --}}
        <div class="col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0">
                    <h5 class="card-title mb-0">Stok Rendah</h5>
                    <span class="text-muted small">Pantau produk yang hampir habis.</span>
                </div>
                <div class="card-body">
                    @forelse($lowStockProducts as $product)
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-grow-1">
                                <div class="fw-semibold">{{ $product->name }}</div>
                                <small class="text-muted">
                                    {{ $product->category?->name ?? 'Tanpa kategori' }}
                                </small>
                            </div>
                            <span class="badge rounded-pill {{ $product->stock <= 5 ? 'bg-danger-subtle text-danger-emphasis' : 'bg-warning-subtle text-warning-emphasis' }}">
                                Stok: {{ $product->stock }}
                            </span>
                        </div>
                    @empty
                        <p class="text-muted mb-0">Tidak ada produk dengan stok rendah.</p>
                    @endforelse
                </div>
                <div class="card-footer bg-white border-0 text-end">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-success">
                        Kelola Produk
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
