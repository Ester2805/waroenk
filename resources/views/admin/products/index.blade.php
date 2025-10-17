@extends('layouts.appAdmin')

@section('title', 'Kelola Produk')

@section('content')
<div class="admin-page">
    <div class="admin-hero">
        <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center gap-3">
            <div>
                <span class="badge">Produk</span>
                <h1>Kelola Produk</h1>
                <p>Atur katalog produk UMKM, perbarui stok, dan optimalkan etalase toko Waroenk agar tetap menarik.</p>
            </div>
            <div class="actions">
                <a href="{{ route('admin.products.create') }}" class="btn btn-accent">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Produk
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($products->count() > 0)
        <div class="admin-table-card">
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead>
                        <tr>
                            <th style="width: 70px;">Gambar</th>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th class="text-end">Harga</th>
                            <th class="text-center">Terjual</th>
                            <th class="text-center">Rating</th>
                            <th class="text-center">Stok</th>
                            <th class="text-center">Status</th>
                            <th class="text-end" style="width: 170px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>
                                    @if($product->image_url)
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-semibold">
                                    <div>{{ $product->name }}</div>
                                    @if($product->description)
                                        <small class="text-muted d-block">{{ \Illuminate\Support\Str::limit($product->description, 60) }}</small>
                                    @endif
                                </td>
                                <td>{{ $product->category?->name ?? '-' }}</td>
                                <td class="text-end">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="text-center">{{ number_format($product->sold_total ?? 0) }}</td>
                                <td class="text-center">
                                    @php $avgRating = round($product->rating_avg ?? 0, 1); @endphp
                                    <span class="text-warning">
                                        @for($star = 1; $star <= 5; $star++)
                                            {!! $star <= round($avgRating) ? '&#9733;' : '&#9734;' !!}
                                        @endfor
                                    </span>
                                    <div class="text-muted small">{{ $avgRating ?: '-' }}</div>
                                </td>
                                <td class="text-center">{{ $product->stock }}</td>
                                <td class="text-center">
                                    @if($product->is_active)
                                        <span class="badge bg-success-subtle text-success-emphasis">Aktif</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger-emphasis">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-success me-2">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus produk ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="admin-empty">
            <div class="admin-empty-icon">📦</div>
            <h4 class="fw-semibold mb-2">Belum ada produk</h4>
            <p class="text-muted mb-4">Mulai tambahkan produk baru untuk mengisi katalog toko.</p>
            <a href="{{ route('admin.products.create') }}" class="btn btn-accent">Tambah Produk</a>
        </div>
    @endif
</div>
@endsection
