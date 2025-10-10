@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3>Hasil Pencarian: "{{ $query }}"</h3>

     @foreach($products as $product)
          <p>{{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}</p>
@empty
    <p>Tidak ada produk ditemukan.</p>
@endforeach



    <div class="row mt-4">
        @forelse($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h6>{{ $product->name }}</h6>
                        <p>Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p>Tidak ada produk ditemukan.</p>
        @endforelse
    </div>
</div>
@endsection
