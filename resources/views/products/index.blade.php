{{-- resources/views/products/index.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Hasil Pencarian Produk</h1>

        @if(isset($query))
            <p>Keyword: <strong>{{ $query }}</strong></p>
        @endif

        <ul>
            @forelse ($products as $product)
                <li>
                    <strong>{{ $product->name }}</strong> <br>
                    {{ $product->description }} <br>
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </li>
            @empty
                <li>Tidak ada produk ditemukan.</li>
            @endforelse
        </ul>
    </div>
@endsection
