@extends('layouts.app')

@section('content')
<style>
    .products-page {
        background: #f4f6fb;
        padding: 2.5rem 0 3rem;
    }

    .products-wrapper {
        width: 100%;
        margin: 0;
        padding: 0 1.5rem;
    }

    @media (min-width: 768px) {
        .products-wrapper {
            padding: 0 2.5rem;
        }
    }

    @media (min-width: 1400px) {
        .products-wrapper {
            padding: 0 3.5rem;
        }
    }

    .products-header {
        display: grid;
        gap: 0.75rem;
        margin-bottom: 2.5rem;
        justify-items: start;
    }

    .products-header-title {
        font-weight: 700;
        color: #111827;
    }

    .products-header-subtitle {
        color: #6b7280;
        font-size: 1rem;
        max-width: 720px;
    }

    .products-header .keyword-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        background: rgba(46, 125, 50, 0.1);
        border-radius: 999px;
        color: #2e7d32;
        font-weight: 600;
    }

    .filter-card {
        background: rgba(255, 255, 255, 0.94);
        border-radius: 24px;
        box-shadow: 0 20px 48px rgba(15, 23, 42, 0.1);
        padding: 24px;
        position: sticky;
        top: 110px;
        width: 100%;
    }

    .filter-card h5 {
        font-weight: 600;
        margin-bottom: 1.25rem;
    }

    .filter-card label {
        font-weight: 600;
        color: #1f2937;
        font-size: 0.9rem;
        margin-bottom: 0.4rem;
    }

    .filter-card .form-select,
    .filter-card .form-control {
        border-radius: 14px;
        border: 1px solid rgba(148, 163, 184, 0.45);
        padding: 10px 12px;
    }

    .filter-card .input-group-text {
        border-radius: 14px 0 0 14px;
        border-color: rgba(148, 163, 184, 0.45);
        background: #f1f5f9;
        font-weight: 600;
    }

    .filter-card .btn-apply {
        background: #2e7d32;
        border-radius: 14px;
        font-weight: 600;
        padding: 12px;
    }

    .filter-card .btn-reset {
        border-radius: 14px;
        font-weight: 600;
        padding: 12px;
    }

    .product-grid-card {
        background: #ffffff;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(15, 23, 42, 0.12);
        display: flex;
        flex-direction: column;
        height: 100%;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .product-grid-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.16);
    }

    .product-grid-img-wrap {
        position: relative;
        background: #f8fafc;
        padding: 22px;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 220px;
    }

    .product-grid-img {
        width: 100%;
        height: 220px;
        object-fit: contain;
    }

    .product-grid-rating {
        position: absolute;
        top: 18px;
        left: 18px;
        background: rgba(0, 0, 0, 0.7);
        color: #fff;
        padding: 6px 12px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.85rem;
    }

    .product-grid-body {
        padding: 22px 24px 24px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        flex: 1;
    }

    .product-grid-price {
        color: #2e7d32;
        font-weight: 700;
        font-size: 1.1rem;
    }

    .product-grid-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.9rem;
        color: #6b7280;
    }

    .product-grid-card .btn-cart {
        border-radius: 14px;
        font-weight: 600;
        padding: 12px;
    }

    .empty-state {
        background: #fff;
        border-radius: 26px;
        padding: 60px 40px;
        box-shadow: 0 20px 50px rgba(15, 23, 42, 0.08);
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
        width: 100%;
        text-align: left;
    }

    .empty-state-icon {
        width: 72px;
        height: 72px;
        background: rgba(46, 125, 50, 0.12);
        color: #2e7d32;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
    }

    @media (max-width: 991.98px) {
        .filter-card {
            position: static;
        }
    }

    @media (max-width: 576px) {
        .products-page {
            padding-top: 1.5rem;
        }

        .product-grid-img-wrap {
            padding: 18px;
        }
    }
</style>

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
    $productCount = is_countable($products) ? count($products) : 0;
@endphp

<div class="products-page">
    <div class="products-wrapper">

        {{-- ✅ Pesan sukses --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <header class="products-header align-items-start">
            <div class="text-start">
                <h1 class="products-header-title display-6 mb-1">Daftar Produk</h1>
                <p class="products-header-subtitle mb-0">
                    Jelajahi produk UMKM pilihan dan gunakan filter untuk menemukan barang yang cocok buat kamu.
                </p>
            </div>
            <div class="text-start">
                <span class="text-muted small d-inline-block mb-1">Total produk ditemukan: <strong>{{ $productCount }}</strong></span>
                @if(!empty($keyword))
                    <span class="keyword-pill ms-0">
                        <i class="bi bi-search"></i> {{ $keyword }}
                    </span>
                @endif
            </div>
        </header>

        <div class="row g-4">
            <aside class="col-lg-3">
                <div class="filter-card">
                    <h5 class="fw-semibold">Filter</h5>
                    <form method="GET" action="{{ $searchAction }}" class="filter-sidebar js-product-filter-form">
                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori</label>
                            <select name="category" id="category" class="form-select">
                                <option value="">Semua kategori</option>
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
                        <div class="mb-4">
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
                            <button type="submit" class="btn btn-success btn-apply">
                                Terapkan Filter
                            </button>
                            <a href="{{ $searchAction }}" class="btn btn-outline-secondary btn-reset">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>
            </aside>

            <section class="col-lg-9">
                <div id="product-results">
                    @include('products.partials.grid', ['products' => $products])
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
