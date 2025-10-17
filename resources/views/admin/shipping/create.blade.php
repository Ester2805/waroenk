@extends('layouts.appAdmin')

@section('title', 'Tambah Opsi Pengiriman')

@section('content')
<div class="admin-page">
    <div class="admin-hero">
        <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center gap-3">
            <div>
                <span class="badge">Pengiriman</span>
                <h1>Tambah Opsi Pengiriman</h1>
                <p>Lengkapi metode pengiriman agar pelanggan bisa memilih layanan terbaik untuk pesanan mereka.</p>
            </div>
            <div class="actions">
                <a href="{{ route('admin.shipping-options.index') }}" class="btn btn-outline-accent">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="admin-card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.shipping-options.store') }}" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <label for="name" class="form-label fw-semibold">Nama Opsi</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label for="estimated_time" class="form-label fw-semibold">Estimasi Waktu</label>
                    <input type="text" id="estimated_time" name="estimated_time" class="form-control @error('estimated_time') is-invalid @enderror" placeholder="Contoh: 1-2 hari" value="{{ old('estimated_time') }}">
                    @error('estimated_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label for="additional_cost" class="form-label fw-semibold">Biaya Tambahan</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" id="additional_cost" name="additional_cost" class="form-control @error('additional_cost') is-invalid @enderror" min="0" step="100" value="{{ old('additional_cost', 0) }}">
                        @error('additional_cost')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Aktifkan opsi pengiriman</label>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-accent">
                        <i class="bi bi-check-circle me-2"></i>Simpan Opsi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
