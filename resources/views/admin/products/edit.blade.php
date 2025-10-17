@extends('layouts.appAdmin')

@section('title', 'Edit Produk')

@section('content')
<div class="admin-page">
    <div class="admin-hero">
        <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center gap-3">
            <div>
                <span class="badge">Produk</span>
                <h1>Edit Produk</h1>
                <p>Perbarui informasi produk dan pastikan detailnya selalu relevan untuk pelanggan.</p>
            </div>
            <div class="actions">
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-accent">
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

            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="row gy-3">
                @csrf
                @method('PUT')

                <div class="col-md-6">
                    <label for="name" class="form-label fw-semibold">Nama Produk</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="price" class="form-label fw-semibold">Harga</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}" required min="0" step="100">
                    </div>
                    @error('price')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="stock" class="form-label fw-semibold">Stok</label>
                    <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $product->stock) }}" required min="0">
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="category_id" class="form-label fw-semibold">Kategori</label>
                    <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                        <option value="">Pilih kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="description" class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Opsi Pengiriman</label>
                    <div class="row row-cols-1 row-cols-md-2 g-2">
                        @foreach($shippingOptions as $option)
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="shipping_options[]" value="{{ $option->id }}" id="shipping-option-{{ $option->id }}" {{ in_array($option->id, old('shipping_options', $selectedShippingOptions)) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="shipping-option-{{ $option->id }}">
                                        <strong>{{ $option->name }}</strong>
                                        @if($option->estimated_time)
                                            <span class="text-muted"> ({{ $option->estimated_time }})</span>
                                        @endif
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <small class="text-muted">Centang opsi pengiriman yang tersedia untuk produk ini.</small>
                </div>

                <div class="col-md-6">
                    <label for="image" class="form-label fw-semibold">Gambar Produk</label>
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                    <small class="text-muted d-block mb-2">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if($product->image_url)
                        <div class="mt-3">
                            <span class="d-block text-muted small mb-1">Gambar sekarang:</span>
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="rounded" style="width: 180px; height: 180px; object-fit: cover;">
                        </div>
                    @endif
                </div>

                <div class="col-md-6 d-flex align-items-end">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Aktifkan produk</label>
                    </div>
                </div>

                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-accent">
                        <i class="bi bi-save me-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
