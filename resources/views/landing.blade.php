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
        transition: background-color .2s;
    }
    .btn-waroenk:hover { background-color: #256029; color: #fff; }
    .btn-outline-waroenk {
        border: 2px solid #2e7d32;
        color: #2e7d32;
        border-radius: 8px;
        padding: 10px 24px;
        font-weight: 600;
        transition: all .2s;
    }
    .btn-outline-waroenk:hover { background-color: #2e7d32; color: #fff; }
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
        <div>
            <h2 class="fw-bold">Waroenk UMKM</h2>
            <p class="mb-3">Semua Ada di Satu Waroenk</p>
            <span class="bg-white text-success px-3 py-2 rounded fw-semibold">Ekstra Diskon 15%</span>
        </div>
        <img src="{{ asset('images/promo.png') }}" alt="Promo" class="mt-4 mt-md-0 rounded" style="max-height:120px;">
    </div>

    {{-- Kategori --}}
    <div class="py-5 px-4">
        <h2 class="fw-bold mb-4">Top Categories</h2>
        <div class="row g-4">
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="bg-light p-3 rounded text-center shadow-sm h-100">
                    <img src="https://readymadeui.com/images/fashion-img-1.webp" class="img-fluid rounded-circle mb-3" alt="Fashion">
                    <h6 class="fw-semibold small">Up To 40% OFF</h6>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="bg-light p-3 rounded text-center shadow-sm h-100">
                    <img src="https://readymadeui.com/images/fashion-img-2.webp" class="img-fluid rounded-circle mb-3" alt="Fashion">
                    <h6 class="fw-semibold small">Fresh Looks</h6>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="bg-light p-3 rounded text-center shadow-sm h-100">
                    <img src="https://readymadeui.com/images/fashion-img-7.webp" class="img-fluid rounded-circle mb-3" alt="Fashion">
                    <h6 class="fw-semibold small">Up To 30% OFF</h6>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="bg-light p-3 rounded text-center shadow-sm h-100">
                    <img src="https://readymadeui.com/images/fashion-img-4.webp" class="img-fluid rounded-circle mb-3" alt="Fashion">
                    <h6 class="fw-semibold small">Exclusive Fashion</h6>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="bg-light p-3 rounded text-center shadow-sm h-100">
                    <img src="https://readymadeui.com/images/fashion-img-5.webp" class="img-fluid rounded-circle mb-3" alt="Fashion">
                    <h6 class="fw-semibold small">Top Picks</h6>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="bg-light p-3 rounded text-center shadow-sm h-100">
                    <img src="https://readymadeui.com/images/fashion-img-6.webp" class="img-fluid rounded-circle mb-3" alt="Fashion">
                    <h6 class="fw-semibold small">Shop & Save</h6>
                </div>
            </div>
        </div>
    </div>

    {{-- Rekomendasi Produk --}}
    <div class="px-4 pb-5">
        <h2 class="fw-bold mb-4">Rekomendasi Produk</h2>
        <div class="row g-4">

            {{-- Produk 1 --}}
            <div class="col-6 col-md-4 col-lg-3">
                <div class="product-card p-3">
                    <img src="https://images.unsplash.com/photo-1628202926206-c63a34b1618f?q=80&w=500&auto=format" alt="Wireless Headphones" class="product-card-img">
                    <div class="mt-3">
                        <p class="text-success fw-bold">$49.99 <span class="text-muted text-decoration-line-through">$80.00</span></p>
                        <h6 class="fw-semibold">Wireless Headphones</h6>
                    </div>

                    {{-- Tombol Tambah Keranjang --}}
                    <form action="{{ route('cart.add', 1) }}" method="POST" class="mt-auto">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success w-100">
                            <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                        </button>
                    </form>
                </div>
            </div>

            {{-- Produk 2 --}}
            <div class="col-6 col-md-4 col-lg-3">
                <div class="product-card p-3">
                    <img src="{{ asset('images/sepatu-wanita.jpg') }}" alt="Sepatu Wanita" class="product-card-img">
                    <div class="mt-3">
                        <p class="text-success fw-bold">$35.50 <span class="text-muted text-decoration-line-through">$50.00</span></p>
                        <h6 class="fw-semibold">Sepatu Wanita Canvas</h6>
                    </div>

                    <form action="{{ route('cart.add', 2) }}" method="POST" class="mt-auto">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success w-100">
                            <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                        </button>
                    </form>
                </div>
            </div>

            {{-- Produk 3 --}}
            <div class="col-6 col-md-4 col-lg-3">
                <div class="product-card p-3">
                    <img src="{{ asset('images/kemeja-pria.jpg') }}" alt="Kemeja Pria" class="product-card-img">
                    <div class="mt-3">
                        <p class="text-success fw-bold">$29.99 <span class="text-muted text-decoration-line-through">$45.00</span></p>
                        <h6 class="fw-semibold">Kemeja Pria Formal</h6>
                    </div>

                    <form action="{{ route('cart.add', 3) }}" method="POST" class="mt-auto">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success w-100">
                            <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                        </button>
                    </form>
                </div>
            </div>

            {{-- Produk 4 --}}
            <div class="col-6 col-md-4 col-lg-3">
                <div class="product-card p-3">
                    <img src="{{ asset('images/dress.jpg') }}" alt="Summer Dress" class="product-card-img">
                    <div class="mt-3">
                        <p class="text-success fw-bold">$55.00 <span class="text-muted text-decoration-line-through">$70.00</span></p>
                        <h6 class="fw-semibold">Summer Floral Dress</h6>
                    </div>

                    <form action="{{ route('cart.add', 4) }}" method="POST" class="mt-auto">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success w-100">
                            <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                        </button>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
