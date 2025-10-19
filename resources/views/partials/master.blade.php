<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Waroenk')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand text-success fw-bold" href="/">
                <img src="{{ asset('images/logo.png') }}" alt="Waroenk" style="height:32px; margin-right:8px;"> Waroenk
            </a>
            <form class="d-flex mx-auto" style="max-width:400px;">
                <input class="form-control me-2" type="search" placeholder="Cari produk disini..." aria-label="Search">
                <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
            </form>
            <div class="d-flex align-items-center">
                <a href="/cart" class="btn position-relative me-2">
                    <i class="bi bi-cart" style="font-size:1.5rem;"></i>
                </a>

                <a href="/login" class="btn btn-success me-2">Masuk</a>
                <a href="/register" class="btn btn-outline-success">Daftar</a>
            </div>
        </div>
    </nav>
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>
    <footer class="bg-light text-center py-3 mt-auto">
        <small>&copy; {{ date('Y') }} Waroenk. All rights reserved.</small>
    </footer>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Waroenk')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    @stack('styles')
</head>
<body>
    @include('partials.navbar')
    <main class="p-4">
        @yield('content')
    </main>
    @include('partials.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
