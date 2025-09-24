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

    {{-- Kategori --}}
    <div class="py-10 px-6">
        <h2 class="text-2xl font-bold text-slate-900 mb-8">Top Categories</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6">

            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 shadow-sm cursor-pointer hover:shadow-md">
                <div class="aspect-square rounded-full overflow-hidden mx-auto">
                    <img src="https://readymadeui.com/images/fashion-img-1.webp" alt="fashion1"
                        class="h-full w-full object-cover" />
                </div>
                <div class="mt-3 text-center">
                    <h4 class="text-slate-900 text-sm font-semibold">Up To 40% OFF</h4>
                </div>
            </div>

            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 shadow-sm cursor-pointer hover:shadow-md">
                <div class="aspect-square rounded-full overflow-hidden mx-auto">
                    <img src="https://readymadeui.com/images/fashion-img-2.webp" alt="fashion2"
                        class="h-full w-full object-cover" />
                </div>
                <div class="mt-3 text-center">
                    <h4 class="text-slate-900 text-sm font-semibold">Fresh Looks</h4>
                </div>
            </div>

            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 shadow-sm cursor-pointer hover:shadow-md">
                <div class="aspect-square rounded-full overflow-hidden mx-auto">
                    <img src="https://readymadeui.com/images/fashion-img-7.webp" alt="fashion3"
                        class="h-full w-full object-cover" />
                </div>
                <div class="mt-3 text-center">
                    <h4 class="text-slate-900 text-sm font-semibold">Up To 30% OFF</h4>
                </div>
            </div>

            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 shadow-sm cursor-pointer hover:shadow-md">
                <div class="aspect-square rounded-full overflow-hidden mx-auto">
                    <img src="https://readymadeui.com/images/fashion-img-4.webp" alt="fashion4"
                        class="h-full w-full object-cover" />
                </div>
                <div class="mt-3 text-center">
                    <h4 class="text-slate-900 text-sm font-semibold">Exclusive Fashion</h4>
                </div>
            </div>

            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 shadow-sm cursor-pointer hover:shadow-md">
                <div class="aspect-square rounded-full overflow-hidden mx-auto">
                    <img src="https://readymadeui.com/images/fashion-img-5.webp" alt="fashion5"
                        class="h-full w-full object-cover" />
                </div>
                <div class="mt-3 text-center">
                    <h4 class="text-slate-900 text-sm font-semibold">Top Picks for Less</h4>
                </div>
            </div>

            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 shadow-sm cursor-pointer hover:shadow-md">
                <div class="aspect-square rounded-full overflow-hidden mx-auto">
                    <img src="https://readymadeui.com/images/fashion-img-6.webp" alt="fashion6"
                        class="h-full w-full object-cover" />
                </div>
                <div class="mt-3 text-center">
                    <h4 class="text-slate-900 text-sm font-semibold">Shop & Save 40%</h4>
                </div>
            </div>

        </div>
    </div>

    {{-- Rekomendasi Produk --}}
    <div class="px-6 pb-10">
        <h2 class="text-2xl font-bold text-slate-900 mb-6">Rekomendasi Produk</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            {{-- Placeholder contoh produk --}}
            <div class="bg-white border rounded-lg shadow-sm p-4">
                <img src="https://via.placeholder.com/200" alt="Produk" class="w-full h-40 object-cover rounded-md">
                <h4 class="mt-2 font-semibold text-slate-800">Produk A</h4>
                <p class="text-green-600 font-bold">Rp 50.000</p>
            </div>
            <div class="bg-white border rounded-lg shadow-sm p-4">
                <img src="https://via.placeholder.com/200" alt="Produk" class="w-full h-40 object-cover rounded-md">
                <h4 class="mt-2 font-semibold text-slate-800">Produk B</h4>
                <p class="text-green-600 font-bold">Rp 75.000</p>
            </div>
            <div class="bg-white border rounded-lg shadow-sm p-4">
                <img src="https://via.placeholder.com/200" alt="Produk" class="w-full h-40 object-cover rounded-md">
                <h4 class="mt-2 font-semibold text-slate-800">Produk C</h4>
                <p class="text-green-600 font-bold">Rp 100.000</p>
            </div>
        </div>
    </div>

</div>
@endsection
