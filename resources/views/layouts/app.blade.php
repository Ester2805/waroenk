<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Waroenk')</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        .navbar-waroenk {
            background-color: #f9fafb;
            padding: 1rem 2rem;
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
    <nav class="navbar-waroenk d-flex justify-content-between align-items-center">
        <a href="{{ url('/') }}" class="brand">
            <img src="{{ asset('images/logo.png') }}" alt="Waroenk Logo">
        </a>

        <div class="d-flex">
            {{-- Kalau user belum login, tampilkan Login & Sign Up --}}
            @guest
                <a href="{{ route('login') }}" class="btn-login">Login</a>
                <a href="{{ route('register') }}" class="btn-signup">Sign Up</a>
            @endguest

            {{-- Kalau user sudah login, tampilkan nama + tombol logout --}}
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
