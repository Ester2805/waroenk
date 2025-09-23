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
        /* Styling Umum & Font */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 20px;
        }

        /* Kontainer Utama */
        .cart-container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        /* Header Keranjang */
        .cart-header {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .logo {
            color: #4CAF50;
            font-weight: 700;
            font-size: 28px;
            margin: 0;
        }
        .page-title {
            font-size: 24px;
            font-weight: 600;
            margin-left: 16px;
            border-left: 2px solid #ddd;
            padding-left: 16px;
        }
        .search-bar {
            margin-left: auto;
            display: flex;
        }
        .search-bar input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px 0 0 4px;
            width: 250px;
        }
        .search-bar button {
            padding: 10px 15px;
            border: none;
            background-color: #f0ad4e;
            color: white;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
        }

        /* Header Tabel */
        .cart-table-header {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            background-color: #fafafa;
            color: #888;
            font-size: 14px;
            font-weight: 500;
            border-radius: 4px;
        }
        .header-product { flex: 4; }
        .header-price, .header-quantity, .header-total { flex: 1; text-align: center; }
        .header-action { flex: 0.5; text-align: right; }
        .header-product input { margin-right: 10px; }

        /* Grup Toko */
        .store-group {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-top: 20px;
            overflow: hidden;
        }
        .store-header {
            padding: 12px 16px;
            background-color: #fdfdfd;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            align-items: center;
        }
        .store-checkbox { margin-right: 10px; }
        .store-name { font-weight: 600; }

        /* Item Produk */
        .product-item {
            display: flex;
            align-items: center;
            padding: 16px;
            border-bottom: 1px solid #eee;
        }
        .product-item:last-child {
            border-bottom: none;
        }
        .product-checkbox { margin-right: 16px; }
        .product-image { width: 80px; height: 80px; object-fit: cover; border-radius: 4px; margin-right: 16px; }
        .product-details { flex: 3.5; }
        .product-name { margin: 0 0 8px 0; font-size: 15px; }
        .product-variant { font-size: 13px; color: #777; border: 1px solid #ddd; padding: 4px; border-radius: 4px;}
        .product-price, .product-total-price { flex: 1; text-align: center; font-weight: 500; }
        .product-quantity { flex: 1; text-align: center; }
        .product-quantity input { width: 50px; text-align: center; padding: 5px; border: 1px solid #ccc; border-radius: 4px;}
        .product-action { flex: 0.5; text-align: right; }
        .delete-btn { color: #d9534f; text-decoration: none; font-size: 14px; }
        .delete-btn:hover { text-decoration: underline; }

        /* Footer/Checkout Bar */
        .cart-footer {
            border-top: 1px solid #eee;
            margin-top: 20px;
            padding-top: 20px;
            background-color: #fff;
        }
        .voucher-section {
            display: flex;
            justify-content: flex-start;
            padding: 16px;
            border: 1px solid #eee;
            border-radius: 4px;
        }
        .voucher-input { flex-grow: 1; max-width: 300px; padding: 10px; border: 1px solid #ddd; border-radius: 4px;}
        .voucher-btn { border: none; background: none; color: #4CAF50; font-weight: 600; cursor: pointer; margin-left: 16px; }

        .summary-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 16px;
        }
        .footer-actions { display: flex; align-items: center; gap: 16px; color: #555; }
        .footer-actions label { cursor: pointer; }
        .total-summary { display: flex; align-items: center; gap: 16px; }
        .final-price { font-size: 24px; font-weight: 700; color: #d9534f; }
        .checkout-btn {
            padding: 12px 40px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
        }
        .checkout-btn:hover { background-color: #45a049; }
    </style>
</head>
<body>
    <div class="cart-container">
        {{-- Header Utama --}}
        <header class="cart-header">
            <h1 class="logo">WAROENK</h1>
            <span class="page-title">Keranjang Belanja</span>
            <div class="search-bar">
                <input type="text" placeholder="Cari produk dalam keranjang">
                <button type="submit">🔍</button>
            </div>
        </header>

        {{-- Header Tabel --}}
        <div class="cart-table-header">
            {{-- ... (tidak perlu diubah) ... --}}
        </div>

        <main class="cart-items">
            {{-- Cek apakah keranjang kosong atau tidak --}}
            @if($items->count() > 0)

                {{-- Lakukan perulangan untuk setiap item di keranjang --}}
                @foreach($items as $item)
                <div class="store-group">
                    <div class="store-header">
                        <input type="checkbox" class="store-checkbox">
                        {{-- Ganti dengan nama toko jika ada relasinya --}}
                        <span class="store-name"><strong>NAMA TOKO</strong></span>
                    </div>
                    <div class="product-item">
                        <input type="checkbox" class="product-checkbox">
                        
                        {{-- Ganti src dengan path gambar dari database --}}
                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" class="product-image">
                        
                        <div class="product-details">
                            {{-- Tampilkan nama produk dari database --}}
                            <p class="product-name">{{ $item->name }}</p>
                            <select class="product-variant">
                                <option>variasi : Default</option>
                            </select>
                        </div>
                        
                        {{-- Tampilkan harga dari database --}}
                        <div class="product-price">Rp{{ number_format($item->price, 0, ',', '.') }}</div>
                        
                        <div class="product-quantity">
                            {{-- Ganti value dengan jumlah item di keranjang --}}
                            <input type="number" value="1" min="1">
                        </div>
                        
                        {{-- Total harga bisa dihitung dengan JS atau dari backend --}}
                        <div class="product-total-price">Rp{{ number_format($item->price, 0, ',', '.') }}</div>
                        
                        <div class="product-action"><a href="#" class="delete-btn">Hapus</a></div>
                    </div>
                </div>
                @endforeach

            @else
                {{-- Tampilkan pesan jika keranjang kosong --}}
                <div style="text-align: center; padding: 40px;">
                    <h3>Keranjang Belanja Kosong</h3>
                    <p>Yuk, isi dengan barang-barang impianmu!</p>
                </div>
            @endif
        </main>

        {{-- ... bagian footer tetap sama untuk saat ini ... --}}
    </div>
</body>
</html>