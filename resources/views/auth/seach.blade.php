@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Hasil pencarian untuk: <strong>{{ $keyword }}</strong></h2>

    @if($products->count() > 0)
        <div class="row mt-4">
            @foreach($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-success btn-sm">Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>Tidak ada produk ditemukan untuk "<strong>{{ $keyword }}</strong>"</p>
    @endif
</div>
@endsection
