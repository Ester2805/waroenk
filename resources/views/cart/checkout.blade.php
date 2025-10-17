@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<style>
    .checkout-hero {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: linear-gradient(135deg, rgba(46, 125, 50, 0.12), rgba(102, 187, 106, 0.1));
        border-radius: 24px;
        padding: clamp(24px, 6vw, 40px);
        margin-bottom: clamp(24px, 6vw, 40px);
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
    }

    .checkout-hero h1 {
        font-weight: 700;
        color: #1f2933;
        margin-bottom: 8px;
    }

    .checkout-hero p {
        margin: 0;
        color: #6b7280;
        max-width: 580px;
    }

    .checkout-container {
        min-height: calc(100vh - 120px);
        background: radial-gradient(circle at top left, rgba(102, 187, 106, 0.1), transparent 55%),
            radial-gradient(circle at bottom right, rgba(46, 125, 50, 0.1), transparent 55%),
            #f4f7fb;
        padding: clamp(32px, 6vw, 56px) clamp(20px, 6vw, 60px);
    }

    .checkout-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 360px;
        gap: clamp(24px, 4vw, 36px);
    }

    .checkout-card {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(15, 23, 42, 0.08);
        padding: clamp(24px, 5vw, 36px);
    }

    .checkout-section + .checkout-section {
        margin-top: 24px;
        padding-top: 24px;
        border-top: 1px solid rgba(148, 163, 184, 0.25);
    }

    .checkout-section h3 {
        font-weight: 600;
        color: #1f2933;
        margin-bottom: 16px;
    }

    .checkout-form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 16px;
    }

    .checkout-form-group label {
        display: block;
        font-weight: 600;
        color: #1f2933;
        margin-bottom: 6px;
    }

    .checkout-form-group input,
    .checkout-form-group textarea {
        width: 100%;
        border: 1px solid rgba(148, 163, 184, 0.4);
        border-radius: 12px;
        padding: 12px;
        font-size: 0.95rem;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .checkout-form-group input:focus,
    .checkout-form-group textarea:focus {
        outline: none;
        border-color: #2e7d32;
        box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.15);
    }

    .payment-methods {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .payment-chip {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        border: 1px solid rgba(148, 163, 184, 0.4);
        border-radius: 999px;
        padding: 10px 18px;
        cursor: pointer;
        font-weight: 600;
        color: #1f2933;
        transition: border-color .2s ease, background .2s ease;
    }

    .payment-chip input {
        width: auto;
    }

    .payment-chip.selected {
        border-color: #2e7d32;
        background: rgba(46, 125, 50, 0.1);
        color: #2e7d32;
    }

    .summary-card h3 {
        border-bottom: 1px solid rgba(148, 163, 184, 0.25);
        padding-bottom: 16px;
        margin-bottom: 16px;
    }

    .summary-item {
        display: flex;
        gap: 14px;
        padding: 14px 0;
        border-bottom: 1px solid rgba(148, 163, 184, 0.18);
    }

    .summary-item:last-child {
        border-bottom: none;
    }

    .summary-image {
        width: 62px;
        height: 62px;
        border-radius: 16px;
        background: rgba(148, 163, 184, 0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        color: #6b7280;
        overflow: hidden;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin: 8px 0;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid rgba(148, 163, 184, 0.25);
        font-weight: 600;
        font-size: 1.05rem;
    }

    .btn-checkout {
        width: 100%;
        background: #2e7d32;
        color: #fff;
        border-radius: 14px;
        padding: 12px;
        font-weight: 600;
        border: none;
        margin-top: 18px;
        transition: background .2s ease;
    }

    .btn-checkout:hover {
        background: #256029;
    }

    @media (max-width: 991.98px) {
        .checkout-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="checkout-container">
    <div class="checkout-hero">
        <div>
            <span class="badge bg-white text-success fw-semibold px-3 py-2 mb-2" style="width: fit-content;">Langkah 2 dari 2</span>
            <h1>Checkout</h1>
            <p>Isi detail pengiriman, pilih metode pembayaran, dan konfirmasi pesanan untuk menyelesaikan transaksi.</p>
        </div>
        <a href="{{ route('cart.index') }}" class="text-success fw-semibold" style="text-decoration:none;">&larr; Kembali ke Keranjang</a>
    </div>

    @if($errors->any())
        <div class="checkout-card" style="border-left: 4px solid #dc3545; margin-bottom: 24px;">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cart.checkout') }}" method="POST">
        @csrf
        <div class="checkout-grid">
            <div class="checkout-card">
                <div class="checkout-section">
                    <h3>Informasi Pengiriman</h3>
                    <div class="checkout-form-row">
                        <div class="checkout-form-group">
                            <label for="customer_name">Nama Lengkap</label>
                            <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
                        </div>
                        <div class="checkout-form-group">
                            <label for="phone">Nomor Telepon</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required>
                        </div>
                    </div>
                    <div class="checkout-form-group">
                        <label for="address">Alamat Lengkap</label>
                        <textarea id="address" name="address" rows="3" required placeholder="Masukkan alamat pengiriman dengan detail">{{ old('address') }}</textarea>
                    </div>
                </div>

                <div class="checkout-section">
                    <h3>Catatan Pengiriman</h3>
                    <div class="checkout-form-group">
                        <label for="delivery_note">Catatan</label>
                        <textarea id="delivery_note" name="delivery_note" rows="2" placeholder="Opsional, misal patokan atau instruksi kurir">{{ old('delivery_note') }}</textarea>
                    </div>
                </div>

                <div class="checkout-section">
                    <h3>Metode Pembayaran</h3>
                    <div class="payment-methods">
                        @php
                            $selectedPayment = old('payment_method', 'COD');
                            $paymentOptions = [
                                'COD' => 'Bayar di Tempat (COD)',
                                'Transfer Bank' => 'Transfer Bank',
                            ];
                        @endphp
                        @foreach($paymentOptions as $value => $label)
                            <label class="payment-chip {{ $selectedPayment === $value ? 'selected' : '' }}">
                                <input type="radio" name="payment_method" value="{{ $value }}" {{ $selectedPayment === $value ? 'checked' : '' }}>
                                {{ $label }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="checkout-section">
                    <h3>Ongkos Kirim</h3>
                    <div class="checkout-form-group">
                        <label for="shipping_cost">Masukkan Biaya Ongkir (Rp)</label>
                        <input type="number" id="shipping_cost" name="shipping_cost" value="{{ old('shipping_cost', $shipping_cost) }}" min="0" required>
                    </div>
                </div>
            </div>

            <aside class="checkout-card summary-card">
                <h3>Ringkasan Pesanan</h3>
                @foreach($cart as $item)
                    <div class="summary-item">
                        <div class="summary-image">
                            @if(!empty($item['image']))
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                            @else
                                <span>IMG</span>
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-semibold">{{ $item['name'] }}</div>
                            <small class="text-muted">Rp{{ number_format($item['price'], 0, ',', '.') }} &middot; x{{ $item['quantity'] }}</small>
                        </div>
                    </div>
                @endforeach

                <div class="summary-section">
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Ongkir (input)</span>
                        <span>Rp<span id="display-shipping">{{ number_format(old('shipping_cost', $shipping_cost), 0, ',', '.') }}</span></span>
                    </div>
                    <div class="summary-total">
                        <span>Total Bayar</span>
                        <span>Rp<span id="display-total">{{ number_format($grand_total, 0, ',', '.') }}</span></span>
                    </div>
                </div>

                <button type="submit" class="btn-checkout">Konfirmasi Pesanan</button>
                <p class="text-muted small mt-3">Pilih “Transfer Bank” untuk menerima virtual account dan menyelesaikan pembayaran secara mandiri.</p>
            </aside>
        </div>
    </form>
</div>

<script>
    document.querySelectorAll('.payment-chip').forEach(option => {
        option.addEventListener('click', function() {
            document.querySelectorAll('.payment-chip').forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
            this.querySelector('input[type="radio"]').checked = true;
        });
    });

    const shippingInput = document.getElementById('shipping_cost');
    const displayShipping = document.getElementById('display-shipping');
    const displayTotal = document.getElementById('display-total');
    const baseTotal = {{ $total }};

    if (shippingInput) {
        shippingInput.addEventListener('input', function() {
            const shipping = parseFloat(this.value || 0);
            const formatRupiah = value => new Intl.NumberFormat('id-ID').format(Math.max(0, value));
            displayShipping.textContent = formatRupiah(shipping);
            displayTotal.textContent = formatRupiah(baseTotal + Math.max(0, shipping));
        });
    }
</script>
@endsection
