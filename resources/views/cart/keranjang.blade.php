<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Waroenk</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4CAF50;
            --primary-dark: #2E7D32;
            --accent: #ff9900;
            --border: #e0e0e0;
            --muted: #6c757d;
            --light-bg: #f6f7f9;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f1f3f5;
            color: #333;
        }

        a { color: inherit; }

        .page-wrapper {
            max-width: 1200px;
            margin: 0 auto 60px auto;
            padding: 24px 20px;
        }

        .cart-header {
            background: var(--primary);
            color: #fff;
            border-radius: 16px;
            padding: 24px 32px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .cart-header-top {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 24px;
            font-weight: 700;
            text-decoration: none;
            color: #fff;
        }

        .cart-header-title {
            font-size: 20px;
            font-weight: 600;
            margin: 0;
        }

        .cart-search {
            display: flex;
            background: rgba(255,255,255,0.9);
            border-radius: 999px;
            overflow: hidden;
            max-width: 360px;
            width: 100%;
            margin-left: auto;
        }

        .cart-search input {
            flex: 1;
            border: none;
            padding: 10px 16px;
            font-family: inherit;
        }

        .cart-search button {
            border: none;
            background: var(--accent);
            color: #fff;
            padding: 0 20px;
            cursor: pointer;
            font-weight: 600;
        }

        .table-head {
            margin-top: 24px;
            background: #fff;
            border-radius: 12px;
            padding: 16px 24px;
            display: grid;
            grid-template-columns: 40px 3fr 1fr 1fr 1fr 110px;
            font-weight: 600;
            color: var(--muted);
            border: 1px solid var(--border);
        }

        .store-card {
            margin-top: 20px;
            background: #fff;
            border-radius: 16px;
            border: 1px solid var(--border);
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0,0,0,0.03);
        }

        .store-header {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 18px 24px;
            border-bottom: 1px solid var(--border);
            font-weight: 600;
            background: #fafafa;
        }

        .store-header .star {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 600;
            color: var(--accent);
            background: rgba(255, 153, 0, 0.12);
            padding: 6px 10px;
            border-radius: 999px;
        }

        .cart-item {
            display: grid;
            grid-template-columns: 40px 3fr 1fr 1fr 1fr 110px;
            padding: 18px 24px;
            gap: 16px;
            align-items: center;
            border-bottom: 1px solid var(--border);
        }

        .cart-item:last-child { border-bottom: none; }

        .cart-item-info {
            display: flex;
            gap: 16px;
            align-items: flex-start;
        }

        .cart-item-image {
            width: 72px;
            height: 72px;
            border-radius: 12px;
            overflow: hidden;
            background: var(--light-bg);
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
        }

        .cart-item-variant {
            font-size: 13px;
            color: var(--muted);
            margin: 0;
        }

        .price {
            font-weight: 600;
        }

        .quantity-form {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .quantity-form input {
            width: 60px;
            text-align: center;
            padding: 6px;
            border: 1px solid var(--border);
            border-radius: 8px 0 0 8px;
        }

        .quantity-form button {
            border: none;
            background: var(--primary);
            color: #fff;
            padding: 6px 14px;
            border-radius: 0 8px 8px 0;
            cursor: pointer;
        }

        .remove-form {
            text-align: right;
        }

        .remove-form button {
            background: none;
            border: none;
            color: var(--accent);
            cursor: pointer;
            font-weight: 600;
        }

        .summary-card {
            margin-top: 24px;
            background: #fff;
            border-radius: 16px;
            border: 1px solid var(--border);
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .summary-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .summary-actions label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .summary-total {
            margin-left: auto;
            text-align: right;
        }

        .summary-total h4 {
            margin: 0;
            font-size: 20px;
            color: var(--primary-dark);
        }

        .checkout-btn {
            padding: 12px 28px;
            background: var(--primary);
            border: none;
            color: #fff;
            font-weight: 600;
            border-radius: 999px;
            cursor: pointer;
        }

        .alert {
            background: #e6f4ea;
            color: var(--primary-dark);
            padding: 16px 20px;
            border-radius: 12px;
            margin: 24px 0;
            border-left: 4px solid var(--primary);
        }

        @media (max-width: 992px) {
            .cart-header { padding: 20px; }
            .table-head,
            .cart-item {
                grid-template-columns: 1fr;
                gap: 12px;
            }
            .table-head { display: none; }
            .cart-item {
                border-bottom: 1px solid var(--border);
            }
            .summary-card {
                flex-direction: column;
                align-items: flex-start;
            }
            .summary-total { margin-left: 0; }
            .checkout-btn { width: 100%; text-align: center; }
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <div class="cart-header">
            <div class="cart-header-top">
                <a href="{{ route('landing') }}" class="brand">
                    <img src="{{ asset('images/logo.png') }}" alt="Waroenk" style="height:46px;">
                    <span>Keranjang Belanja</span>
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert" style="border-left-color:#dc3545; background:#fdeaea; color:#b71c1c;">{{ session('error') }}</div>
        @endif

        @if(count($items) > 0)
            <div id="checkout-container" data-action="{{ route('cart.checkout.show') }}">
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
                        <div class="cart-item">
                            <input type="checkbox" class="item-checkbox" value="{{ $id }}">
                            <div class="cart-item-info">
                                <div class="cart-item-image">
                                    @if(!empty($item['image']))
                                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                                    @else
                                    <span style="display:flex;align-items:center;justify-content:center;height:100%;font-size:12px;color:var(--muted);">IMG</span>
                                @endif
                            </div>
                            <div>
                                <div class="cart-item-name">{{ $item['name'] }}</div>
                                <p class="cart-item-variant">Variasi: -</p>
                            </div>
                        </div>
                        <div class="price">Rp{{ number_format($item['price'], 0, ',', '.') }}</div>
                        <div class="quantity-form">
                            <form action="{{ route('cart.update', $id) }}" method="POST" style="display:flex;">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1">
                                <button type="submit">Ubah</button>
                            </form>
                        </div>
                        <div class="price">
                            Rp{{ number_format($subtotal, 0, ',', '.') }}
                        </div>
                        <div class="remove-form">
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="summary-card">
                    <div class="summary-actions">
                        <label class="d-flex align-items-center gap-2" style="color:var(--muted);"><input type="checkbox" id="select-all-bottom"> Pilih Semua ({{ count($items) }})</label>
                        <a href="{{ route('landing') }}" class="btn btn-outline-success" style="border-radius:999px;">Kembali Belanja</a>
                    </div>
                    <div class="summary-total">
                        <small class="text-muted">Total Dipilih</small>
                        <h4 id="selected-total">Rp0</h4>
                    </div>
                    <button type="button" class="checkout-btn" id="checkout-button" disabled>Checkout</button>
                </div>
            </div>
        @else
            <div class="store-card" style="padding:40px; text-align:center;">
                <h3>Keranjang Belanja Kosong</h3>
                <p class="text-muted">Yuk, isi dengan barang-barang pilihanmu!</p>
                <a href="{{ route('products.index') }}" class="checkout-btn" style="display:inline-block; text-decoration:none;">Belanja Sekarang</a>
            </div>
        @endif
    </div>

    <script>
        const itemCheckboxes = document.querySelectorAll('.item-checkbox');
        const selectAll = document.getElementById('select-all');
        const selectAllBottom = document.getElementById('select-all-bottom');
        const totalLabel = document.getElementById('selected-total');
        const checkoutButton = document.getElementById('checkout-button');
        const checkoutContainer = document.getElementById('checkout-container');

        const formatRupiah = (value) => 'Rp' + new Intl.NumberFormat('id-ID').format(Math.max(0, value));

        function updateSummary() {
            let total = 0;
            let selected = 0;
            itemCheckboxes.forEach(cb => {
                if (cb.checked) {
                    const card = cb.closest('.store-card');
                    const qtyInput = card.querySelector('input[name="quantity"]');
                    const qty = qtyInput ? parseInt(qtyInput.value, 10) || 1 : 1;
                    const price = parseFloat(card.dataset.price);
                    total += price * qty;
                    selected++;
                }
            });
            totalLabel.textContent = formatRupiah(total);
            checkoutButton.disabled = selected === 0;
        }

        function syncSelectAll() {
            const allChecked = Array.from(itemCheckboxes).every(cb => cb.checked);
            const someChecked = Array.from(itemCheckboxes).some(cb => cb.checked);
            if (selectAll) {
                selectAll.checked = allChecked;
                selectAll.indeterminate = !allChecked && someChecked;
            }
            if (selectAllBottom) {
                selectAllBottom.checked = allChecked;
                selectAllBottom.indeterminate = !allChecked && someChecked;
            }
        }

        itemCheckboxes.forEach(cb => {
            cb.addEventListener('change', () => {
                syncSelectAll();
                updateSummary();
            });
        });

        const handleSelectAll = (checked) => {
            itemCheckboxes.forEach(cb => cb.checked = checked);
            updateSummary();
            syncSelectAll();
        };

        if (selectAll) {
            selectAll.addEventListener('change', () => handleSelectAll(selectAll.checked));
        }
        if (selectAllBottom) {
            selectAllBottom.addEventListener('change', () => handleSelectAll(selectAllBottom.checked));
        }

        checkoutButton.addEventListener('click', () => {
            const selected = Array.from(itemCheckboxes).filter(cb => cb.checked).map(cb => cb.value);
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

        updateSummary();
    </script>
</body>
</html>
