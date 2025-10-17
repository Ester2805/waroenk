@extends('layouts.appAdmin')

@section('title', 'Edit Kategori')

@section('content')
<div class="admin-page">
    <div class="admin-hero">
        <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center gap-3">
            <div>
                <span class="badge">Kategori</span>
                <h1>Edit Kategori</h1>
                <p>Perbarui nama kategori agar katalog produk tetap rapi dan terstruktur.</p>
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

            <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="row g-3">
                @csrf
                @method('PUT')

                <div class="col-12">
                    <label for="name" class="form-label fw-semibold">Nama Kategori</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
