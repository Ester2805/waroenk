@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold text-waroenk-green mb-4">
        Halo, {{ Auth::user()->name }} 👋
    </h1>
    <p class="mb-4">Selamat datang kembali di Waroenk! Yuk cek produk terbaru hari ini 🚀</p>

    {{-- Contoh daftar produk --}}
    <div class="row g-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <img src="{{ asset('images/dress.jpg') }}" class="card-img-top p-3" alt="Dress">
                <div class="card-body">
                    <h6 class="fw-semibold">Dress</h6>
                    <p class="text-muted">Rp 150.000</p>
                    <button class="btn btn-sm btn-waroenk">Tambah ke Keranjang</button>
                </div>
            </div>
        </div>
        {{-- Tambahkan produk lainnya --}}
    </div>
</div>
@endsection
