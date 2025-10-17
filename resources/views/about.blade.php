@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<style>
    .about-hero {
        background: radial-gradient(circle at top left, rgba(102, 187, 106, 0.18), transparent 55%),
            radial-gradient(circle at bottom right, rgba(46, 125, 50, 0.18), transparent 50%),
            linear-gradient(135deg, rgba(46, 125, 50, 0.08), rgba(102, 187, 106, 0.05));
        padding: clamp(48px, 10vw, 96px) 0;
    }

    .about-hero .btn-primary {
        background: #2e7d32;
        border-color: #2e7d32;
        border-radius: 999px;
        padding: 12px 28px;
        font-weight: 600;
    }

    .about-highlight {
        background: #ffffff;
        border-radius: 24px;
        padding: clamp(32px, 5vw, 48px);
        box-shadow: 0 20px 60px rgba(15, 23, 42, 0.08);
        margin-top: -60px;
        position: relative;
        z-index: 2;
    }

    .about-card {
        border-radius: 20px;
        border: none;
        box-shadow: 0 16px 40px rgba(15, 23, 42, 0.06);
        transition: transform .2s ease, box-shadow .2s ease;
        height: 100%;
    }

    .about-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.12);
    }

    .about-card h5 {
        color: #2e7d32;
    }

    .about-card .btn-outline-success {
        border-radius: 999px;
        padding: 8px 20px;
        border-width: 2px;
    }

    .about-section {
        padding-bottom: clamp(64px, 12vw, 120px);
    }

    @media (max-width: 767.98px) {
        .about-highlight {
            margin-top: -40px;
        }
    }
</style>

<section class="about-section" style="background: #f4f7fb;">
    <div class="about-hero">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <span class="badge bg-success bg-opacity-10 text-success fw-semibold px-3 py-2 mb-3">Kenali Kami</span>
                    <h1 class="fw-bold text-dark mb-3">Tentang Waroenk</h1>
                    <p class="lead text-muted mb-4">Waroenk adalah ruang digital yang mempertemukan pelaku UMKM dengan pelanggan yang ingin barang berkualitas sekaligus berdampak.</p>
                    <p class="text-muted mb-4">Kami percaya tiap produk lokal punya cerita. Tim kami membantu kurasi, mempermudah transaksi, dan membangun komunitas saling mendukung agar UMKM tumbuh lebih cepat.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">Mulai Belanja Produk Lokal</a>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('images/about-illustration.png') }}" alt="Tentang Waroenk" class="img-fluid" style="max-height: 320px;">
                </div>
            </div>
        </div>
    </div>

    <div class="container about-highlight">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card about-card">
                    <div class="card-body p-4">
                        <h5 class="fw-semibold mb-3">Misi</h5>
                        <p class="text-muted mb-0">Memberikan akses teknologi ramah UMKM agar menjangkau pasar lebih luas tanpa kehilangan identitas lokal sekaligus menjaga kualitas produk.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card about-card">
                    <div class="card-body p-4">
                        <h5 class="fw-semibold mb-3">Nilai</h5>
                        <p class="text-muted mb-0">Transparansi, keaslian produk, dan keberlanjutan menjadi dasar setiap keputusan kami untuk memastikan pengalaman belanja yang jujur.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card about-card">
                    <div class="card-body p-4 d-flex flex-column">
                        <h5 class="fw-semibold mb-3">Apa Selanjutnya?</h5>
                        <p class="text-muted flex-grow-1">Kami terus menambah fitur yang memudahkan transaksi, mempercepat logistik, dan menghadirkan pengalaman belanja personal.</p>
                        <a href="{{ route('landing') }}" class="btn btn-outline-success btn-sm mt-3 align-self-start">Jelajahi Etalase</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    body { background: #f4f7fb; }
</style>
@endsection
