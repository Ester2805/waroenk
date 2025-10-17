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

    @php
        $filters = $filters ?? [];
        $selectedCategory = $filters['categoryId'] ?? null;
        $keyword = $filters['keyword'] ?? null;
        $minPrice = $filters['minPrice'] ?? null;
        $maxPrice = $filters['maxPrice'] ?? null;
        $searchAction = $filters['searchAction'] ?? route('products.index');
        $selectedShipping = $filters['shippingOptionId'] ?? null;
        $selectedSort = $filters['sort'] ?? 'newest';
        $minRating = $filters['minRating'] ?? null;
        $shippingOptions = $shippingOptions ?? collect();
    @endphp

    <h1 class="mb-4">Daftar Produk</h1>

    <div class="row">
        <aside class="col-lg-3 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="fw-semibold mb-3">Filter</h5>
                    <form method="GET" action="{{ $searchAction }}" class="filter-sidebar">
                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori</label>
                            <select name="category" id="category" class="form-select">
                                <option value="">-- Semua Kategori --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ ($selectedCategory == $cat->id) ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kisaran Harga</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="min_price" id="min_price" class="form-control" min="0" value="{{ $minPrice }}" placeholder="0">
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="max_price" id="max_price" class="form-control" min="0" value="{{ $maxPrice }}" placeholder="100000">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="shipping" class="form-label">Opsi Pengiriman</label>
                            <select name="shipping" id="shipping" class="form-select">
                                <option value="">Semua opsi</option>
                                @foreach($shippingOptions as $option)
                                    <option value="{{ $option->id }}" {{ (string) $selectedShipping === (string) $option->id ? 'selected' : '' }}>
                                        {{ $option->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="min_rating" class="form-label">Rating Minimum</label>
                            <select name="min_rating" id="min_rating" class="form-select">
                                <option value="">Semua rating</option>
                                @for($r = 5; $r >= 1; $r--)
                                    <option value="{{ $r }}" {{ (string) $minRating === (string) $r ? 'selected' : '' }}>{{ $r }}+</option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="sort" class="form-label">Urutkan</label>
                            <select name="sort" id="sort" class="form-select">
                                <option value="newest" {{ $selectedSort === 'newest' ? 'selected' : '' }}>Terbaru</option>
                                <option value="popular" {{ $selectedSort === 'popular' ? 'selected' : '' }}>Terlaris</option>
                                <option value="rating" {{ $selectedSort === 'rating' ? 'selected' : '' }}>Rating Tertinggi</option>
                                <option value="price_low" {{ $selectedSort === 'price_low' ? 'selected' : '' }}>Harga Rendah</option>
                                <option value="price_high" {{ $selectedSort === 'price_high' ? 'selected' : '' }}>Harga Tinggi</option>
                            </select>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">Terapkan Filter</button>
                            <a href="{{ $searchAction }}" class="btn btn-outline-secondary">Reset</a>
                        </div>
                    </form>
                </div>
            </div>
        </aside>

        <section class="col-lg-9">
            {{-- 🔎 Pesan pencarian --}}
            @if(!empty($keyword))
                <p class="text-muted">Hasil pencarian untuk: <strong>{{ $keyword }}</strong></p>
            @endif

            {{-- 🛍️ Daftar Produk --}}
            <div class="row">
        @forelse($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">

                    {{-- Gambar produk --}}
                    <a href="{{ route('products.show', $product) }}">
                        @if(!empty($product->image_url))
                            <img 
                                src="{{ $product->image_url }}" 
                                class="card-img-top" 
                                alt="{{ $product->name }}" 
                                style="height: 200px; object-fit: cover;">
                        @else
                            <img 
                                src="https://via.placeholder.com/400x200?text=No+Image" 
                                class="card-img-top" 
                                alt="No Image">
                        @endif
                    </a>

                    <div class="card-body d-flex flex-column">
                        {{-- Nama produk --}}
                        <h5 class="card-title"><a href="{{ route('products.show', $product) }}" class="text-decoration-none text-dark">{{ $product->name }}</a></h5>

                        {{-- Kategori --}}
                        @if($product->category)
                            <p class="text-muted mb-1">Kategori: {{ $product->category->name }}</p>
                        @endif

                        {{-- Harga --}}
                        <p class="mb-1">
                            <strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong>
                        </p>

                        {{-- Rating & Terjual --}}
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-warning">
                                @php $avgRating = round($product->rating_avg ?? 0, 1); @endphp
                                @for($star = 1; $star <= 5; $star++)
                                    {!! $star <= round($avgRating) ? '&#9733;' : '&#9734;' !!}
                                @endfor
                                <small class="text-muted">({{ $avgRating ?: '-' }})</small>
                            </span>
                            <span class="text-muted small">Terjual {{ number_format($product->sold_total ?? 0) }}</span>
                        </div>

                        {{-- Stok --}}
                        <p class="text-muted mb-2">Stok: {{ $product->stock }}</p>

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

        </section>
    </div>

</div>
@endsection
