@extends('layouts.appAdmin')

@section('title', 'Manajemen Penjualan')

@section('content')
<div class="admin-page">
    <div class="admin-hero">
        <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center gap-3">
            <div>
                <span class="badge">Penjualan</span>
                <h1>Manajemen Penjualan</h1>
                <p>Pantau dan kelola semua pesanan pelanggan, ubah status, dan pastikan setiap transaksi berjalan lancar.</p>
            </div>
            <form method="GET" class="actions d-flex gap-2">
                <select name="status" class="form-select" style="min-width: 160px;">
                    <option value="">Semua Status</option>
                    <option value="belum bayar" {{ $status === 'belum bayar' ? 'selected' : '' }}>Belum Bayar</option>
                    <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="diproses" {{ $status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="dikirim" {{ $status === 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                    <option value="completed" {{ $status === 'completed' ? 'selected' : '' }}>Selesai</option>
                </select>
                <button class="btn btn-accent" type="submit">Filter</button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-3 mb-4">
        <div class="col-md-6 col-xl-3">
            <div class="admin-card h-100">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-1">Total Pesanan</p>
                    <h4 class="fw-bold mb-0" data-summary-key="total_orders">{{ number_format($summary['total_orders']) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="admin-card h-100">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-1">Belum Bayar</p>
                    <h4 class="fw-bold mb-0" data-summary-key="unpaid">{{ number_format($summary['unpaid']) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="admin-card h-100">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-1">Pending</p>
                    <h4 class="fw-bold mb-0" data-summary-key="pending">{{ number_format($summary['pending']) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="admin-card h-100">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-1">Selesai</p>
                    <h4 class="fw-bold mb-0" data-summary-key="completed">{{ number_format($summary['completed']) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="admin-card h-100">
                <div class="card-body">
                    <p class="text-uppercase text-muted small mb-1">Pendapatan</p>
                    <h4 class="fw-bold mb-0" data-summary-key="revenue">Rp{{ number_format($summary['revenue'], 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="admin-table-card">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
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
                                <span class="badge text-uppercase status-badge {{ $order->status === 'completed' ? 'bg-success-subtle text-success-emphasis' : ($order->status === 'pending' ? 'bg-warning-subtle text-warning-emphasis' : 'bg-secondary-subtle text-secondary-emphasis') }}" data-order-id="{{ $order->id }}">
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
                                <form action="{{ route('admin.sales.update', $order) }}" method="POST" class="d-flex gap-2 justify-content-end js-order-status-form" data-order-id="{{ $order->id }}">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-select form-select-sm" style="max-width: 150px;">
                                        @foreach(['belum bayar' => 'Belum Bayar', 'pending' => 'Pending', 'diproses' => 'Diproses', 'dikirim' => 'Dikirim', 'completed' => 'Selesai'] as $value => $label)
                                            <option value="{{ $value }}" {{ $order->status === $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-sm btn-accent" type="submit">Simpan</button>
                                </form>
                            </td>
                        </tr>
                        <tr class="collapse" id="order-{{ $order->id }}">
                            <td colspan="7" class="bg-light">
                                <div class="row g-3">
                                    <div class="col-lg-8">
                                        <div class="bg-white border rounded-3 p-3 h-100">
                                            <h6 class="fw-semibold mb-3">Item Pesanan</h6>
                                            <ul class="list-unstyled mb-0">
                                                @foreach($order->items as $item)
                                                    <li class="border-bottom py-3">
                                                        <div class="d-flex gap-3">
                                                            <div>
                                                                @if($item->product?->image_url)
                                                                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="rounded" style="width:64px; height:64px; object-fit:cover;">
                                                                @else
                                                                    <div class="d-flex align-items-center justify-content-center bg-light border rounded" style="width:64px; height:64px;">
                                                                        <span class="text-muted small">No Img</span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <div class="d-flex justify-content-between align-items-start">
                                                                    <div>
                                                                        <div class="fw-semibold">{{ $item->product?->name ?? 'Produk dihapus' }}</div>
                                                                        <div class="text-muted small">Qty {{ $item->qty }} &bull; Rp{{ number_format($item->price, 0, ',', '.') }} / item</div>
                                                                    </div>
                                                                    <div class="fw-semibold">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</div>
                                                                </div>

                                                                @if($item->rating)
                                                                    <div class="text-warning small mt-2">
                                                                        @for($star = 1; $star <= 5; $star++)
                                                                            {!! $star <= $item->rating ? '&#9733;' : '&#9734;' !!}
                                                                        @endfor
                                                                        <span class="text-muted ms-1">({{ $item->rating }}/5)</span>
                                                                    </div>
                                                                    @if($item->review)
                                                                        <p class="text-muted small mb-1 mt-1">"{{ $item->review }}"</p>
                                                                    @endif
                                                                    <small class="text-muted">Dinilai {{ optional($item->rated_at)->format('d M Y') }}</small>
                                                                @else
                                                                    <span class="badge bg-secondary-subtle text-secondary-emphasis mt-2">Belum ada rating</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="bg-white border rounded-3 p-3 h-100">
                                            <h6 class="fw-semibold mb-3">Ringkasan Pesanan</h6>
                                            <dl class="row mb-0 small">
                                                <dt class="col-6">Pembayaran</dt>
                                                <dd class="col-6 text-end">{{ $order->payment_method }}</dd>
                                                @if($order->payment_method === 'Transfer Bank' && $order->virtual_account)
                                                    <dt class="col-6">Virtual Account</dt>
                                                    <dd class="col-6 text-end"><code>{{ $order->virtual_account }}</code></dd>
                                                @endif
                                                <dt class="col-6">Biaya Kirim</dt>
                                                <dd class="col-6 text-end">Rp{{ number_format($order->shipping_cost, 0, ',', '.') }}</dd>
                                                <dt class="col-6">Total</dt>
                                                <dd class="col-6 text-end fw-semibold">Rp{{ number_format($order->total, 0, ',', '.') }}</dd>
                                                <dt class="col-6">Tanggal</dt>
                                                <dd class="col-6 text-end">{{ optional($order->created_at)->format('d M Y, H:i') }}</dd>
                                                @if($order->delivery_note)
                                                    <dt class="col-12 mt-2">Catatan Pengiriman</dt>
                                                    <dd class="col-12 text-muted">{{ $order->delivery_note }}</dd>
                                                @endif
                                                <dt class="col-12 mt-2">Alamat</dt>
                                                <dd class="col-12 text-muted">{{ $order->address }}</dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada pesanan dengan filter ini.</td>
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
