@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<style>
    :root {
        --cart-primary: #2e7d32;
        --cart-primary-soft: #66bb6a;
        --cart-border: rgba(148, 163, 184, 0.35);
        --cart-muted: #6b7280;
        --cart-surface: #ffffff;
        --cart-background: #f4f6fb;
    }

    .cart-page {
        min-height: calc(100vh - 120px);
        background: var(--cart-background);
        padding: 32px clamp(16px, 4vw, 48px) 72px;
    }

    .cart-header-card {
        background: linear-gradient(135deg, rgba(46, 125, 50, 0.12), rgba(102, 187, 106, 0.18));
        border-radius: 22px;
        border: 1px solid var(--cart-border);
        padding: clamp(24px, 5vw, 38px);
        box-shadow: 0 14px 36px rgba(15, 23, 42, 0.08);
    }

    .cart-header-card h1 {
        margin: 0 0 12px;
        font-size: clamp(1.8rem, 3vw, 2.4rem);
        color: #232323;
    }

    .cart-header-card p {
        margin: 0;
        color: var(--cart-muted);
        max-width: 720px;
    }

    #checkout-container {
        margin-top: clamp(24px, 4vw, 40px);
        display: grid;
        grid-template-columns: minmax(0, 1fr) 320px;
        gap: clamp(18px, 4vw, 32px);
        align-items: start;
    }

    .cart-table {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .table-head {
        background: linear-gradient(135deg, rgba(46, 125, 50, 0.1), rgba(255, 255, 255, 0.9));
        border-radius: 18px;
        padding: 18px 28px;
        display: grid;
        grid-template-columns: 48px 3fr 1fr 1fr 1fr 120px;
        font-weight: 600;
        color: var(--cart-muted);
        border: 1px solid var(--cart-border);
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.06);
    }

    .store-card {
        background: var(--cart-surface);
        border-radius: 18px;
        border: 1px solid var(--cart-border);
        overflow: hidden;
        box-shadow: 0 16px 40px rgba(15, 23, 42, 0.08);
    }

    .store-card-header {
        background: #f0fbf3;
        border-bottom: 1px solid var(--cart-border);
        padding: 16px 24px;
        display: flex;
        align-items: center;
        gap: 16px;
        font-weight: 600;
        color: var(--cart-primary);
    }

    .store-badge {
        font-size: 0.75rem;
        background: rgba(46, 125, 50, 0.12);
        color: var(--cart-primary);
        padding: 4px 8px;
        border-radius: 999px;
        font-weight: 600;
    }

    .store-link {
        margin-left: auto;
        font-size: 0.85rem;
        color: var(--cart-primary);
        text-decoration: none;
        font-weight: 600;
    }

    .cart-item {
        display: grid;
        grid-template-columns: 48px 3fr 1fr 1fr 1fr 100px;
        padding: 22px 24px;
        gap: 18px;
        align-items: center;
        border-bottom: 1px solid var(--cart-border);
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .cart-item-info {
        display: flex;
        gap: 18px;
        align-items: flex-start;
    }

    .cart-item-image {
        width: 84px;
        height: 84px;
        border-radius: 14px;
        overflow: hidden;
        background: #f6f7f9;
        flex-shrink: 0;
    }

    .cart-item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .cart-item-name {
        font-weight: 600;
        margin-bottom: 6px;
        font-size: 1rem;
    }

    .cart-item-variant,
    .product-meta {
        font-size: 0.82rem;
        color: var(--cart-muted);
        margin: 0;
    }

    .cart-item-price,
    .cart-item-subtotal {
        font-weight: 700;
        color: var(--cart-primary);
    }

    .quantity-form {
        display: inline-flex;
        border: 1px solid var(--cart-border);
        border-radius: 12px;
        overflow: hidden;
    }

    .quantity-form input {
        width: 64px;
        text-align: center;
        border: none;
        padding: 8px;
        font-weight: 600;
        background: #fff;
    }

    .quantity-form button {
        border: none;
        background: var(--cart-primary);
        color: #fff;
        padding: 0 16px;
        cursor: pointer;
        font-weight: 600;
    }

    .remove-form button {
        background: none;
        border: none;
        color: var(--cart-primary);
        cursor: pointer;
        font-weight: 600;
    }

    .cart-item-extra {
        padding: 16px 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 0.85rem;
        color: var(--cart-muted);
        background: #f7fdf9;
    }

    .cart-item-extra a {
        color: var(--cart-primary);
        font-weight: 600;
        text-decoration: none;
    }

    .cart-bulk-bar {
        background: linear-gradient(135deg, rgba(46, 125, 50, 0.08), rgba(255, 255, 255, 0.95));
        border: 1px solid var(--cart-border);
        border-radius: 18px;
        padding: 18px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 14px 32px rgba(15, 23, 42, 0.08);
    }

    .cart-bulk-bar label {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
        color: #333;
    }

    .cart-bulk-actions {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .cart-bulk-actions a {
        color: var(--cart-primary);
        font-weight: 600;
        text-decoration: none;
    }

    .summary-card {
        position: sticky;
        top: 110px;
        background: linear-gradient(135deg, rgba(46, 125, 50, 0.08), rgba(255, 255, 255, 0.95));
        border: 1px solid var(--cart-border);
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 18px 48px rgba(15, 23, 42, 0.12);
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .summary-card h4 {
        margin: 0;
        font-size: 1.05rem;
    }

    .summary-card p {
        margin: 4px 0 0;
        color: var(--cart-muted);
        font-size: 0.85rem;
    }

    .summary-link {
        font-weight: 600;
        color: var(--cart-primary);
        text-decoration: none;
        font-size: 0.85rem;
    }

    .summary-divider {
        height: 1px;
        background: var(--cart-border);
    }

    .summary-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-weight: 600;
        font-size: 1rem;
    }

    .summary-row span:last-child {
        color: var(--cart-primary);
        font-size: 1.3rem;
    }

    .btn-checkout {
        background: var(--cart-primary);
        color: #fff;
        border: none;
        border-radius: 999px;
        padding: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: box-shadow .2s ease, transform .2s ease;
    }

    .btn-checkout:hover:not(:disabled) {
        box-shadow: 0 16px 30px rgba(38, 165, 65, 0.3);
        transform: translateY(-1px);
    }

    .btn-checkout:disabled {
        background: rgba(46, 125, 50, 0.4);
        cursor: not-allowed;
    }

    .alert {
        background: rgba(46, 125, 50, 0.12);
        color: var(--cart-primary);
        padding: 16px 20px;
        border-radius: 16px;
        margin: 24px 0;
        border-left: 4px solid var(--cart-primary);
    }

    .empty-state-card {
        margin-top: 32px;
        background: var(--cart-surface);
        border-radius: 22px;
        border: 1px solid var(--cart-border);
        padding: 36px clamp(20px, 4vw, 48px);
        box-shadow: 0 18px 44px rgba(15, 23, 42, 0.08);
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 24px;
        align-items: center;
    }

    .empty-state-icon {
        width: 88px;
        height: 88px;
        border-radius: 24px;
        background: linear-gradient(135deg, rgba(46, 125, 50, 0.16), rgba(102, 187, 106, 0.24));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: var(--cart-primary);
    }

    .empty-state-text h2 {
        margin: 0 0 6px;
    }

    .empty-state-text p {
        margin: 0;
        color: var(--cart-muted);
    }

    .empty-state-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        grid-column: 1 / -1;
    }

    .button-primary,
    .button-outline {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 24px;
        border-radius: 999px;
        font-weight: 600;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }

    .button-primary {
        background: var(--cart-primary);
        color: #fff;
    }

    .button-outline {
        background: #fff;
        border: 1px solid var(--cart-primary);
        color: var(--cart-primary);
    }

    @media (max-width: 992px) {
        #checkout-container {
            grid-template-columns: 1fr;
        }
        .summary-card {
            position: static;
        }
        .table-head {
            display: none;
        }
        .cart-item {
            grid-template-columns: 1fr;
            gap: 12px;
        }
        .cart-item-extra {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    @media (max-width: 576px) {
        .cart-page {
            padding: 24px 16px 56px;
        }
        .cart-header-card {
            border-radius: 18px;
        }
        .empty-state-card {
            grid-template-columns: 1fr;
            text-align: center;
        }
        .empty-state-actions {
            justify-content: center;
        }
    }
</style>

<div class="cart-page">
    <section class="cart-header-card">
        <h1>Keranjang Belanja</h1>
        <p>Periksa kembali produk yang kamu pilih sebelum melanjutkan ke pembayaran dan nikmati promo menarik dari Waroenk.</p>
    </section>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert" style="border-left-color:#dc3545; background:rgba(220,53,69,0.12); color:#b71c1c;">{{ session('error') }}</div>
    @endif

    @if(count($items) > 0)
        <div id="checkout-container" data-action="{{ route('cart.checkout.show') }}">
            <div class="cart-table">
                <div class="table-head">
                    <span><input type="checkbox" id="select-all"></span>
                    <span>Produk</span>
                    <span>Harga Satuan</span>
                    <span>Jumlah</span>
                    <span>Total Harga</span>
                    <span class="text-end">Aksi</span>
                </div>

                @foreach($items as $index => $item)
                    @php
                        $id = $index;
                        $subtotal = $item['price'] * $item['quantity'];
                    @endphp
                    <div class="store-card" data-item-id="{{ $id }}" data-price="{{ $item['price'] }}">
                        <div class="store-card-header">
                            <span>Waroenk UMKM</span>
                            <span class="store-badge">Toko Lokal</span>
                            <a href="{{ route('landing') }}" class="store-link">Kunjungi Toko</a>
                        </div>
                        <div class="store-card-body">
                            <div class="cart-item">
                                <input type="checkbox" class="item-checkbox" value="{{ $id }}">
                                <div class="cart-item-info">
                                    <div class="cart-item-image">
                                        @if(!empty($item['image']))
                                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                                        @else
                                            <span style="display:flex;align-items:center;justify-content:center;height:100%;font-size:12px;color:var(--cart-muted);">IMG</span>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="cart-item-name">{{ $item['name'] }}</div>
                                        <p class="cart-item-variant">Variasi: -</p>
                                        <p class="product-meta">Stok: {{ $item['stock'] ?? 'Tersedia' }}</p>
                                    </div>
                                </div>
                                <div class="cart-item-price">
                                    Rp{{ number_format($item['price'], 0, ',', '.') }}
                                </div>
                                <div>
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="quantity-form js-cart-update-form" data-item-id="{{ $id }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1">
                                        <button type="submit">Ubah</button>
                                    </form>
                                </div>
                                <div class="cart-item-subtotal">
                                    Rp{{ number_format($subtotal, 0, ',', '.') }}
                                </div>
                                <div class="remove-form">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST" class="js-cart-remove-form" data-item-id="{{ $id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Hapus</button>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                @endforeach

                <div class="cart-bulk-bar">
                    <label>
                        <input type="checkbox" id="select-all-bottom"> Pilih Semua ({{ count($items) }})
                    </label>
                    <div class="cart-bulk-actions">
                        <a href="{{ route('landing') }}">Cari Produk Lain</a>
                    </div>
                </div>
            </div>

            <aside class="summary-card">
                <div class="summary-row">
                    <span>Total ({{ count($items) }} produk)</span>
                    <span id="selected-total">Rp0</span>
                </div>
                <button type="button" class="btn-checkout" id="checkout-button" disabled>Checkout</button>
            </aside>
        </div>
    @else
        <div class="empty-state-card">
            <div class="empty-state-icon">🛒</div>
            <div class="empty-state-text">
                <h2>Keranjang kamu masih kosong</h2>
                <p>Mulai jelajahi produk UMKM favorit dan tambahkan ke keranjangmu.</p>
            </div>
            <div class="empty-state-actions">
                @auth
                    <a href="{{ route('products.index') }}" class="button-primary">Belanja Sekarang</a>
                @else
                    <a href="{{ route('login') }}" class="button-primary">Masuk untuk Belanja</a>
                @endauth
                <a href="{{ route('landing') }}" class="button-outline">Kembali ke Beranda</a>
            </div>
        </div>
    @endif
</div>

<script>
    const checkoutContainer = document.getElementById('checkout-container');

    if (checkoutContainer) {
        const getItemCheckboxes = () => Array.from(document.querySelectorAll('.item-checkbox'));
        const selectAll = document.getElementById('select-all');
        const selectAllBottom = document.getElementById('select-all-bottom');
        const totalLabel = document.getElementById('selected-total');
        const checkoutButton = document.getElementById('checkout-button');

        const formatRupiah = (value) => 'Rp' + new Intl.NumberFormat('id-ID').format(Math.max(0, value));

        function updateSummary() {
            let total = 0;
            let selected = 0;
            getItemCheckboxes().forEach(cb => {
                if (cb.checked) {
                    const card = cb.closest('.store-card');
                    if (!card) {
                        return;
                    }
                    const qtyInput = card.querySelector('input[name="quantity"]');
                    const qty = qtyInput ? parseInt(qtyInput.value, 10) || 1 : 1;
                    const price = parseFloat(card.dataset.price);
                    total += price * qty;
                    selected++;
                }
            });
            if (totalLabel) {
                totalLabel.textContent = formatRupiah(total);
            }
            if (checkoutButton) {
                checkoutButton.disabled = selected === 0;
            }
        }

        function syncSelectAll() {
            const checkboxes = getItemCheckboxes();
            const allChecked = checkboxes.length > 0 && checkboxes.every(cb => cb.checked);
            const someChecked = checkboxes.some(cb => cb.checked);
            if (selectAll) {
                selectAll.checked = allChecked;
                selectAll.indeterminate = !allChecked && someChecked;
            }
            if (selectAllBottom) {
                selectAllBottom.checked = allChecked;
                selectAllBottom.indeterminate = !allChecked && someChecked;
            }
        }

        getItemCheckboxes().forEach(cb => {
            cb.addEventListener('change', () => {
                syncSelectAll();
                updateSummary();
            });
        });

        const handleSelectAll = (checked) => {
            getItemCheckboxes().forEach(cb => cb.checked = checked);
            updateSummary();
            syncSelectAll();
        };

        if (selectAll) {
            selectAll.addEventListener('change', () => handleSelectAll(selectAll.checked));
        }
        if (selectAllBottom) {
            selectAllBottom.addEventListener('change', () => handleSelectAll(selectAllBottom.checked));
        }

        if (checkoutButton) {
            checkoutButton.addEventListener('click', () => {
                const selected = getItemCheckboxes().filter(cb => cb.checked).map(cb => cb.value);
                if (selected.length === 0) {
                    alert('Pilih produk yang ingin di-checkout.');
                    return;
                }
                const action = checkoutContainer.dataset.action;
                const params = new URLSearchParams();
                params.append('submitted', '1');
                selected.forEach(id => params.append('selected[]', id));
                window.location.href = `${action}?${params.toString()}`;
            });
        }

        updateSummary();
        document.addEventListener('cart:refresh', () => {
            syncSelectAll();
            updateSummary();
        });

    }
</script>
@endsection
