@extends('layouts.appAdmin')

@section('title', 'Manajemen Penjualan')

@section('content')
    <div class="container-fluid py-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h1 class="h3 fw-bold text-success mb-1">Manajemen Penjualan</h1>
                <p class="text-muted mb-0">Pantau dan kelola semua pesanan pelanggan.</p>
            </div>
            <form method="GET" class="d-flex gap-2">
            <select name="status" class="form-select">
                <option value="">Semua Status</option>
                <option value="belum bayar" {{ $status === 'belum bayar' ? 'selected' : '' }}>Belum Bayar</option>
                <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="diproses" {{ $status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="dikirim" {{ $status === 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                <option value="completed" {{ $status === 'completed' ? 'selected' : '' }}>Selesai</option>
            </select>
            <button class="btn btn-success" type="submit">Filter</button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-3 mb-4">
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-1">Total Pesanan</p>
                    <h4 class="fw-bold mb-0">{{ number_format($summary['total_orders']) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-1">Belum Bayar</p>
                    <h4 class="fw-bold mb-0">{{ number_format($summary['unpaid']) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-1">Pending</p>
                    <h4 class="fw-bold mb-0">{{ number_format($summary['pending']) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-1">Selesai</p>
                    <h4 class="fw-bold mb-0">{{ number_format($summary['completed']) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-1">Pendapatan</p>
                    <h4 class="fw-bold mb-0">Rp{{ number_format($summary['revenue'], 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#ID</th>
                        <th>Pelanggan</th>
                        <th>Status</th>
                        <th class="text-end">Total</th>
                        <th>Tanggal</th>
                        <th>Detail Item</th>
                        <th class="text-end">Ubah Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td class="fw-semibold">ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <div class="fw-semibold">{{ $order->customer_name ?? 'Guest' }}</div>
                                <small class="text-muted">{{ $order->phone }}</small>
                            </td>
                            <td>
                                <span class="badge text-uppercase {{ $order->status === 'completed' ? 'bg-success-subtle text-success-emphasis' : ($order->status === 'pending' ? 'bg-warning-subtle text-warning-emphasis' : 'bg-danger-subtle text-danger-emphasis') }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="text-end fw-semibold">Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                            <td>{{ optional($order->created_at)->format('d M Y, H:i') }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#order-{{ $order->id }}">
                                    Lihat Item
                                </button>
                            </td>
                            <td class="text-end">
                                <form action="{{ route('admin.sales.update', $order) }}" method="POST" class="d-flex gap-2 justify-content-end">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-select form-select-sm" style="max-width: 150px;">
                                        @foreach(['belum bayar' => 'Belum Bayar', 'pending' => 'Pending', 'diproses' => 'Diproses', 'dikirim' => 'Dikirim', 'completed' => 'Selesai'] as $value => $label)
                                            <option value="{{ $value }}" {{ $order->status === $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-sm btn-success" type="submit">Simpan</button>
                                </form>
                            </td>
                        </tr>
                        <tr class="collapse" id="order-{{ $order->id }}">
                            <td colspan="7" class="bg-light">
                                <ul class="list-unstyled mb-0">
                                    @foreach($order->items as $item)
                                        <li class="d-flex justify-content-between border-bottom py-2">
                                            <span>
                                                {{ $item->product?->name ?? 'Produk dihapus' }}
                                                <small class="text-muted">(x{{ $item->qty }})</small>
                                            </span>
                                            <span>Rp{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada pesanan dengan filter ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer bg-white border-0 d-flex justify-content-end">
            {{ $orders->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
