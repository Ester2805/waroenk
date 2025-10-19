<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Waroenk Admin')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f4f7fb;
            color: #1f2933;
        }

        a { text-decoration: none; }

        .admin-shell {
            min-height: 100vh;
            display: flex;
            background: #f4f7fb;
        }

        .admin-sidebar {
            width: 260px;
            background: linear-gradient(180deg, #2e7d32 0%, #225e26 100%);
            color: rgba(255,255,255,0.92);
            display: flex;
            flex-direction: column;
            padding: 32px 24px;
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .admin-sidebar .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 36px;
        }

        .admin-sidebar .brand img {
            height: 44px;
        }

        .admin-nav-section {
            margin-top: 32px;
        }

        .admin-nav-title {
            text-transform: uppercase;
            font-size: 0.72rem;
            letter-spacing: 2px;
            margin-bottom: 14px;
            color: rgba(255,255,255,0.55);
        }

        .admin-nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 12px;
            color: rgba(255,255,255,0.85);
            font-weight: 500;
            transition: background .2s ease, color .2s ease;
            margin-bottom: 6px;
        }

        .admin-nav-link i {
            font-size: 1.05rem;
        }

        .admin-nav-link.active,
        .admin-nav-link:hover {
            background: rgba(255, 255, 255, 0.18);
            color: #ffffff;
        }

        .admin-main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .admin-topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #ffffff;
            padding: 18px clamp(20px, 4vw, 40px);
            border-bottom: 1px solid rgba(148, 163, 184, 0.22);
            box-shadow: 0 6px 20px rgba(15, 23, 42, 0.04);
            position: sticky;
            top: 0;
            z-index: 20;
        }

        .admin-topbar .quick-links a {
            font-weight: 500;
            color: #2e7d32;
        }

        .admin-topbar .user-chip {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(46, 125, 50, 0.08);
            color: #2e7d32;
            padding: 8px 16px;
            border-radius: 999px;
            font-weight: 600;
            cursor: pointer;
            border: none;
        }

        .admin-profile-menu {
            position: relative;
        }

        .admin-profile-dropdown {
            position: absolute;
            right: 0;
            top: calc(100% + 10px);
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 18px 48px rgba(15, 23, 42, 0.15);
            min-width: 220px;
            padding: 12px;
            display: none;
        }

        .admin-profile-dropdown a,
        .admin-profile-dropdown form button {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 12px;
            border: none;
            background: transparent;
            color: #1f2933;
            font-weight: 500;
            text-align: left;
        }

        .admin-profile-dropdown a:hover,
        .admin-profile-dropdown form button:hover {
            background: rgba(46, 125, 50, 0.08);
        }

        .admin-main {
            flex: 1;
            padding: clamp(32px, 6vw, 56px) clamp(20px, 6vw, 60px);
        }

        .btn-accent {
            background: #2e7d32;
            color: #fff;
            border-radius: 999px;
            padding: 10px 24px;
            font-weight: 600;
        }

        .btn-outline-accent {
            border: 2px solid #2e7d32;
            color: #2e7d32;
            border-radius: 999px;
            font-weight: 600;
            padding: 10px 24px;
        }

        .admin-page {
            background: rgba(255,255,255,0.9);
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(15, 23, 42, 0.08);
            padding: clamp(32px, 5vw, 48px);
        }

        .admin-hero {
            display: flex;
            flex-direction: column;
            gap: 18px;
            margin-bottom: clamp(28px, 5vw, 40px);
        }

        .admin-hero .badge {
            width: fit-content;
            background: rgba(46, 125, 50, 0.12);
            color: #2e7d32;
            padding: 7px 16px;
            border-radius: 999px;
            font-weight: 600;
            letter-spacing: 0.4px;
        }

        .admin-hero h1 {
            font-weight: 700;
            color: #1f2933;
            margin-bottom: 12px;
        }

        .admin-hero p {
            color: #6b7280;
            margin: 0;
            max-width: 680px;
        }

        .admin-hero .actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .admin-card,
        .admin-table-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 18px 48px rgba(15, 23, 42, 0.08);
        }

        .admin-table-card .table thead {
            background: rgba(46, 125, 50, 0.05);
        }

        .admin-empty {
            text-align: center;
            padding: clamp(48px, 6vw, 72px);
        }

        .admin-empty-icon {
            width: 84px;
            height: 84px;
            border-radius: 24px;
            background: rgba(46, 125, 50, 0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #2e7d32;
            margin: 0 auto 16px;
        }

        @media (max-width: 991.98px) {
            .admin-shell { flex-direction: column; }
            .admin-sidebar {
                width: 100%;
                height: auto;
                position: relative;
                border-radius: 0 0 24px 24px;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="admin-shell">
        <aside class="admin-sidebar">
            <a href="{{ route('landing') }}" class="brand">
                <img src="{{ asset('images/logo-putih.png') }}" alt="Waroenk">
            </a>

            <nav>
                <div class="admin-nav-section">
                    <div class="admin-nav-title">Dashboard</div>
                    <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i> Ikhtisar
                    </a>
                    <a href="{{ route('admin.analytics.index') }}" class="admin-nav-link {{ request()->routeIs('admin.analytics.*') ? 'active' : '' }}">
                        <i class="bi bi-bar-chart-line"></i> Analytics
                    </a>
                    <a href="{{ route('admin.sales.index') }}" class="admin-nav-link {{ request()->routeIs('admin.sales.*') ? 'active' : '' }}">
                        <i class="bi bi-basket"></i> Penjualan
                    </a>
                    <a href="{{ route('admin.reports.index') }}" class="admin-nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-text"></i> Laporan
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="admin-nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i> Pengguna
                    </a>
                </div>

                <div class="admin-nav-section">
                    <div class="admin-nav-title">Manajemen</div>
                    <a href="{{ route('admin.products.index') }}" class="admin-nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <i class="bi bi-box"></i> Produk
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="admin-nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="bi bi-tags"></i> Kategori
                    </a>
                    <a href="{{ route('admin.shipping-options.index') }}" class="admin-nav-link {{ request()->routeIs('admin.shipping-options.*') ? 'active' : '' }}">
                        <i class="bi bi-truck"></i> Opsi Pengiriman
                    </a>
                </div>
            </nav>
        </aside>

        <div class="admin-main-wrapper">
            <header class="admin-topbar">
                <div class="quick-links">
                    <a href="{{ route('landing') }}" class="text-decoration-none me-3">Lihat Etalase</a>
                </div>
                <div class="admin-profile-menu">
                    <button class="user-chip" type="button" id="adminProfileButton">
                        <i class="bi bi-person-circle"></i>
                        <span>{{ Auth::user()->name ?? 'Admin' }}</span>
                        <i class="bi bi-chevron-down ms-1"></i>
                    </button>
                    <div class="admin-profile-dropdown" id="adminProfileDropdown">
                        <a href="{{ route('profile.show') }}">
                            <i class="bi bi-person"></i> Profil Saya
                        </a>
                        <a href="{{ route('admin.analytics.index') }}">
                            <i class="bi bi-bar-chart"></i> Analytics
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"><i class="bi bi-box-arrow-right"></i> Keluar</button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="admin-main">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/admin-sales.js') }}" defer></script>
    <script>
        document.addEventListener('click', function (event) {
            const button = document.getElementById('adminProfileButton');
            const dropdown = document.getElementById('adminProfileDropdown');
            if (!button || !dropdown) return;

            if (button.contains(event.target)) {
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
            } else if (!dropdown.contains(event.target)) {
                dropdown.style.display = 'none';
            }
        });
    </script>
</body>
</html>
