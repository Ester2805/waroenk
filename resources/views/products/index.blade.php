@extends('layouts.app')

@section('content')
<div class="container">

    {{-- ✅ Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h1 class="mb-4">Daftar Produk</h1>

    {{-- 🔍 Filter Kategori --}}
    <form method="GET" action="{{ route('products.index') }}" class="mb-4">
        <div class="row g-2 align-items-center">
            <div class="col-md-4">
                <select name="category" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Semua Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ ($categoryId == $cat->id) ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @if(!empty($categoryId))
                <div class="col-md-auto">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            @endif
        </div>
    </form>

    {{-- 🔎 Hasil pencarian (kalau ada keyword dari SearchController) --}}
    @if(!empty($keyword))
        <p class="text-muted">Hasil pencarian untuk: <strong>{{ $keyword }}</strong></p>
    @endif

    {{-- 🛍️ Daftar Produk --}}
    <div class="row">
        @forelse($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">

                    {{-- Gambar produk --}}
                    @if(!empty($product->image_path))
                        <img 
                            src="{{ asset('storage/' . $product->image_path) }}" 
                            class="card-img-top" 
                            alt="{{ $product->name }}" 
                            style="height: 200px; object-fit: cover;">
                    @else
                        <img 
                            src="https://via.placeholder.com/400x200?text=No+Image" 
                            class="card-img-top" 
                            alt="No Image">
                    @endif

                    <div class="card-body d-flex flex-column">
                        {{-- Nama produk --}}
                        <h5 class="card-title">{{ $product->name }}</h5>

                        {{-- Kategori --}}
                        @if($product->category)
                            <p class="text-muted mb-1">Kategori: {{ $product->category->name }}</p>
                        @endif

                        {{-- Harga --}}
                        <p class="mb-1">
                            <strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong>
                        </p>

                        {{-- Stok --}}
                        <p class="text-muted mb-2">Stok: {{ $product->stock }}</p>

                        {{-- Status --}}
                        @if($product->is_active)
                            <span class="badge bg-success mb-2">Aktif</span>
                        @else
                            <span class="badge bg-secondary mb-2">Tidak Aktif</span>
                        @endif

                        {{-- Tombol tambah ke keranjang --}}
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-auto">
                            @csrf
                            <button type="submit" class="btn btn-success w-100">Tambah ke Keranjang</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center mt-5">
                <p class="text-muted fs-5">Belum ada produk yang tersedia.</p>
            </div>
        @endforelse
    </div>

    {{-- 🔗 Tombol ke halaman keranjang --}}
    @if(!$products->isEmpty())
        <div class="text-center mt-4">
            <a href="{{ route('cart.index') }}" class="btn btn-success px-4">
                Lihat Keranjang
            </a>
        </div>
    @endif

</div>
@endsection
