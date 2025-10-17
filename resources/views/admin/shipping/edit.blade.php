@extends('layouts.appAdmin')

@section('title', 'Edit Opsi Pengiriman')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Edit Opsi Pengiriman</h1>
        <a href="{{ route('admin.shipping-options.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.shipping-options.update', $shippingOption) }}" class="row g-3">
                @csrf
                @method('PUT')
                <div class="col-md-6">
                    <label for="name" class="form-label fw-semibold">Nama Opsi</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $shippingOption->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label for="estimated_time" class="form-label fw-semibold">Estimasi Waktu</label>
                    <input type="text" id="estimated_time" name="estimated_time" class="form-control @error('estimated_time') is-invalid @enderror" value="{{ old('estimated_time', $shippingOption->estimated_time) }}">
                    @error('estimated_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label for="additional_cost" class="form-label fw-semibold">Biaya Tambahan</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" id="additional_cost" name="additional_cost" class="form-control @error('additional_cost') is-invalid @enderror" min="0" step="100" value="{{ old('additional_cost', $shippingOption->additional_cost) }}">
                        @error('additional_cost')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $shippingOption->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Aktifkan opsi pengiriman</label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i>Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
