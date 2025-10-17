@extends('layouts.app')

@section('title', 'Login')

@section('content')
<style>
    .auth-wrapper {
        min-height: calc(100vh - 70px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: clamp(24px, 6vw, 48px);
        background: radial-gradient(circle at top left, rgba(102, 187, 106, 0.12), transparent 55%),
            radial-gradient(circle at bottom right, rgba(46, 125, 50, 0.12), transparent 50%),
            #f4f7fb;
    }

    .auth-card {
        width: min(960px, 100%);
        background: #fff;
        border-radius: 28px;
        box-shadow: 0 24px 70px rgba(15, 23, 42, 0.12);
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        overflow: hidden;
    }

    .auth-illustration {
        background: linear-gradient(135deg, rgba(46, 125, 50, 0.92), rgba(102, 187, 106, 0.85));
        color: #fff;
        padding: clamp(32px, 6vw, 48px);
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 16px;
    }

    .auth-illustration h2 {
        font-size: clamp(26px, 3vw, 32px);
        font-weight: 700;
        margin: 0;
    }

    .auth-illustration p {
        margin: 0;
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.85);
    }

    .auth-form {
        padding: clamp(32px, 6vw, 48px);
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .auth-form h3 {
        font-weight: 700;
        color: #1f2933;
        margin: 0;
    }

    .auth-form .form-control {
        border-radius: 12px;
        padding: 12px;
    }

    .auth-form .btn-primary {
        background: #2e7d32;
        border: none;
        border-radius: 12px;
        padding: 12px;
        font-weight: 600;
    }

    .auth-form .btn-primary:hover {
        background: #256029;
    }

    .auth-extra {
        text-align: center;
        font-size: 0.95rem;
        color: #6b7280;
    }

    .auth-extra a {
        color: #2e7d32;
        font-weight: 600;
    }

    @media (max-width: 767.98px) {
        .auth-illustration {
            text-align: center;
            align-items: center;
        }
    }
</style>

<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-illustration">
            <span class="badge bg-white text-success fw-semibold px-3 py-2" style="width: fit-content;">Selamat Datang</span>
            <h2>Masuk ke Waroenk</h2>
            <p>Nikmati produk UMKM pilihan, pantau pesanan, dan dapatkan promo khusus pelanggan.</p>
        </div>
        <div class="auth-form">
            <div>
                <h3>Login</h3>
                <p class="auth-extra mb-0">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}" class="d-flex flex-column gap-3">
                @csrf

                <div>
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="nama@email.com" required value="{{ old('email') }}">
                </div>

                <div>
                    <label class="form-label fw-semibold">Kata Sandi</label>
                    <input type="password" name="password" class="form-control" placeholder="******" required>
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
                <p class="auth-extra">Masuk sebagai admin? gunakan email `admin@example.com` dan password `111111`.</p>
            </form>
        </div>
    </div>
</div>
@endsection
