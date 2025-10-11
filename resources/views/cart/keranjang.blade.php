<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Waroenk</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f4f4; color: #333; margin: 20px; }
        .cart-container { max-width: 1200px; margin: 0 auto; background: #fff; padding: 24px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .cart-header { display: flex; align-items: center; border-bottom: 1px solid #eee; padding-bottom: 20px; margin-bottom: 20px; }
        .logo { color: #4CAF50; font-weight: 700; font-size: 28px; margin: 0; }
        .page-title { font-size: 24px; font-weight: 600; margin-left: 16px; border-left: 2px solid #ddd; padding-left: 16px; }
        .cart-table-header { display: flex; align-items: center; padding: 12px 16px; background: #fafafa; color: #888; font-size: 14px; font-weight: 500; border-radius: 4px; }
        .header-product { flex: 4; } .header-price, .header-quantity, .header-total { flex: 1; text-align: center; } .header-action { flex: 1; text-align: right; }
        .store-group { border: 1px solid #e0e0e0; border-radius: 8px; margin-top: 20px; overflow: hidden; }
        .store-header { padding: 12px 16px; background: #fdfdfd; border-bottom: 1px solid #e0e0e0; display: flex; align-items: center; }
        .store-name { font-weight: 600; }
        .product-item { display: flex; align-items: center; padding: 16px; border-bottom: 1px solid #eee; }
        .product-item:last-child { border-bottom: none; }
        .product-image { width: 80px; height: 80px; object-fit: cover; border-radius: 4px; margin-right: 16px; }
        .product-details { flex: 3.5; }
        .product-name { margin: 0 0 8px 0; font-size: 15px; }
        .product-price, .product-total-price { flex: 1; text-align: center; font-weight: 500; }
        .product-quantity { flex: 1; text-align: center; }
        .product-quantity input { width: 50px; text-align: center; padding: 5px; border: 1px solid #ccc; border-radius: 4px;}
        .product-action { flex: 1; text-align: right; display: flex; gap: 8px; justify-content: flex-end; }
        .btn { padding: 6px 12px; border-radius: 4px; border: none; cursor: pointer; font-size: 14px; }
        .btn-update { background: #007bff; color: #fff; }
        .btn-delete { background: #d9534f; color: #fff; }
        .btn-update:hover { background: #0056b3; }
        .btn-delete:hover { background: #b52b27; }

        /* Checkout section */
        .cart-summary { text-align: right; margin-top: 30px; }
        .btn-checkout {
            background: #4CAF50;
            color: white;
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-checkout:hover {
            background: #3e8e41;
        }
        .alert { padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <div class="cart-container">
        {{-- Header --}}
        <header class="cart-header">
            <h1 class="logo">WAROENK</h1>
            <span class="page-title">Keranjang Belanja</span>
        </header>

        {{-- Alert Message --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        {{-- Header Kolom --}}
        <div class="cart-table-header">
            <div class="header-product">Produk</div>
            <div class="header-price">Harga</div>
            <div class="header-quantity">Jumlah</div>
            <div class="header-total">Total</div>
            <div class="header-action">Aksi</div>
        </div>

        <main class="cart-items">
            @if(count($items) > 0)
                @php $grandTotal = 0; @endphp

                @foreach($items as $id => $item)
                    @php
                        $total = $item['price'] * $item['quantity'];
                        $grandTotal += $total;
                    @endphp

                    <div class="store-group">
                        <div class="store-header">
                            <span class="store-name"><strong>WAROENK</strong></span>
                        </div>
                        <div class="product-item">
                            @if($item['image'])
                                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="product-image">
                            @endif
                            
                            <div class="product-details">
                                <p class="product-name">{{ $item['name'] }}</p>
                            </div>
                            
                            <div class="product-price">Rp{{ number_format($item['price'], 0, ',', '.') }}</div>
                            
                            <div class="product-quantity">
                                <form action="{{ route('cart.update', $id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1">
                                    <button type="submit" class="btn btn-update">Update</button>
                                </form>
                            </div>
                            
                            <div class="product-total-price">
                                Rp{{ number_format($total, 0, ',', '.') }}
                            </div>
                            
                            <div class="product-action">
                                <form action="{{ route('cart.remove', $id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- Total dan Tombol Checkout --}}
                <div class="cart-summary">
                    <h3>Total Keseluruhan: Rp{{ number_format($grandTotal, 0, ',', '.') }}</h3>
                    <a href="{{ route('cart.checkout.show') }}" class="btn-checkout">Lanjut ke Checkout</a>
                </div>

            @else
                <div style="text-align: center; padding: 40px;">
                    <h3>Keranjang Belanja Kosong</h3>
                    <p>Yuk, isi dengan barang-barang impianmu!</p>
                </div>
            @endif
        </main>
    </div>
</body>
</html>