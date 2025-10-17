@extends('layouts.appAdmin')

@section('title', 'Kelola Kategori')

@section('content')
<div class="admin-page">
    <div class="admin-hero">
        <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center gap-3">
            <div>
                <span class="badge">Kategori</span>
                <h1>Kelola Kategori</h1>
                <p>Susun kategori produk untuk memudahkan pelanggan menemukan produk UMKM favoritnya.</p>
            </div>
            <div class="actions">
                <a href="{{ route('admin.categories.create') }}" class="btn btn-accent">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Kategori
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($categories->count() > 0)
        <div class="admin-table-card">
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead>
                        <tr>
                            <th style="width: 60px;">#</th>
                            <th>Nama Kategori</th>
                            <th class="text-center" style="width: 160px;">Jumlah Produk</th>
                            <th class="text-end" style="width: 170px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $index => $category)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-semibold">{{ $category->name }}</td>
                                <td class="text-center">
                                    <span class="badge bg-primary-subtle text-primary-emphasis">
                                        {{ $category->products_count }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-success me-2">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus kategori ini?')">
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
            <div class="admin-empty-icon">🏷️</div>
            <h4 class="fw-semibold mb-2">Belum ada kategori</h4>
            <p class="text-muted mb-4">Tambahkan kategori pertama Anda untuk mengelompokkan produk di etalase.</p>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-accent">Tambah Kategori</a>
        </div>
    @endif
</div>
@endsection
