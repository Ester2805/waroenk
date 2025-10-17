{{-- Navbar --}}
<style>
    .navbar-waroenk {
        background: rgba(255, 255, 255, 0.88);
        backdrop-filter: blur(18px);
        border-bottom: 1px solid rgba(148, 163, 184, 0.12);
        box-shadow: 0 16px 40px rgba(15, 23, 42, 0.08);
        z-index: 1030;
    }

    .navbar-waroenk .navbar-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
    }

    .navbar-waroenk .brand img {
        height: 42px;
        transition: transform .2s ease;
    }

    .navbar-waroenk .brand:hover img {
        transform: scale(1.04);
    }

    .navbar-waroenk .navbar-search {
        flex: 1;
        max-width: 620px;
    }

    .navbar-waroenk .search-bar {
        display: flex;
        align-items: center;
        border-radius: 999px;
        background: #f8fafc;
        border: 1px solid rgba(148, 163, 184, 0.4);
        padding: 4px;
        transition: box-shadow .2s ease, border-color .2s ease;
    }

    .navbar-waroenk .search-bar:focus-within {
        box-shadow: 0 6px 20px rgba(102, 187, 106, 0.18);
        border-color: #66bb6a;
    }

    .navbar-waroenk .search-bar input {
        flex: 1;
        border: none;
        background: transparent;
        padding: 10px 16px;
        font-size: 0.95rem;
    }

    .navbar-waroenk .search-bar input:focus {
        outline: none;
    }

    .navbar-waroenk .search-bar button {
        border: none;
        background: #2e7d32;
        color: #fff;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .navbar-waroenk .search-bar button:hover {
        transform: scale(1.04);
        box-shadow: 0 8px 20px rgba(46, 125, 50, 0.32);
    }

    .navbar-waroenk .navbar-actions {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .navbar-waroenk .btn-cart {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 46px;
        height: 46px;
        border-radius: 14px;
        background: rgba(46, 125, 50, 0.08);
        color: #2e7d32;
        border: none;
        transition: background .2s ease, transform .2s ease;
    }

    .navbar-waroenk .btn-cart:hover {
        background: rgba(46, 125, 50, 0.14);
        transform: translateY(-2px);
    }

    .navbar-waroenk .btn-cart .badge {
        position: absolute;
        top: -4px;
        right: -6px;
        font-size: 0.7rem;
        border-radius: 999px;
        padding: 4px 6px;
    }

    .navbar-waroenk .btn-login {
        color: #1f2933;
        font-weight: 600;
        text-decoration: none;
        padding: 10px 18px;
        border-radius: 999px;
        transition: color .2s ease;
    }

    .navbar-waroenk .btn-login:hover {
        color: #2e7d32;
    }

    .navbar-waroenk .btn-signup {
        background: #2e7d32;
        color: #fff;
        padding: 10px 20px;
        border-radius: 999px;
        font-weight: 600;
        text-decoration: none;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .navbar-waroenk .btn-signup:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(46, 125, 50, 0.25);
        color: #fff;
    }

    .navbar-waroenk .dropdown-menu {
        border-radius: 18px !important;
        padding: 12px;
        box-shadow: 0 20px 45px rgba(15, 23, 42, 0.16);
    }

    @media (max-width: 992px) {
        .navbar-waroenk .navbar-inner {
            flex-wrap: wrap;
            gap: 12px;
        }

        .navbar-waroenk .navbar-search {
            order: 3;
            flex: 1 0 100%;
        }

        .navbar-waroenk .navbar-actions {
            order: 2;
            width: 100%;
            justify-content: flex-end;
        }

        .navbar-waroenk .btn-login,
        .navbar-waroenk .btn-signup {
            padding: 8px 16px;
        }
    }

    @media (max-width: 576px) {
        .navbar-waroenk {
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }

        .navbar-waroenk .brand img {
            height: 36px;
        }

        .navbar-waroenk .btn-cart {
            width: 42px;
            height: 42px;
        }

        .navbar-waroenk .search-bar input {
            padding: 10px 46px 10px 16px;
        }
    }
</style>

<nav class="navbar-waroenk fixed-top">
    <div class="container-fluid px-3 px-md-4">
        <div class="navbar-inner">
            {{-- Logo --}}
            <a href="{{ url('/') }}" class="brand d-flex align-items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Waroenk Logo">
            </a>

            {{-- Search --}}
            @if (!Request::is('login') && !Request::is('register'))
                <div class="navbar-search">
                    <form action="/search" class="search-bar">
                        <input id="search-bar" type="text" placeholder="Cari produk lokal terbaik..." name="q" required aria-label="Cari produk">
                        <button type="submit" aria-label="Cari">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </div>
            @endif

            {{-- Cart & Auth --}}
            <div class="navbar-actions">
                @if (!Request::is('login') && !Request::is('register'))
                    <a href="{{ url('/cart') }}" class="btn-cart" aria-label="Lihat keranjang">
                        <i class="bi bi-cart fs-5"></i>
                        <span class="badge bg-danger">
                            {{ session('cart') ? count(session('cart')) : 0 }}
                        </span>
                    </a>
                @endif

                @guest
                    @if (!Request::is('login') && !Request::is('register'))
                        <a href="{{ route('login') }}" class="btn-login">Login</a>
                        <a href="{{ route('register') }}" class="btn-signup">Daftar</a>
                    @endif
                @endguest

                @auth
                    <div class="dropdown">
                        <a href="#" class="text-decoration-none text-dark d-flex align-items-center gap-2" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle fs-4 text-success"></i>
                            <span class="fw-semibold">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
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
        </div>
    </div>
</nav>
