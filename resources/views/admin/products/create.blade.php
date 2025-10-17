@extends('layouts.appAdmin')

@section('title', 'Tambah Produk')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Tambah Produk</h1>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="card shadow-sm">
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

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="row gy-3">
                @csrf

                <div class="col-md-6">
                    <label for="name" class="form-label fw-semibold">Nama Produk</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        required
                        placeholder="Contoh: Kopi Susu Gula Aren"
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="price" class="form-label fw-semibold">Harga</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input
                            type="number"
                            name="price"
                            id="price"
                            class="form-control @error('price') is-invalid @enderror"
                            value="{{ old('price') }}"
                            required
                            min="0"
                            step="100"
                        >
                    </div>
                    @error('price')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="stock" class="form-label fw-semibold">Stok</label>
                    <input
                        type="number"
                        name="stock"
                        id="stock"
                        class="form-control @error('stock') is-invalid @enderror"
                        value="{{ old('stock', 0) }}"
                        required
                        min="0"
                    >
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="category_id" class="form-label fw-semibold">Kategori</label>
                    <select
                        name="category_id"
                        id="category_id"
                        class="form-select @error('category_id') is-invalid @enderror"
                    >
                        <option value="">Pilih kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
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
                    <textarea
                        name="description"
                        id="description"
                        class="form-control @error('description') is-invalid @enderror"
                        rows="4"
                        placeholder="Tuliskan deskripsi produk"
                    >{{ old('description') }}</textarea>
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
                                    <input class="form-check-input" type="checkbox" name="shipping_options[]" value="{{ $option->id }}" id="shipping-option-{{ $option->id }}" {{ collect(old('shipping_options', []))->contains($option->id) ? 'checked' : '' }}>
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
                    <input
                        type="file"
                        name="image"
                        id="image"
                        class="form-control @error('image') is-invalid @enderror"
                        accept="image/*"
                    >
                    <small class="text-muted">Format JPG, PNG, ukuran maksimal 2 MB.</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 d-flex align-items-end">
                    <div class="form-check form-switch">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            role="switch"
                            id="is_active"
                            name="is_active"
                            value="1"
                            {{ old('is_active', true) ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="is_active">Aktifkan produk</label>
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
