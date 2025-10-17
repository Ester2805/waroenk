@extends('layouts.app')

@section('title', 'Hasil Pencarian')

@section('content')
<div class="container py-4">
    <h4>Hasil pencarian untuk: <b>{{ $query }}</b></h4>
    <div class="row mt-3">
        @forelse($results as $product)
            <div class="col-md-3 mb-3">
                <div class="card h-100">
                    @if($product->image_url)
                        <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
                    @else
                        <div class="d-flex justify-content-center align-items-center bg-light" style="height: 180px;">
                            <span class="text-muted small">Tidak ada gambar</span>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ Str::limit($product->description, 60) }}</p>
                        <span class="text-success fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Tidak ada hasil ditemukan.</p>
        @endforelse
    </div>
</div>
@endsection
