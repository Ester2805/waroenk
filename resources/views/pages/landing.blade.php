@extends('layouts.app')

@section('title', 'Home')

@section('content')
<style>
    :root {
        --waroenk-green: #2e7d32;
        --waroenk-green-soft: #66bb6a;
        --waroenk-cream: #fffdf5;
        --waroenk-surface: #ffffff;
        --waroenk-text: #1f2933;
        --waroenk-muted: #6b7280;
    }

    body { background: #f4f6fb; }

    .landing-hero {
        background: linear-gradient(135deg, #2e7d32 0%, #66bb6a 50%, #9ccc65 100%);
        border-radius: 32px;
        position: relative;
        overflow: hidden;
        color: #fff;
    }

    .landing-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 20% 20%, rgba(255, 255, 255, 0.25), transparent 55%),
            radial-gradient(circle at 80% 0%, rgba(255, 255, 255, 0.18), transparent 50%);
        pointer-events: none;
    }

    .landing-hero .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 16px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(8px);
        font-weight: 600;
        letter-spacing: .5px;
    }

    .hero-btn-primary {
        background: #fff;
        color: var(--waroenk-green);
        border-radius: 999px;
        padding: 12px 28px;
        font-weight: 600;
        transition: transform .2s ease, box-shadow .2s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .hero-btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.18);
        color: var(--waroenk-green);
    }

    .hero-btn-outline {
        border-radius: 999px;
        border: 2px solid rgba(255, 255, 255, 0.8);
        padding: 12px 28px;
        color: #fff;
        font-weight: 600;
        transition: background .2s ease, transform .2s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .hero-btn-outline:hover {
        background: rgba(255, 255, 255, 0.15);
        color: #fff;
        transform: translateY(-1px);
    }

    .hero-stats {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 32px;
        color: rgba(255, 255, 255, 0.85);
    }

    .hero-stat-item {
        min-width: 160px;
        background: rgba(255, 255, 255, 0.12);
        border-radius: 20px;
        padding: 16px 20px;
        backdrop-filter: blur(6px);
    }

    .hero-stat-item h4 {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 4px;
        color: #fff;
    }

    .feature-card {
        background: var(--waroenk-surface);
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 14px 40px rgba(15, 23, 42, 0.08);
        height: 100%;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .feature-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 48px rgba(15, 23, 42, 0.12);
    }

    .feature-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: rgba(46, 125, 50, 0.12);
        color: var(--waroenk-green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 16px;
    }

    .category-strip {
        display: flex;
        gap: 16px;
        overflow-x: auto;
        padding-bottom: 8px;
        scrollbar-width: thin;
    }

    .category-chip {
        flex: 0 0 auto;
        min-width: 180px;
        padding: 16px 20px;
        border-radius: 18px;
        background: var(--waroenk-surface);
        border: 1px solid rgba(148, 163, 184, 0.25);
        text-decoration: none;
        color: var(--waroenk-text);
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.04);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .category-chip:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 32px rgba(15, 23, 42, 0.1);
        color: var(--waroenk-green);
    }

    .product-card {
        background: var(--waroenk-surface);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 48px rgba(15, 23, 42, 0.08);
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.12);
    }

    .hero-logo-wrap {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        text-align: right;
        padding-right: 32px;
    }

    .hero-logo {
        max-height: 520px;
        width: 100%;
        max-width: 520px;
    }

    .product-card-img-wrap {
        position: relative;
        background: #f1f5f9;
        padding: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 220px;
    }

    .product-card-img {
        width: 100%;
        height: 220px;
        object-fit: contain;
    }

    .product-rating {
        position: absolute;
        top: 16px;
        left: 16px;
        background: rgba(0,0,0,0.65);
        color: #fff;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: .85rem;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .product-content {
        padding: 24px;
        display: flex;
        flex-direction: column;
        gap: 12px;
        flex: 1;
    }

    .product-price {
        color: var(--waroenk-green);
        font-weight: 700;
        font-size: 1.1rem;
    }

    .product-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: .9rem;
        color: var(--waroenk-muted);
    }

    .product-card .btn-cart {
        border-radius: 14px;
        font-weight: 600;
        padding: 12px;
    }

    .cta-banner {
        background: linear-gradient(135deg, rgba(46,125,50,0.12), rgba(102,187,106,0.12));
        border-radius: 26px;
        padding: 48px;
    }

    .cta-banner .btn {
        border-radius: 999px;
        padding: 12px 28px;
        font-weight: 600;
    }

    @media (max-width: 992px) {
        .landing-hero {
            border-radius: 24px;
        }

        .hero-stats {
            gap: 12px;
        }

        .hero-logo-wrap {
            justify-content: center;
            margin-top: 24px;
            padding-right: 0;
        }

        .hero-logo {
            max-height: 320px;
            max-width: 320px;
        }
    }

    @media (max-width: 576px) {
        .category-chip {
            min-width: 150px;
            padding: 14px 16px;
        }

        .landing-hero {
            padding: 32px 24px;
        }
    }
</style>

<div class="container-fluid px-0">
    {{-- Hero --}}
    <section class="landing-hero mt-4 position-relative">
        <div class="position-relative z-1">
            <div class="row g-4 align-items-center px-4 px-md-5 py-5">
                <div class="col-lg-6">
                    <span class="hero-badge">
                        <i class="bi bi-stars"></i>
                        UMKM Pilihan Nusantara
                    </span>
                    <h1 class="display-5 fw-bold mt-3 mb-3">Belanja Produk Lokal dengan Rasa Percaya</h1>
                    <p class="lead mb-4">Temukan kreasi terbaik dari pengusaha rumahan hingga UMKM terkurasi. Kami bantu kamu belanja sambil berdampak untuk komunitas.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('products.index') }}" class="hero-btn-primary">
                            Jelajahi Produk
                            <i class="bi bi-arrow-right"></i>
                        </a>
                        <a href="{{ route('about') }}" class="hero-btn-outline">
                            Kenali Waroenk
                        </a>
                    </div>
                    <div class="hero-stats">
                        <div class="hero-stat-item">
                            <h4>{{ number_format($categories->count()) }}+</h4>
                            <span>Kategori UMKM</span>
                        </div>
                        <div class="hero-stat-item">
                            <h4>{{ number_format($featuredProducts->count()) }}+</h4>
                            <span>Produk Rekomendasi</span>
                        </div>
                        <div class="hero-stat-item">
                            <h4>100%</h4>
                            <span>Kualitas Terjamin</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 hero-logo-wrap">
                    <img src="{{ asset('images/logo-putih.png') }}" class="hero-logo" alt="Logo Waroenk">
                </div>
            </div>
        </div>
    </section>

    {{-- Value Proposition --}}
    <section class="container-fluid px-3 px-md-5 px-xl-5 py-5">
        <div class="text-center mb-5">
            <span class="text-uppercase fw-semibold text-success">Kenapa Waroenk</span>
            <h2 class="fw-bold mt-2 mb-3">Dukungan Nyata untuk Pelaku UMKM</h2>
            <p class="text-muted mb-0">Kami membantu kamu menemukan produk autentik dengan pengalaman belanja yang mulus dan aman.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-bag-heart"></i>
                    </div>
                    <h5 class="fw-semibold mb-2">Kurasi Produk Lokal</h5>
                    <p class="text-muted mb-0">Setiap barang melewati proses kurasi agar hanya produk berkualitas yang tampil di etalase Waroenk.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-emoji-smile"></i>
                    </div>
                    <h5 class="fw-semibold mb-2">Beli Sambil Berdampak</h5>
                    <p class="text-muted mb-0">Transaksi kamu langsung mendukung pelaku usaha kecil yang tersebar di berbagai daerah.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h5 class="fw-semibold mb-2">Transaksi Aman</h5>
                    <p class="text-muted mb-0">Pembayaran terintegrasi, pelacakan pesanan transparan, dan dukungan pelanggan yang responsif.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Kategori --}}
    <section class="container-fluid px-3 px-md-5 px-xl-5 pb-5" id="section-kategori">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <h2 class="fw-bold mb-1">Kategori Teratas</h2>
                <p class="text-muted mb-0">Jelajahi kategori favorit dan temukan produk yang lagi hits.</p>
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-outline-success px-4">Lihat Semua Produk</a>
        </div>
        @if($categories->isNotEmpty())
            <div class="category-strip">
                @foreach($categories->take(10) as $category)
                    <a href="{{ route('products.index', ['category' => $category->id]) }}" class="category-chip">
                        <span>{{ $category->name }}</span>
                        <i class="bi bi-arrow-up-right"></i>
                    </a>
                @endforeach
            </div>
        @else
            <div class="bg-white border rounded-4 p-4 text-center text-muted">
                Kategori belum tersedia. Tambahkan kategori melalui panel admin.
            </div>
        @endif
    </section>

    {{-- Rekomendasi Produk --}}
    <section class="container-fluid px-3 px-md-5 px-xl-5 pb-5">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <h2 class="fw-bold mb-1">Rekomendasi Produk</h2>
                <p class="text-muted mb-0">Produk terpilih dengan rating terbaik dan order tertinggi.</p>
            </div>
            @auth
                <a href="{{ route('products.index') }}" class="btn btn-success px-4">Belanja Sekarang</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-success px-4">Belanja Sekarang</a>
            @endauth
        </div>
        <div class="row g-4">
            @forelse($featuredProducts as $product)
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                    <div class="product-card">
                        <a href="{{ route('products.show', $product) }}" class="text-decoration-none text-dark">
                            <div class="product-card-img-wrap">
                                @php $avgRating = round($product->rating_avg ?? 0, 1); @endphp
                                <span class="product-rating">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    {{ $avgRating ?: '-' }}
                                </span>
                                @if($product->image_url)
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-card-img">
                                @else
                                    <img src="https://via.placeholder.com/400x220?text=No+Image" alt="{{ $product->name }}" class="product-card-img">
                                @endif
                            </div>
                            <div class="product-content">
                                <div>
                                    <span class="product-price">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                    <h5 class="fw-semibold mt-2 mb-1">{{ $product->name }}</h5>
                                    @if($product->category)
                                        <small class="text-muted">Kategori: {{ $product->category->name }}</small>
                                    @endif
                                </div>
                                <div class="product-meta">
                                    <span><i class="bi bi-people"></i> Terjual {{ number_format($product->sold_total ?? 0) }}</span>
                                    <span><i class="bi bi-clock-history"></i> {{ $product->created_at?->diffForHumans(['short' => true]) }}</span>
                                </div>
                            </div>
                        </a>
                        <div class="px-4 pb-4">
                            @auth
                                @if (!auth()->user()->isAdmin())
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="js-add-to-cart-form" data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-cart w-100">
                                            <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                                        </button>
                                    </form>
                                @else
                                    <div class="btn btn-outline-secondary disabled w-100">
                                        <i class="bi bi-shield-lock"></i> Fitur pelanggan
                                    </div>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-success btn-cart w-100">
                                    <i class="bi bi-box-arrow-in-right"></i> Masuk untuk Belanja
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="bg-white border rounded-4 p-5 text-center text-muted">
                        Belum ada produk aktif. Tambahkan produk baru melalui panel admin.
                    </div>
                </div>
            @endforelse
        </div>
    </section>

</div>
@endsection
