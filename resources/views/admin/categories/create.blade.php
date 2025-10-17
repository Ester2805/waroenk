@extends('layouts.appAdmin')

@section('title', 'Tambah Kategori')

@section('content')
<div class="admin-page">
    <div class="admin-hero">
        <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center gap-3">
            <div>
                <span class="badge">Kategori</span>
                <h1>Tambah Kategori</h1>
                <p>Tambahkan kategori baru untuk memudahkan pengelompokan produk dan navigasi pelanggan.</p>
            </div>
            <div class="actions">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-accent">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="admin-card">
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.categories.store') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-12">
                    <label for="name" class="form-label fw-semibold">Nama Kategori</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required placeholder="Contoh: Minuman">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-accent">
                        <i class="bi bi-check-circle me-2"></i>Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
