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
            <h2>Welcome to</h2>
            <h1>Waroenk!</h1>
        </div>

        {{-- Kanan --}}
        <div class="register-right">
            <h3>Get Started</h3>
            <p class="mb-3">Already have an account? <a href="#">Sign in</a></p>

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
                    <input type="text" name="name" class="form-control" placeholder="Name" required value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="mb-3">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                </div>

                <button type="submit" class="btn-waroenk">Sign up</button>
            </form>

            <button class="btn btn-light border google-btn">
                <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google" width="20" class="me-2">
                Sign up with Google
            </button>
        </div>
    </div>
</div>
@endsection
