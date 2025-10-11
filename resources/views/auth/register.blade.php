@extends('layouts.app')

@section('title', 'Register')

@section('content')
<style>
    .register-container {
        display: flex;
        min-height: 100vh;
        align-items: center;
        justify-content: center;
        background: #f9fafb;
    }
    .register-box {
        display: flex;
        width: 900px;
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
    }
    .register-left {
        flex: 1;
        background: linear-gradient(135deg, #ffb74d, #81c784);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: #fff;
        padding: 40px;
        font-weight: 600;
    }
    .register-left h2 {
        font-size: 28px;
        margin-bottom: 8px;
    }
    .register-right {
        flex: 1;
        padding: 40px;
    }
    .register-right h3 {
        font-weight: 700;
        margin-bottom: 20px;
    }
    .form-control {
        border-radius: 8px;
    }
    .btn-waroenk {
        background-color: #2e7d32;
        color: #fff;
        border-radius: 8px;
        padding: 10px 24px;
        font-weight: 600;
        width: 100%;
        border: none;
    }
    .btn-waroenk:hover {
        background-color: #256029;
        color: #fff;
    }
    .google-btn {
        margin-top: 12px;
        width: 100%;
        border-radius: 8px;
    }
</style>

<div class="register-container">
    <div class="register-box">
        {{-- Kiri --}}
        <div class="register-left">
            <h2>Selamat Datang di</h2>
            <h1>Waroenk!</h1>
        </div>

        {{-- Kanan --}}
        <div class="register-right">
            <h3>Mulai Sekarang</h3>
            <p class="mb-3">Sudah punya akun? <a href="#">Masuk</a></p>

            {{-- Error Validation --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.post') }}">
                @csrf

                <div class="mb-3">
                    <input type="text" name="nama" class="form-control" placeholder="nama" required value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <input type="password" name="kata sandi" class="form-control" placeholder="kata sandi" required>
                </div>

                <div class="mb-3">
                    <input type="password" name="konfirmasi_kata sandi" class="form-control" placeholder="konfirmasi kata sandi" required>
                </div>

                <button type="submit" class="btn-waroenk">Daftar</button>
            </form>

        </div>
    </div>
</div>
@endsection
