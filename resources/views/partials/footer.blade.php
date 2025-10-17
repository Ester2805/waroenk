{{-- Footer --}}
<footer id="site-footer" class="text-white pt-5 pb-4" style="background-color: #20232A;">
    <div class="container text-center text-md-start">
        <div class="row text-center text-md-start">
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <img src="{{ asset('images/logo.png') }}" alt="Waroenk Logo" class="height: 20px;">
                <p>
                    Platform digital untuk mendukung dan memajukan UMKM lokal. 
                    Temukan produk unik dan berkualitas langsung dari pengrajinnya.
                </p>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 fw-bold">Jelajahi</h5>
                <p><a href="{{ route('products.index') }}" class="text-white" style="text-decoration: none;">Semua Produk</a></p>
                <p><a href="{{ route('landing') }}#section-kategori" class="text-white" style="text-decoration: none;">Kategori</a></p>
                <p><a href="{{ route('about') }}" class="text-white" style="text-decoration: none;">Tentang Kami</a></p>
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
            <div class="col-md-5 col-lg-4"></div>
        </div>
    </div>
</footer>
