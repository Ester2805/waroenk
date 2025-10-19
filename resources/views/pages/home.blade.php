@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="bg-white font-sans">

    {{-- Header --}}
    <div class="flex items-center justify-between px-6 py-4 shadow-sm bg-white">
        <div class="flex items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 mr-4">
        </div>
        <form action="/search" method="GET" class="flex items-center w-full max-w-lg">
            <input type="text" name="q" placeholder="Cari produk disini..."
                class="w-full border border-green-500 rounded-l-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400"
                required>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-r-lg hover:bg-green-600">
                Cari
            </button>
        </form>
    </div>

    {{-- Banner --}}
    <div class="bg-green-500 text-white flex flex-col md:flex-row items-center justify-between p-8 m-6 rounded-lg">
        <div>
            <h2 class="text-3xl font-bold">Waroenk UMKM</h2>
            <p class="mt-2 text-lg">Semua Ada di Satu Waroenk</p>
            <span class="mt-4 inline-block bg-white text-green-700 px-4 py-2 rounded-lg font-semibold">
                Ekstra Diskon 15%
            </span>
        </div>
        <img src="{{ asset('images/promo.png') }}" alt="Promo" class="mt-6 md:mt-0 max-h-40 rounded-lg">
    </div>

    @auth
        <div class="mx-6 mb-6">
            <div class="bg-white border rounded-lg shadow-sm p-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between">
                <div>
                    <h5 class="mb-1 fw-semibold text-success">Periksa Status Pesananmu</h5>
                    <p class="mb-0 text-muted">Lihat pesanan yang sedang diproses atau menunggu pembayaran.</p>
                </div>
                <a href="{{ route('orders.index') }}" class="btn btn-success mt-3 mt-md-0">Detail Pesanan</a>
            </div>
        </div>

        @if($recentOrders->isNotEmpty())
            <div class="mx-6 mb-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">Pesanan Terbaru</h5>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th class="text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders as $order)
                                        <tr>
                                            <td class="fw-semibold">ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                                            <td>Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                                            <td>@include('orders.partials.status-badge', ['status' => $order->status])</td>
                                            <td class="text-end"><a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-success">Detail</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endauth

    {{-- Kategori --}}
    <div class="py-10 px-6">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-slate-900">Kategori Teratas</h2>
            <a href="{{ route('products.index') }}" class="bg-white border border-green-500 text-green-600 px-4 py-2 rounded-lg font-semibold hover:bg-green-50">
                Lihat Semua Produk
            </a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6">
            @forelse($categories->take(6) as $category)
                <a href="{{ route('products.index', ['category' => $category->id]) }}" class="bg-gray-50 p-3 rounded-lg border border-gray-200 shadow-sm cursor-pointer hover:shadow-md block text-center">
                    <div class="aspect-square rounded-full overflow-hidden mx-auto bg-white flex items-center justify-center">
                        <span class="text-green-600 font-semibold text-lg">{{ strtoupper(substr($category->name, 0, 1)) }}</span>
                    </div>
                    <div class="mt-3 text-center">
                        <h4 class="text-slate-900 text-sm font-semibold">{{ $category->name }}</h4>
                    </div>
                </a>
            @empty
                <p class="text-slate-600">Kategori belum tersedia. Tambahkan melalui panel admin.</p>
            @endforelse
        </div>
    </div>

    {{-- Rekomendasi Produk --}}
    <div class="px-6 pb-10">
        <h2 class="text-2xl font-bold text-slate-900 mb-6">Rekomendasi Produk</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @forelse($featuredProducts as $product)
                <div class="bg-white border rounded-lg shadow-sm p-4 flex flex-col">
                    <a href="{{ route('products.show', $product) }}">
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded-md">
                        @else
                            <img src="https://via.placeholder.com/200" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded-md">
                        @endif
                    </a>
                    <h4 class="mt-3 font-semibold text-slate-800"><a href="{{ route('products.show', $product) }}" class="text-decoration-none text-slate-800">{{ $product->name }}</a></h4>
                    <p class="text-green-600 font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    @if($product->category)
                        <span class="text-sm text-slate-500">Kategori: {{ $product->category->name }}</span>
                    @endif
                    <div class="flex items-center justify-between text-sm text-slate-500 mt-2">
                        @php $avgRating = round($product->rating_avg ?? 0, 1); @endphp
                        <span class="text-amber-500">
                            @for($star = 1; $star <= 5; $star++)
                                {!! $star <= round($avgRating) ? '&#9733;' : '&#9734;' !!}
                            @endfor
                            ({{ $avgRating ?: '-' }})
                        </span>
                        <span>Terjual {{ number_format($product->sold_total ?? 0) }}</span>
                    </div>
                    @unless(auth()->check() && auth()->user()->isAdmin())
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-auto pt-3 js-add-to-cart-form" data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}">
                            @csrf
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg w-full hover:bg-green-600">
                                Tambah ke Keranjang
                            </button>
                        </form>
                    @else
                        <div class="text-center text-slate-500 text-sm mt-auto pt-3">
                            Fitur pelanggan tidak tersedia untuk admin.
                        </div>
                    @endunless
                </div>
            @empty
                <p class="text-slate-600">Belum ada produk aktif yang dapat ditampilkan.</p>
            @endforelse
        </div>
    </div>

</div>
@endsection
