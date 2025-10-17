{{-- Navbar --}}
<nav class="navbar-waroenk d-flex align-items-center fixed-top" style="gap:16px;padding:1rem 1.5rem;justify-content:space-between;">
    {{-- Logo --}}
    <a href="{{ url('/') }}" class="brand">
        <img src="{{ asset('images/logo.png') }}" alt="Waroenk Logo">
    </a>
    {{-- Navigasi & Search hanya tampil jika bukan di halaman login/register --}}
    @if (!Request::is('login') && !Request::is('register'))
        <div class="d-flex align-items-center gap-3" style="max-width:720px; width:100%; margin:0 auto; justify-content:center;">
            <form action="/search" class="search-bar flex-grow-1" style="max-width:100%;">
                <div class="input-group position-relative">
                    <input id="search-bar" type="text" placeholder="Cari produk disini..." name="q"
                        class="form-control rounded-pill pe-5 shadow-sm" required aria-label="Cari produk">
                    <button type="submit" class="btn position-absolute end-0 top-50 translate-middle-y me-1" aria-label="Cari">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    @endif
    {{-- Keranjang + Auth --}}
    <div class="d-flex align-items-center position-relative" style="gap:12px;">
        @if (!Request::is('login') && !Request::is('register'))
            <a href="{{ url('/cart') }}" class="btn btn-light position-relative">
                <i class="bi bi-cart" style="font-size: 1.4rem;"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ session('cart') ? count(session('cart')) : 0 }}
                    <span class="visually-hidden">unread messages</span>
                </span>
            </a>
        @endif
        {{-- Keranjang
        <a href="{{ url('/cart') }}" class="btn btn-light position-relative me-3">
            <i class="bi bi-cart" style="font-size: 1.4rem;"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ session('cart') ? count(session('cart')) : 0 }}
                <span class="visually-hidden">unread messages</span>
        </a> --}}
        {{-- Kalau user belum login --}}
        @guest
            @if (!Request::is('login') && !Request::is('register'))
                <a href="{{ route('login') }}" class="btn-login">Login</a>
                <a href="{{ route('register') }}" class="btn-signup">Daftar</a>
            @endif
        @endguest
        {{-- Kalau user sudah login --}}
        @auth
            <div class="dropdown">
                <a href="#" class="me-3 text-decoration-none text-dark d-flex align-items-center gap-2" role="button" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle" style="font-size:1.4rem;"></i>
                    {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="min-width:220px; border-radius:16px;">
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('profile.show') }}">
                            <i class="bi bi-person"></i> Profil Saya
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('orders.index') }}">
                            <i class="bi bi-box"></i> Pesanan
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="dropdown-item d-flex align-items-center gap-2" type="submit">
                                <i class="bi bi-box-arrow-right"></i> Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @endauth
    </div>
</nav>
