<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Waroenk')</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            padding-top: 90px; /* ruang untuk navbar fixed */
        }
        .navbar-waroenk {
            background-color: #f9fafb;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar-waroenk .brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #2e7d32;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        .navbar-waroenk .brand img {
            height: 45px;
            margin-right: 8px;
        }
        .btn-login {
            background-color: #2e7d32;
            color: #fff;
            border-radius: 6px;
            padding: 6px 16px;
            margin-right: 0.5rem;
            border: none;
            text-decoration: none;
        }
        .btn-login:hover { background-color: #256029; }
        .btn-signup {
            background-color: transparent;
            border: 1px solid #2e7d32;
            color: #2e7d32;
            border-radius: 6px;
            padding: 6px 16px;
            text-decoration: none;
        }
        .btn-signup:hover { background-color: #e8f5e9; }
    </style>
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar-waroenk d-flex justify-content-between align-items-center fixed-top">
        {{-- Logo --}}
        <a href="{{ url('/') }}" class="brand">
            <img src="{{ asset('images/logo.png') }}" alt="Waroenk Logo">
        </a>

        {{-- Search Bar --}}
        <form action="/search" class="flex-grow-1 mx-2" style="max-width: 600px;">
            <div class="input-group position-relative">
                <input id="search-bar" type="text" placeholder="Cari produk disini..." name="q"
                    class="form-control rounded-pill pe-5 shadow-sm" required aria-label="Cari produk">
                <button type="submit" class="btn position-absolute end-0 top-50 translate-middle-y me-1" aria-label="Cari">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>

        {{-- Keranjang + Auth --}}
        <div class="d-flex align-items-center">
            {{-- Keranjang --}}
            <a href="{{ url('/cart') }}" class="btn btn-light position-relative me-3">
                <i class="bi bi-cart" style="font-size: 1.4rem;"></i>
                {{-- Badge jumlah item di keranjang --}}
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    3
                </span>
            </a>

            {{-- Kalau user belum login --}}
            @guest
                <a href="{{ route('login') }}" class="btn-login">Login</a>
                <a href="{{ route('register') }}" class="btn-signup">Sign Up</a>
            @endguest

            {{-- Kalau user sudah login --}}
            @auth
                <span class="me-3">Halo, {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-signup">Logout</button>
                </form>
            @endauth
        </div>
    </nav>

    <main class="p-4">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="text-white pt-5 pb-4" style="background-color: #20232A;">
        <div class="container text-center text-md-start">
            <div class="row text-center text-md-start">
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Waroenk Logo" class="height: 20px;">
                    <p>
                        Platform digital untuk mendukung dan memajukan UMKM lokal. 
                        Temukan produk unik dan berkualitas langsung dari pengrajinnya.
                    </p>
                </div>
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 fw-bold">Jelajahi</h5>
                    <p><a href="#" class="text-white" style="text-decoration: none;">Produk Terbaru</a></p>
                    <p><a href="#" class="text-white" style="text-decoration: none;">Diskon</a></p>
                    <p><a href="#" class="text-white" style="text-decoration: none;">Kategori Populer</a></p>
                    <p><a href="#" class="text-white" style="text-decoration: none;">Semua Produk</a></p>
                </div>
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 fw-bold">Bantuan</h5>
                    <p><a href="#" class="text-white" style="text-decoration: none;">Tentang Kami</a></p>
                    <p><a href="#" class="text-white" style="text-decoration: none;">Hubungi Kami</a></p>
                    <p><a href="#" class="text-white" style="text-decoration: none;">FAQ</a></p>
                    <p><a href="#" class="text-white" style="text-decoration: none;">Kebijakan Privasi</a></p>
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 fw-bold">Kontak</h5>
                    <p><i class="bi bi-house-door-fill me-3"></i> Semarang, Jawa Tengah, ID</p>
                    <p><i class="bi bi-envelope-fill me-3"></i> kontak@waroenk.com</p>
                    <p><i class="bi bi-telephone-fill me-3"></i> +62 812 3456 7890</p>
                </div>
            </div>

            <hr class="mb-4">

            <div class="row align-items-center">
                <div class="col-md-7 col-lg-8">
                    <p>
                        Copyright &copy;2025
                        <a href="#" style="text-decoration: none;">
                            <strong style="color: #2e7d32;">Waroenk</strong>
                        </a>. All Rights Reserved.
                    </p>
                </div>
                <div class="col-md-5 col-lg-4">
                    <div class="text-center text-md-end">
                        <a href="#" class="btn btn-outline-light btn-floating m-1"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="btn btn-outline-light btn-floating m-1"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="btn btn-outline-light btn-floating m-1"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="btn btn-outline-light btn-floating m-1"><i class="bi bi-tiktok"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
