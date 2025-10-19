@extends('layouts.app')

@section('title', 'Daftar')

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
        width: min(1020px, 100%);
        background: #fff;
        border-radius: 28px;
        box-shadow: 0 24px 70px rgba(15, 23, 42, 0.12);
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
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

    .auth-illustration h1 {
        font-size: clamp(32px, 4vw, 40px);
        font-weight: 700;
        margin: 0;
    }

    .auth-illustration p {
        margin: 0;
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.88);
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
            <span class="badge bg-white text-success fw-semibold px-3 py-2" style="width: fit-content;">Gabung Sekarang</span>
            <h1>Bangun Etalase UMKM-mu</h1>
            <p>Daftarkan akun untuk mulai belanja atau memasarkan produk lokal terbaikmu di Waroenk.</p>
        </div>
        <div class="auth-form">
            <div>
                <h3>Mulai Sekarang</h3>
                <p class="auth-extra mb-0">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
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

            <form method="POST" action="{{ route('register.post') }}" class="d-flex flex-column gap-3">
                @csrf

                <div>
                    <label class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" placeholder="Nama lengkap" required value="{{ old('name') }}">
                </div>

                <div>
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="nama@email.com" required value="{{ old('email') }}">
                </div>

                <div>
                    <label class="form-label fw-semibold">Kata Sandi</label>
                    <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
                </div>

                <div>
                    <label class="form-label fw-semibold">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi kata sandi" required>
                </div>

                <button type="submit" class="btn btn-primary">Daftar</button>
                <p class="auth-extra">Dengan mendaftar, kamu menyetujui syarat & kebijakan privasi Waroenk.</p>
            </form>
        </div>
    </div>
</div>
@endsection
