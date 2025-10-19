<div class="row g-4">
    @forelse($products as $product)
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="product-grid-card">
                <a href="{{ route('products.show', $product) }}" class="text-decoration-none text-dark">
                    <div class="product-grid-img-wrap">
                        @php $avgRating = round($product->rating_avg ?? 0, 1); @endphp
                        <span class="product-grid-rating">
                            <i class="bi bi-star-fill text-warning"></i>
                            {{ $avgRating ?: '-' }}
                        </span>
                        @if(!empty($product->image_url))
                            <img src="{{ $product->image_url }}" class="product-grid-img" alt="{{ $product->name }}">
                        @else
                            <img src="https://via.placeholder.com/400x220?text=No+Image" class="product-grid-img" alt="No Image">
                        @endif
                    </div>
                </a>
                <div class="product-grid-body">
                    <div>
                        <span class="product-grid-price">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                        <h5 class="fw-semibold mt-2 mb-1">
                            <a href="{{ route('products.show', $product) }}" class="text-decoration-none text-dark">
                                {{ $product->name }}
                            </a>
                        </h5>
                        @if($product->category)
                            <small class="text-muted">Kategori: {{ $product->category->name }}</small>
                        @endif
                    </div>
                    <div class="product-grid-meta">
                        <span><i class="bi bi-people"></i> Terjual {{ number_format($product->sold_total ?? 0) }}</span>
                        <span><i class="bi bi-box-seam"></i> Stok {{ $product->stock }}</span>
                    </div>
                </div>
                <div class="px-4 pb-4">
                    @unless(auth()->check() && auth()->user()->isAdmin())
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="js-add-to-cart-form" data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}">
                            @csrf
                            <button type="submit" class="btn btn-success btn-cart w-100">
                                <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                            </button>
                        </form>
                    @else
                        <div class="btn btn-outline-secondary disabled w-100">
                            <i class="bi bi-shield-lock"></i> Fitur pelanggan
                        </div>
                    @endunless
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-box-seam"></i>
                </div>
                <h4 class="fw-semibold mb-1">Belum ada produk</h4>
                <p class="text-muted mb-3">Coba ubah filter pencarian atau kunjungi kembali nanti untuk melihat produk terbaru.</p>
                <a href="{{ route('products.index') }}" class="btn btn-success px-4">Reset Filter</a>
            </div>
        </div>
    @endforelse
</div>
