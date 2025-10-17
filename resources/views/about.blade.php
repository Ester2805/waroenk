@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<section class="py-5" style="background: #f4f6f8;">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <h1 class="fw-bold text-success mb-3">Tentang Waroenk</h1>
                <p class="lead text-muted">Waroenk adalah ruang digital yang mempertemukan pelaku UMKM dengan pelanggan yang ingin barang berkualitas sekaligus berdampak.</p>
                <p>Kami percaya bahwa setiap produk lokal punya cerita. Tim kami membantu kurasi, mempermudah transaksi, dan membangun komunitas yang saling mendukung.</p>
                <a href="{{ route('products.index') }}" class="btn btn-success mt-3">Mulai Belanja Produk Lokal</a>
            </div>
            <div class="col-md-6 text-center">
                <img src="{{ asset('images/about-illustration.png') }}" alt="Tentang Waroenk" class="img-fluid" style="max-height: 260px;">
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h5 class="fw-semibold text-success mb-2">Misi</h5>
                        <p class="text-muted mb-0">Memberikan akses teknologi yang ramah bagi UMKM agar bisa menjangkau pasar yang lebih luas tanpa kehilangan identitas lokal.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h5 class="fw-semibold text-success mb-2">Nilai</h5>
                        <p class="text-muted mb-0">Transparansi, keaslian produk, dan keberlanjutan menjadi dasar kami mengambil keputusan setiap hari.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h5 class="fw-semibold text-success mb-2">Apa Selanjutnya?</h5>
                        <p class="text-muted">Kami terus menambahkan fitur yang memudahkan transaksi dan membuat pengalaman belanja semakin personal.</p>
                        <a href="{{ route('home') }}" class="btn btn-outline-success btn-sm mt-2">Jelajahi Etalase</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
