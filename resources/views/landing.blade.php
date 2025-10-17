@extends('layouts.app')

@section('title', 'Home')

@section('content')
<style>
    body { background-color: #f9fafb; }
    .text-waroenk-green { color: #2e7d32; }
    .btn-waroenk {
        background-color: #66bb6a;
        color: #fff;
        border-radius: 8px;
        padding: 10px 24px;
        font-weight: 600;
        transition: background-color .2s;
    }
    .btn-waroenk:hover { background-color: #43a047; color: #fff; }
    .btn-outline-waroenk {
        border: 2px solid #2e7d32;
        color: #2e7d32;
        border-radius: 8px;
        padding: 10px 24px;
        font-weight: 600;
        transition: all .2s;
    }
    .btn-outline-waroenk:hover { background-color: #2e7d32; color: #fff; }
    .category-pill {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 16px;
        border: 1px solid #e0e7ec;
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        transition: transform .2s, box-shadow .2s;
        text-decoration: none;
        color: #1f2933;
        font-weight: 600;
    }
    .category-pill:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(76, 175, 80, 0.15);
    }
    .category-pill-icon {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #e8f5e9;
        color: #2e7d32;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }
    .product-card {
        border-radius: 16px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        transition: transform .2s;
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .product-card:hover { transform: translateY(-5px); }
    .product-card-img { width: 100%; height: 200px; object-fit: contain; }
</style>

<div class="container-fluid p-0">
    {{-- Banner Hero --}}
    <div class="bg-success text-white d-flex flex-column flex-md-row align-items-center justify-content-between p-5 m-4 rounded">
        <div class="mb-4 mb-md-0">
            <h1 class="fw-bold mb-2">Waroenk UMKM</h1>
            <p class="mb-3">Platform kurasi produk lokal pilihan. Kenali perajin, dukung usaha kecil, dan temukan barang favoritmu.</p>
            <a href="{{ route('about') }}" class="btn btn-light text-success fw-semibold">Kenali Kami</a>
        </div>
        <img src="{{ asset('images/hero-illustration.png') }}" alt="Waroenk Illustration" class="img-fluid d-none d-md-block" style="max-height:160px;">
    </div>

    {{-- Kategori --}}
    <div class="py-5 px-4" id="section-kategori">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0">Kategori Teratas</h2>
            <a href="{{ route('products.index') }}" class="btn btn-outline-waroenk">Lihat Semua Produk</a>
        </div>
        <div class="row g-3">
            @forelse($categories->take(8) as $category)
                <div class="col-6 col-sm-4 col-lg-3 col-xl-3">
                    <a href="{{ route('products.index', ['category' => $category->id]) }}" class="category-pill">
                        <span class="category-pill-icon">
                            <i class="bi bi-tag"></i>
                        </span>
                        {{ $category->name }}
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted">Kategori belum tersedia. Tambahkan kategori melalui panel admin.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Rekomendasi Produk --}}
    <div class="px-4 pb-5">
        <h2 class="fw-bold mb-4">Rekomendasi Produk</h2>
        <div class="row g-4">
            @forelse($featuredProducts as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card p-3">
                        <a href="{{ route('products.show', $product) }}">
                            @if($product->image_url)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-card-img">
                            @else
                                <img src="https://via.placeholder.com/400x200?text=No+Image" alt="{{ $product->name }}" class="product-card-img">
                            @endif
                        </a>
                        <div class="mt-3">
                            <p class="text-success fw-bold">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                            <h6 class="fw-semibold"><a href="{{ route('products.show', $product) }}" class="text-decoration-none text-dark">{{ $product->name }}</a></h6>
                            @if($product->category)
                                <small class="text-muted">Kategori: {{ $product->category->name }}</small>
                            @endif
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                @php $avgRating = round($product->rating_avg ?? 0, 1); @endphp
                                <span class="text-warning small">
                                    @for($star = 1; $star <= 5; $star++)
                                        {!! $star <= round($avgRating) ? '&#9733;' : '&#9734;' !!}
                                    @endfor
                                    ({{ $avgRating ?: '-' }})
                                </span>
                                <span class="text-muted small">Terjual {{ number_format($product->sold_total ?? 0) }}</span>
                            </div>
                        </div>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-auto">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success w-100">
                                <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted">Belum ada produk aktif. Tambahkan produk baru melalui panel admin.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
