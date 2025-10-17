<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checkout - Waroenk</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4CAF50;
            --secondary-color: #2E7D32;
            --light-gray: #f8f9fa;
            --medium-gray: #e9ecef;
            --dark-gray: #495057;
            --white: #ffffff;
            --border-color: #dee2e6;
            --shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
        }

        .checkout-wrapper {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .left-column {
            flex: 1;
            min-width: 300px;
        }

        .right-column {
            flex: 0 0 350px;
            min-width: 300px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 20px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 600;
            margin-left: 16px;
            padding-left: 16px;
        }

        .section {
            background: var(--white);
            padding: 20px;
            border-radius: 8px;
            box-shadow: var(--shadow);
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark-gray);
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 1px solid var(--border-color);
        }

        .form-row {
            display: flex;
            gap: 16px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .form-group {
            flex: 1;
            min-width: 200px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: var(--dark-gray);
        }

        input, select, textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-family: inherit;
            font-size: 14px;
            box-sizing: border-box;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.1);
        }

        .payment-methods {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 15px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .payment-option:hover {
            background-color: var(--light-gray);
        }

        .payment-option.selected {
            border-color: var(--primary-color);
            background-color: rgba(76, 175, 80, 0.1);
        }

        .payment-option input {
            width: auto;
            margin: 0;
        }

        .order-summary {
            background: var(--white);
            padding: 20px;
            border-radius: 8px;
            box-shadow: var(--shadow);
        }

        .order-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .item-image {
            width: 60px;
            height: 60px;
            background: var(--medium-gray);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: var(--dark-gray);
            overflow: hidden;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: 500;
            margin-bottom: 4px;
        }

        .item-price {
            color: var(--dark-gray);
            font-size: 14px;
        }

        .summary-section {
            margin-top: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            font-weight: 600;
            border-top: 1px solid var(--border-color);
            margin-top: 12px;
        }

        .confirm-btn {
            width: 100%;
            padding: 12px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 16px;
        }

        .confirm-btn:hover {
            background: var(--secondary-color);
        }

        @media (max-width: 768px) {
            .checkout-wrapper {
                flex-direction: column;
            }

            .right-column {
                flex: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a class="navbar-brand text-success fw-bold" href="{{ route('landing') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Waroenk" style="height:45px; margin-right:8px;">
            </a>

            <span class="page-title">Checkout</span>

            <div style="display: flex; gap: 10px; align-items:center;">
                <a href="{{ route('cart.index') }}" style="text-decoration:none; color: var(--primary-color); font-weight:600;">&larr; Kembali ke Keranjang</a>
                <div style="width: 24px; height: 24px; background: var(--primary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">1</div>
                <div style="width: 24px; height: 24px; border: 2px solid var(--primary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary-color);">2</div>
            </div>
        </div>

        @if($errors->any())
            <div class="section" style="border-left: 4px solid #dc3545;">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cart.checkout') }}" method="POST">
            @csrf
            <div class="checkout-wrapper">
                <div class="left-column">
                    <div class="section">
                        <h2 class="section-title">Informasi Pengiriman</h2>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="customer_name">Nama Lengkap</label>
                                <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Nomor Telepon</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea id="address" name="address" rows="3" required placeholder="Masukkan alamat lengkap">{{ old('address') }}</textarea>
                        </div>
                    </div>

                    <div class="section">
                        <h2 class="section-title">Jadwalkan Pengiriman</h2>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="delivery_note">Catatan Pengiriman</label>
                                <textarea id="delivery_note" name="delivery_note" rows="2" placeholder="Opsional">{{ old('delivery_note') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="section">
                        <h2 class="section-title">Metode Pembayaran</h2>
                        <div class="payment-methods">
                            @php
                                $selectedPayment = old('payment_method', 'COD');
                                $paymentOptions = [
                                    'COD' => 'Bayar di Tempat (COD)',
                                    'Transfer Bank' => 'Transfer Bank',
                                ];
                            @endphp
                            @foreach($paymentOptions as $value => $label)
                                <label class="payment-option {{ $selectedPayment === $value ? 'selected' : '' }}">
                                    <input type="radio" name="payment_method" value="{{ $value }}" {{ $selectedPayment === $value ? 'checked' : '' }}>
                                    {{ $label }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="section">
                        <h2 class="section-title">Ongkos Kirim</h2>
                        <div class="form-group">
                            <label for="shipping_cost">Masukkan Biaya Ongkir (Rp)</label>
                            <input type="number" id="shipping_cost" name="shipping_cost" value="{{ old('shipping_cost', $shipping_cost) }}" min="0" required>
                        </div>
                    </div>
                </div>

                <div class="right-column">
                    <div class="order-summary">
                        <h2 class="section-title">Ringkasan Pesanan</h2>

                        @foreach($cart as $item)
                            <div class="order-item">
                                <div class="item-image">
                                    @if(!empty($item['image']))
                                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                                    @else
                                        <span>IMG</span>
                                    @endif
                                </div>
                                <div class="item-details">
                                    <div class="item-name">{{ $item['name'] }}</div>
                                    <div class="item-price">Rp{{ number_format($item['price'], 0, ',', '.') }}</div>
                                </div>
                                <div class="quantity-control" style="color: var(--dark-gray);">x{{ $item['quantity'] }}</div>
                            </div>
                        @endforeach

                        <div class="summary-section">
                            <div class="summary-row">
                                <span class="summary-label">Subtotal</span>
                                <span class="summary-value">Rp{{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label">Ongkir (input)</span>
                                <span class="summary-value">Rp<span id="display-shipping">{{ number_format(old('shipping_cost', $shipping_cost), 0, ',', '.') }}</span></span>
                            </div>
                            <div class="summary-total">
                                <span>Total Bayar</span>
                                <span class="total-value">Rp<span id="display-total">{{ number_format($grand_total, 0, ',', '.') }}</span></span>
                            </div>
                        </div>

                        <button type="submit" class="confirm-btn">Konfirmasi Pesanan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.querySelectorAll('.payment-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.payment-option').forEach(opt => opt.classList.remove('selected'));
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
                const formatRupiah = (value) => new Intl.NumberFormat('id-ID').format(Math.max(0, value));
                displayShipping.textContent = formatRupiah(shipping);
                displayTotal.textContent = formatRupiah(baseTotal + Math.max(0, shipping));
            });
        }
    </script>
</body>
</html>
                        <p class="text-muted small mt-2">Pilih "Transfer Bank" untuk menerima nomor virtual account dan selesaikan pembayaran secara mandiri.</p>
