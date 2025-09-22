@extends('layouts.app')

@section('title', 'Home')

@section('content')
<style>
    body { background-color: #f9fafb; }
    .text-waroenk-green { color: #2e7d32; }
    .btn-waroenk {
        background-color: #2e7d32;
        color: #fff;
        border-radius: 8px;
        padding: 10px 24px;
        font-weight: 600;
        text-decoration: none;
        transition: background-color .2s;
    }
    .btn-waroenk:hover {
        background-color: #256029;
        color: #fff;
    }
    .btn-outline-waroenk {
        border: 2px solid #2e7d32;
        color: #2e7d32;
        border-radius: 8px;
        padding: 10px 24px;
        font-weight: 600;
        text-decoration: none;
        transition: all .2s;
    }
    .btn-outline-waroenk:hover {
        background-color: #2e7d32;
        color: #fff;
    }
    /* Statistik */
    .stat-box {
        background: #ffffff;
        border-radius: 12px;
        padding: 16px 24px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        text-align: center;
        min-width: 120px;
    }
    .stat-box h6 { font-weight: 700; margin-bottom: 4px; }
    /* Produk */
    .product-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        position: relative;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        transition: transform .2s;
    }
    .product-card:hover { transform: translateY(-4px); }
    .product-card img {
        padding: 20px;
        height: 200px;
        object-fit: contain;
    }
</style>

<div class="container py-5">
    <div class="row align-items-center">
        {{-- Kiri: Teks Utama --}}
        <div class="col-md-6 mb-5 mb-md-0">
            <h1 class="fw-bold mb-3">Waroenk</h1>
            <h5 class="fw-semibold text-waroenk-green mb-3">
                Tempat terbaik untuk memenuhi semua kebutuhanmu
            </h5>
            <p class="mb-4">
                Dukung UMKM lokal dengan berbelanja di Waroenk!
                Temukan produk unik, berkualitas, dan terjangkau
                langsung dari para pelaku usaha di sekitar Anda.
            </p>

            {{-- Statistik --}}
            <div class="d-flex flex-wrap gap-3 mt-5">
                <div class="stat-box">
                    <h6>+12.5 k</h6>
                    <small class="text-muted">Terjual</small>
                </div>
                <div class="stat-box">
                    <h6>1.4 k</h6>
                    <small class="text-muted">UMKM Aktif</small>
                </div>
                <div class="stat-box">
                    <h6>4.8 ⭐</h6>
                    <small class="text-muted">Rating</small>
                </div>
            </div>
        </div>

        {{-- Kanan: Produk --}}
        <div class="col-md-6">
            <div class="row g-4">
                <div class="col-6">
                    <div class="product-card">
                        <img src="{{ asset('images/dress.jpg') }}" alt="Dress" class="w-100">
                        <div class="card-body text-center">
                            <h6 class="fw-semibold mb-0">Dress</h6>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="product-card">
                        <img src="{{ asset('images/sepatu-wanita.jpg') }}" alt="Sepatu Wanita" class="w-100">
                        <div class="card-body text-center">
                            <h6 class="fw-semibold mb-0">Sepatu Wanita</h6>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="product-card">
                        <img src="{{ asset('images/kemeja-pria.jpg') }}" alt="Kemeja Pria" class="w-100">
                        <div class="card-body text-center">
                            <h6 class="fw-semibold mb-0">Kemeja Pria</h6>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="product-card">
                        <img src="{{ asset('images/sembako.jpg') }}" alt="Sembako" class="w-100">
                        <div class="card-body text-center">
                            <h6 class="fw-semibold mb-0">Sembako</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
