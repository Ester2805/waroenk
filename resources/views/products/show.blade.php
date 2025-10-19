@extends('layouts.app')

@section('title', $product->name)

@section('content')
<section class="py-5" style="background:#f4f6f8; min-height:80vh;">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="bg-white shadow-sm rounded-4 p-4 text-center">
                    @if($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid rounded-3" style="max-height:360px; object-fit:cover;">
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light rounded-3" style="height:360px;">
                            <span class="text-muted">Tidak ada gambar</span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="bg-white shadow-sm rounded-4 p-4 h-100 d-flex flex-column">
                    <span class="badge bg-success-subtle text-success-emphasis mb-3">{{ $product->category->name ?? 'Tanpa Kategori' }}</span>
                    <h1 class="h3 fw-bold">{{ $product->name }}</h1>
                    <p class="text-success fw-semibold fs-4 mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <div class="d-flex align-items-center flex-wrap gap-3 text-muted mb-3">
                        @php
                            $avgRating = round($product->rating_avg ?? 0, 1);
                            $reviewCount = $reviews->count();
                            $featuredReview = $reviews->firstWhere(fn($r) => ! empty($r->review));
                        @endphp
                        <span class="text-warning">
                            @for($star = 1; $star <= 5; $star++)
                                {!! $star <= round($avgRating) ? '&#9733;' : '&#9734;' !!}
                            @endfor
                        </span>
                        <span>{{ $avgRating ?: '-' }} / 5</span>
                        @if($reviewCount)
                            <span>&bull;</span>
                            <span>{{ $reviewCount }} ulasan</span>
                            <span>&bull;</span>
                        @else
                            <span>&bull;</span>
                        @endif
                        <span>Terjual {{ number_format($product->sold_total ?? 0) }}</span>
                    </div>

                    <div class="mb-3">
                        @if($featuredReview)
                            <div class="bg-light rounded-3 p-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <strong>{{ optional($featuredReview->order)->customer_name ?? 'Pelanggan Waroenk' }}</strong>
                                    <small class="text-muted">{{ optional($featuredReview->rated_at ?? $featuredReview->updated_at ?? $featuredReview->created_at)->format('d M Y') }}</small>
                                </div>
                                <p class="text-muted mb-0">"{{ $featuredReview->review }}"</p>
                            </div>
                        @else
                            <span class="text-muted small">Belum ada ulasan tertulis untuk produk ini.</span>
                        @endif
                    </div>
                    <p class="text-muted">{{ $product->description ?: 'Belum ada deskripsi untuk produk ini.' }}</p>

                    @if($product->shippingOptions->isNotEmpty())
                        <div class="mt-3">
                            <h6 class="fw-semibold">Opsi Pengiriman</h6>
                            <ul class="list-unstyled mb-3">
                                @foreach($product->shippingOptions as $option)
                                    <li class="d-flex justify-content-between align-items-center border rounded-3 px-3 py-2 mb-2">
                                        <span>{{ $option->name }} <small class="text-muted">{{ $option->estimated_time }}</small></span>
                                        <span class="text-muted">Rp{{ number_format($option->additional_cost, 0, ',', '.') }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="d-flex flex-column gap-2 mt-auto">
                        <div class="text-muted small">Stok tersedia: <strong>{{ number_format($product->stock) }}</strong></div>
                    @unless(auth()->check() && auth()->user()->isAdmin())
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-auto js-add-to-cart-form" data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}">
                            @csrf
                            <button class="btn btn-success btn-lg w-100" type="submit">Tambah ke Keranjang</button>
                        </form>
                    @else
                        <div class="alert alert-warning mt-auto mb-0">
                            Admin tidak dapat melakukan pemesanan.
                        </div>
                    @endunless
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <h3 class="fw-semibold mb-3">Ulasan Pelanggan</h3>
            @forelse($reviews as $review)
                <div class="bg-white shadow-sm rounded-4 p-4 mb-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="fw-semibold mb-1">{{ optional($review->order)->customer_name ?: 'Pelanggan Waroenk' }}</h6>
                            @if($review->rating)
                                <div class="text-warning mb-2">
                                    @for ($star = 1; $star <= 5; $star++)
                                        {!! $star <= $review->rating ? '&#9733;' : '&#9734;' !!}
                                    @endfor
                                    <small class="text-muted ms-2">{{ $review->rating }}/5</small>
                                </div>
                            @endif
                            @if($review->review)
                                <p class="text-muted mb-0">{{ $review->review }}</p>
                            @else
                                <p class="text-muted fst-italic mb-0">Pelanggan ini hanya memberikan rating.</p>
                            @endif
                        </div>
                        @php
                            $rawTimestamp = $review->rated_at ?? $review->updated_at ?? $review->created_at;
                            $reviewedAt = $rawTimestamp instanceof \Illuminate\Support\Carbon
                                ? $rawTimestamp
                                : ($rawTimestamp ? \Illuminate\Support\Carbon::parse($rawTimestamp) : null);
                        @endphp
                        @if($reviewedAt)
                            <small class="text-muted">{{ $reviewedAt->format('d M Y') }}</small>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white shadow-sm rounded-4 p-4 text-muted">
                    Belum ada ulasan untuk produk ini. Jadilah yang pertama memberikan ulasan setelah pesananmu selesai.
                </div>
            @endforelse
        </div>

        @if($relatedProducts->isNotEmpty())
            <div class="mt-5">
                <h3 class="fw-semibold mb-3">Produk Terkait</h3>
                <div class="row g-4">
                    @foreach($relatedProducts as $related)
                        <div class="col-6 col-md-3">
                            <div class="bg-white border rounded-4 shadow-sm h-100 p-3 d-flex flex-column">
                                <a href="{{ route('products.show', $related) }}" class="text-decoration-none text-dark">
                                    @if($related->image_url)
                                        <img src="{{ $related->image_url }}" alt="{{ $related->name }}" class="img-fluid rounded-3 mb-3" style="height:160px; object-fit:cover;">
                                    @endif
                                    <h6 class="fw-semibold">{{ $related->name }}</h6>
                                </a>
                                <p class="text-success fw-semibold mb-0">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
