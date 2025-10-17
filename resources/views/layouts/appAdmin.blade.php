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
            padding-top: 90px;
            background-color: #f8fafc;
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
        .admin-main {
            padding: 24px 24px 48px;
            min-height: calc(100vh - 90px);
            transition: padding-left .2s ease;
        }
        @media (min-width: 768px) {
            .admin-main {
                padding-left: 18rem;
            }
        }
    </style>
</head>
<body>
    @include('partials.navAdmin')

    <main class="admin-main">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
