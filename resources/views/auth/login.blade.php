@extends('layouts.app')

@section('title', 'Login')

@section('content')
<style>
    .login-container {
        display: flex;
        min-height: 100vh;
        align-items: center;
        justify-content: center;
        background: #f9fafb;
    }
    .login-box {
        display: flex;
        width: 800px;
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
    }
    .login-left {
        flex: 1;
        background: linear-gradient(135deg, #64b5f6, #81c784);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: #fff;
        padding: 40px;
        font-weight: 600;
    }
    .login-left h2 {
        font-size: 28px;
        margin-bottom: 8px;
    }
    .login-right {
        flex: 1;
        padding: 40px;
    }
    .login-right h3 {
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
</style>

<div class="login-container">
    <div class="login-box">
        {{-- Kiri --}}
        <div class="login-left">
            <h2>Selamat Datang!</h2>
            <p>Login untuk lanjut berbelanja di Waroenk</p>
        </div>

        {{-- Kanan --}}
        <div class="login-right">
            <h3>Login</h3>
            <p class="mb-3">Tidak punya akun? <a href="{{ route('register') }}">Daftar</a></p>

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

            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Kata Sandi" required>
                </div>

                <button type="submit" class="btn-waroenk">Login</button>
            </form>
        </div>
    </div>
</div>
@endsection
