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
        display: block; /* Menjadikan tombol memenuhi lebar kontainer */
        text-align: center;
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
        display: block; /* Menjadikan tombol memenuhi lebar kontainer */
        text-align: center;
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

    /* --- GAYA KARTU PRODUK --- */
    .product-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        position: relative;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        transition: transform .2s ease-in-out;
        text-decoration: none; /* Menghilangkan garis bawah pada link */
        color: inherit; /* Mewarisi warna teks */
        display: flex;
        flex-direction: column;
        height: 100%; /* Membuat semua kartu sama tinggi */
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.08);
    }
    .product-card-img-container {
        padding: 1.5rem;
        background-color: #fff;
    }
    .product-card-img {
        width: 100%;
        height: 200px; /* Tinggi gambar seragam */
        object-fit: contain; /* Agar gambar tidak terdistorsi */
    }
    .product-card-body {
        padding: 0 1.5rem 1.5rem 1.5rem;
        flex-grow: 1; /* Mendorong tombol ke bawah */
        display: flex;
        flex-direction: column;
    }
    .product-card-title {
        font-weight: 600;
        font-size: 1.1rem;
        color: #333;
        margin-bottom: 0.5rem;
    }
    .product-card-price {
        color: #2e7d32;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }
    .product-card-price .original-price {
        text-decoration: line-through;
        color: #999;
        font-weight: 400;
        margin-left: 0.5rem;
    }
    .product-card-description {
        font-size: 0.9rem;
        color: #666;
        line-height: 1.5;
        margin-top: 0.5rem;
    }
    .product-card-actions {
        margin-top: auto; /* Mendorong tombol ke bagian bawah kartu */
        padding-top: 1rem;
    }
</style>

<div class="container py-5">
    {{-- Bagian Hero Section (Tidak diubah) --}}
    <div class="row align-items-center mb-5">
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
            <div class="d-flex flex-wrap gap-3 mt-5">
                <div class="stat-box"><h6>+12.5 k</h6> <small class="text-muted">Terjual</small></div>
                <div class="stat-box"><h6>1.4 k</h6> <small class="text-muted">UMKM Aktif</small></div>
                <div class="stat-box"><h6>4.8 ⭐</h6> <small class="text-muted">Rating</small></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row g-4">
                <div class="col-6"><div class="product-card"><div class="product-card-img-container"><img src="{{ asset('images/dress.jpg') }}" alt="Dress" class="product-card-img"></div><div class="card-body text-center"><h6 class="fw-semibold mb-0">Dress</h6></div></div></div>
                <div class="col-6"><div class="product-card"><div class="product-card-img-container"><img src="{{ asset('images/sepatu-wanita.jpg') }}" alt="Sepatu Wanita" class="product-card-img"></div><div class="card-body text-center"><h6 class="fw-semibold mb-0">Sepatu Wanita</h6></div></div></div>
                <div class="col-6"><div class="product-card"><div class="product-card-img-container"><img src="{{ asset('images/kemeja-pria.jpg') }}" alt="Kemeja Pria" class="product-card-img"></div><div class="card-body text-center"><h6 class="fw-semibold mb-0">Kemeja Pria</h6></div></div></div>
                <div class="col-6"><div class="product-card"><div class="product-card-img-container"><img src="{{ asset('images/sembako.jpg') }}" alt="Sembako" class="product-card-img"></div><div class="card-body text-center"><h6 class="fw-semibold mb-0">Sembako</h6></div></div></div>
            </div>
        </div>
    </div>

    {{-- --- BAGIAN PRODUK KAMI (VERSI STATIS) --- --}}
    <div class="mt-5 pt-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold display-5">Produk Kami</h2>
            <p class="text-muted">Jelajahi berbagai pilihan produk terbaik dari UMKM lokal.</p>
        </div>

        <div class="row g-4">

            {{-- Produk 1 --}}
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <a href="#" class="product-card">
                    <button class="position-absolute end-0 top-0 m-3 z-1 btn btn-light btn-sm rounded-circle" style="width: 32px; height: 32px;"><i class="bi bi-heart"></i></button>
                    <div class="product-card-img-container"><img src="https://images.unsplash.com/photo-1628202926206-c63a34b1618f?q=80&w=2574&auto=format&fit=crop" alt="Wireless Headphones" class="product-card-img" /></div>
                    <div class="product-card-body">
                        <div>
                            <p class="product-card-price">$49.99 <span class="original-price">$80.00</span></p>
                            <h3 class="product-card-title">Wireless Headphones</h3>
                            <p class="product-card-description d-none d-md-block">Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore nobis iure.</p>
                        </div>
                        <div class="product-card-actions"><div class="d-flex gap-2"><button type="button" class="btn-outline-waroenk w-100">Add to Cart</button><button type="button" class="btn-waroenk w-100">Buy Now</button></div></div>
                    </div>
                </a>
            </div>

            {{-- Produk 2 --}}
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <a href="#" class="product-card">
                    <button class="position-absolute end-0 top-0 m-3 z-1 btn btn-light btn-sm rounded-circle" style="width: 32px; height: 32px;"><i class="bi bi-heart"></i></button>
                    <div class="product-card-img-container"><img src="{{ asset('images/sepatu-wanita.jpg') }}" alt="Sepatu Wanita" class="product-card-img" /></div>
                    <div class="product-card-body">
                        <div>
                            <p class="product-card-price">$35.50 <span class="original-price">$50.00</span></p>
                            <h3 class="product-card-title">Sepatu Wanita Canvas</h3>
                            <p class="product-card-description d-none d-md-block">Sepatu canvas nyaman untuk kegiatan sehari-hari, desain stylish.</p>
                        </div>
                        <div class="product-card-actions"><div class="d-flex gap-2"><button type="button" class="btn-outline-waroenk w-100">Add to Cart</button><button type="button" class="btn-waroenk w-100">Buy Now</button></div></div>
                    </div>
                </a>
            </div>

            {{-- Produk 3 --}}
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <a href="#" class="product-card">
                    <button class="position-absolute end-0 top-0 m-3 z-1 btn btn-light btn-sm rounded-circle" style="width: 32px; height: 32px;"><i class="bi bi-heart"></i></button>
                    <div class="product-card-img-container"><img src="{{ asset('images/kemeja-pria.jpg') }}" alt="Kemeja Pria" class="product-card-img" /></div>
                    <div class="product-card-body">
                        <div>
                            <p class="product-card-price">$29.99 <span class="original-price">$45.00</span></p>
                            <h3 class="product-card-title">Kemeja Pria Formal</h3>
                            <p class="product-card-description d-none d-md-block">Kemeja lengan panjang untuk acara formal, bahan katun premium.</p>
                        </div>
                        <div class="product-card-actions"><div class="d-flex gap-2"><button type="button" class="btn-outline-waroenk w-100">Add to Cart</button><button type="button" class="btn-waroenk w-100">Buy Now</button></div></div>
                    </div>
                </a>
            </div>

            {{-- Produk 4 --}}
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <a href="#" class="product-card">
                    <button class="position-absolute end-0 top-0 m-3 z-1 btn btn-light btn-sm rounded-circle" style="width: 32px; height: 32px;"><i class="bi bi-heart-fill text-danger"></i></button>
                    <div class="product-card-img-container"><img src="{{ asset('images/dress.jpg') }}" alt="Summer Dress" class="product-card-img" /></div>
                    <div class="product-card-body">
                        <div>
                            <p class="product-card-price">$55.00 <span class="original-price">$70.00</span></p>
                            <h3 class="product-card-title">Summer Floral Dress</h3>
                            <p class="product-card-description d-none d-md-block">Dress bunga yang cantik, cocok untuk liburan musim panas di pantai.</p>
                        </div>
                        <div class="product-card-actions"><div class="d-flex gap-2"><button type="button" class="btn-outline-waroenk w-100">Add to Cart</button><button type="button" class="btn-waroenk w-100">Buy Now</button></div></div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</div>

@endsection