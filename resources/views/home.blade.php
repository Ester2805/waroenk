@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    body { background-color: #fff; font-family: Arial, sans-serif; }
    .header-bar {
        display: flex;
        align-items: center;
        padding: 16px;
        background-color: #ffffff;
    }
    .header-bar img {
        height: 40px;
        margin-right: 16px;
    }
    .search-box {
        flex: 1;
        display: flex;
        align-items: center;
        border: 2px solid #4caf50;
        border-radius: 6px;
        overflow: hidden;
    }
    .search-box input {
        border: none;
        padding: 8px;
        flex: 1;
        outline: none;
    }
    .search-box button {
        background: #4caf50;
        border: none;
        padding: 8px 12px;
        color: #fff;
        cursor: pointer;
    }

    /* Banner */
    .banner {
        margin: 20px;
        padding: 20px;
        background: #4caf50;
        color: #fff;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .banner-text h2 { font-size: 24px; font-weight: bold; }
    .banner-text p { margin: 6px 0; }
    .banner-text .discount {
        font-size: 28px;
        font-weight: bold;
        background: #fff;
        color: #2e7d32;
        padding: 6px 12px;
        border-radius: 6px;
        display: inline-block;
    }
    .banner img { max-height: 120px; border-radius: 6px; }

    /* Kategori */
    .kategori {
        margin: 20px;
    }
    .kategori h4 {
        font-weight: bold;
        margin-bottom: 16px;
    }
    .kategori-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }
    .kategori-item {
        background: #4caf50;
        border-radius: 8px;
        text-align: center;
        color: #000;
        padding: 16px;
    }
    .kategori-item img {
        max-height: 120px;
        margin-bottom: 10px;
    }
    .kategori-item h6 {
        font-weight: bold;
        font-size: 16px;
        text-transform: uppercase;
    }
</style>

<div class="container">

    {{-- Header --}}
    <div class="header-bar">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
        <div class="search-box">
            <input type="text" placeholder="Cari produk">
            <button><i class="fa fa-search"></i></button>
        </div>
    </div>

    {{-- Banner --}}
    <div class="banner">
        <div class="banner-text">
            <h2>Waroenk UMKM</h2>
            <p>Semua Ada di Satu Waroenk</p>
            <span class="discount">Ekstra Diskon 15%</span>
        </div>
        <img src="{{ asset('images/promo.png') }}" alt="Promo">
    </div>

    {{-- Kategori --}}
    <div class="kategori">
        <h4>Kategori</h4>
        <div class="kategori-grid">
            <div class="kategori-item">
                <img src="{{ asset('images/fashion.png') }}" alt="Fashion">
                <h6>Fashion</h6>
            </div>
            <div class="kategori-item">
                <img src="{{ asset('images/food.png') }}" alt="Food">
                <h6>Food & Drink</h6>
            </div>
            <div class="kategori-item">
                <img src="{{ asset('images/home.png') }}" alt="Home">
                <h6>Home</h6>
            </div>
            <div class="kategori-item">
                <img src="{{ asset('images/accessories.png') }}" alt="Accessories">
                <h6>Accessories & Decorations</h6>
            </div>
        </div>
    </div>

</div>
@endsection
