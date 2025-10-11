{{-- Navbar --}}
<nav class="navbar-waroenk d-flex justify-content-between align-items-center fixed-top">
    {{-- Logo --}}
    <a href="{{ url('/') }}" class="brand">
        <img src="{{ asset('images/logo.png') }}" alt="Waroenk Logo">
    </a>
    {{-- Search Bar hanya tampil jika bukan di halaman login --}}
    @if (!Request::is('login') && !Request::is('register'))
        <form action="/search" class="flex-grow-1 mx-2" style="max-width: 600px;">
            <div class="input-group position-relative">
                <input id="search-bar" type="text" placeholder="Cari produk disini..." name="q"
                    class="form-control rounded-pill pe-5 shadow-sm" required aria-label="Cari produk">
                <button type="submit" class="btn position-absolute end-0 top-50 translate-middle-y me-1" aria-label="Cari">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
        {{-- Keranjang --}}
        <a href="{{ url('/cart') }}" class="btn btn-light position-relative me-3">
            <i class="bi bi-cart" style="font-size: 1.4rem;"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ session('cart') ? count(session('cart')) : 0 }}
                <span class="visually-hidden">unread messages</span>
        </a>
    @endif
    {{-- Keranjang + Auth --}}
    <div class="d-flex align-items-center">
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
            <span class="me-3">Halo, {{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn-signup">Logout</button>
            </form>
        @endauth
    </div>
</nav>
