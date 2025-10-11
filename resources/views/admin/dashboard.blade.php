@extends('layouts.appAdmin')

@section('title', 'Admin Dashboard')

@section('content')
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">  
    <link rel="shortcut icon" href="./img/fav.png" type="image/x-icon">  
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  
    <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f9fafb;
    }
    .status-shipped {
      background-color: #f0fdf4;
      color: #166534;
    }
    .status-pending {
      background-color: #fffbeb;
      color: #b45309;
    }
    .status-cancelled {
      background-color: #fef2f2;
      color: #dc2626;
    }
    .chart-container {
      height: 300px;
      position: relative;
    }
    .sales-trend {
      fill: url(#gradient);
      stroke: #2e7d32;
      stroke-width: 2;
      fill-opacity: 0.3;
    }
    .best-seller-item {
      display: flex;
      align-items: center;
      padding: 12px 0;
      border-bottom: 1px solid #f3f4f6;
    }
    .best-seller-item:last-child {
      border-bottom: none;
    }
    </style>
    <title>Waroenk - Dashboard Admin</title>
</head>

<body class="">
    <!-- Main Content -->
    <main class="md:pl-64 pt-4 md:pt-24 p-7">
        <div class="">
            <div class="">
                <h1 class="text-2xl font-bold text-gray-900">Dashboard Admin</h1>
                <p class="text-gray-600 mt-2">Selamat datang di panel admin Waroenk. Lihat ringkasan aktivitas terbaru dan statistik penjualan.</p>
            </div>
            <!-- Stat Cards -->
            <div class="pt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-[#166534] rounded-xl p-6 shadow-sm text-white">
                    <h3 class="text-lg font-semibold mb-2">Total Penjualan</h3>
                    <p class="text-3xl font-bold">Rp 82.950.96</p>
                    <p class="text-sm opacity-90 mt-1">+12% dari bulan lalu</p>
                </div>
                <div class="bg-[#166534] rounded-xl p-6 shadow-sm text-white">
                    <h3 class="text-lg font-semibold mb-2">Order Hari Ini</h3>
                    <p class="text-3xl font-bold">34</p>
                    <p class="text-sm opacity-90 mt-1">+57.6% dari kemarin</p>
                </div>
                <div class="bg-[#166534] rounded-xl p-6 shadow-sm text-white">
                    <h3 class="text-lg font-semibold mb-2">Pengguna Aktif</h3>
                    <p class="text-3xl font-bold">1,245</p>
                    <p class="text-sm opacity-90 mt-1">+8% dari minggu lalu</p>
                </div>
                <div class="bg-[#166534] rounded-xl p-6 shadow-sm text-white">
                    <h3 class="text-lg font-semibold mb-2">Produk Terjual</h3>
                    <p class="text-3xl font-bold">2,876</p>
                    <p class="text-sm opacity-90 mt-1">+15% dari bulan lalu</p>
                </div>
            </div>

            <!-- Sales Summary & Chart -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Ringkasan Penjualan</h2>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 bg-primary-500 text-white text-sm rounded-md font-medium">Bulan</button>
                            <button class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-md font-medium hover:bg-gray-200">Minggu</button>
                        </div>
                    </div>
                    <div class="chart-container">
                        <svg width="100%" height="100%" viewBox="0 0 600 300">
                            <defs>
                                <linearGradient id="gradient" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="#2e7d32" stop-opacity="0.5"/>
                                    <stop offset="100%" stop-color="#2e7d32" stop-opacity="0.1"/>
                                </linearGradient>
                            </defs>
                            <path class="sales-trend" d="M0,150 C50,100 100,200 150,120 C200,80 250,180 300,100 C350,60 400,160 450,80 C500,40 550,140 600,60 L600,300 L0,300 Z" />
                            <line x1="0" y1="300" x2="600" y2="300" stroke="#e5e7eb" stroke-width="1" />
                            <line x1="0" y1="250" x2="600" y2="250" stroke="#e5e7eb" stroke-width="1" />
                            <line x1="0" y1="200" x2="600" y2="200" stroke="#e5e7eb" stroke-width="1" />
                            <line x1="0" y1="150" x2="600" y2="150" stroke="#e5e7eb" stroke-width="1" />
                            <line x1="0" y1="100" x2="600" y2="100" stroke="#e5e7eb" stroke-width="1" />
                            <line x1="0" y1="50" x2="600" y2="50" stroke="#e5e7eb" stroke-width="1" />
                            <circle cx="50" cy="100" r="3" fill="#2e7d32" />
                            <circle cx="100" cy="200" r="3" fill="#2e7d32" />
                            <circle cx="150" cy="120" r="3" fill="#2e7d32" />
                            <circle cx="200" cy="80" r="3" fill="#2e7d32" />
                            <circle cx="250" cy="180" r="3" fill="#2e7d32" />
                            <circle cx="300" cy="100" r="3" fill="#2e7d32" />
                            <circle cx="350" cy="60" r="3" fill="#2e7d32" />
                            <circle cx="400" cy="160" r="3" fill="#2e7d32" />
                            <circle cx="450" cy="80" r="3" fill="#2e7d32" />
                            <circle cx="500" cy="40" r="3" fill="#2e7d32" />
                            <circle cx="550" cy="140" r="3" fill="#2e7d32" />
                            <circle cx="600" cy="60" r="3" fill="#2e7d32" />
                        </svg>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Riwayat Penjualan Terbaru</h2>
                    <div class="space-y-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-medium text-gray-900">Puma Shoes</p>
                                <p class="text-sm text-gray-500">30 Menit Yang Lalu</p>
                            </div>
                            <span class="text-green-600 font-medium">+Rp 250.000</span>
                        </div>
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-medium text-gray-900">Google Pixel 4 XL</p>
                                <p class="text-sm text-gray-500">1 Hari Yang Lalu</p>
                            </div>
                            <span class="text-red-600 font-medium">-Rp 10.000</span>
                        </div>
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-medium text-gray-900">Nike Air Jordan</p>
                                <p class="text-sm text-gray-500">2 Jam Yang Lalu</p>
                            </div>
                            <span class="text-red-600 font-medium">-Rp 98.000</span>
                        </div>
                    </div>
                    <hr class="my-4 border-gray-200">
                    <div class="flex justify-between items-center">
                        <h3 class="font-semibold text-gray-900">Total Penjualan</h3>
                        <h3 class="font-semibold text-green-600">Rp 82.950.96</h3>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2 mt-3">
                        <div class="bg-green-500 h-2 rounded-full" style="width: 85%"></div>
                    </div>
                </div>
            </div>

            <!-- Best Sellers & Recent Orders -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Produk Terlaris</h2>
                        <button class="text-gray-500 hover:text-gray-700 text-sm font-medium">Lihat Semua</button>
                    </div>
                    <div class="space-y-4">
                        <div class="best-seller-item">
                            <img src="https://placehold.co/50x50/ddd/333?text=S" class="w-12 h-12 rounded object-cover mr-3" alt="Sneakers">
                            <div class="flex-1">
                                <p class="font-medium text-gray-900">Sneakers And Tennis</p>
                                <div class="flex space-x-4 text-sm text-gray-500 mt-1">
                                    <span>Harga: Rp 95.000</span>
                                    <span>Terkjual: 579</span>
                                    <span>Profit: Rp 4.640.000</span>
                                </div>
                            </div>
                        </div>
                        <div class="best-seller-item">
                            <img src="https://placehold.co/50x50/ddd/333?text=C" class="w-12 h-12 rounded object-cover mr-3" alt="Crazy Socks">
                            <div class="flex-1">
                                <p class="font-medium text-gray-900">Crazy Socks & Graphic Socks For Men</p>
                                <div class="flex space-x-4 text-sm text-gray-500 mt-1">
                                    <span>Harga: Rp 63.000</span>
                                    <span>Terkjual: 293</span>
                                    <span>Profit: Rp 4.067.000</span>
                                </div>
                            </div>
                        </div>
                        <div class="best-seller-item">
                            <img src="https://placehold.co/50x50/ddd/333?text=A" class="w-12 h-12 rounded object-cover mr-3" alt="Adidas Ball">
                            <div class="flex-1">
                                <p class="font-medium text-gray-900">Adidas Soccer Ball</p>
                                <div class="flex space-x-4 text-sm text-gray-500 mt-1">
                                    <span>Harga: Rp 27.000</span>
                                    <span>Terkjual: 367</span>
                                    <span>Profit: Rp 4.759.000</span>
                                </div>
                            </div>
                        </div>
                        <div class="best-seller-item">
                            <img src="https://placehold.co/50x50/ddd/333?text=B" class="w-12 h-12 rounded object-cover mr-3" alt="Cookies">
                            <div class="flex-1">
                                <p class="font-medium text-gray-900">Best Chocolate Chip Cookies</p>
                                <div class="flex space-x-4 text-sm text-gray-500 mt-1">
                                    <span>Harga: Rp 56.000</span>
                                    <span>Terkjual: 761</span>
                                    <span>Profit: Rp 1.242.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Pesanan Terbaru</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left text-sm text-gray-500 border-b">
                                    <th class="pb-3">Pelanggan</th>
                                    <th class="pb-3">Produk</th>
                                    <th class="pb-3">Invoice</th>
                                    <th class="pb-3">Harga</th>
                                    <th class="pb-3">Status</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-4">
                                        <div class="flex items-center">
                                            <img src="https://placehold.co/40x40/ddd/333?text=A" class="w-10 h-10 rounded-full mr-3" alt="Abdalroof">
                                            <span>Abdalroof</span>
                                        </div>
                                    </td>
                                    <td class="py-4">Nike Sport</td>
                                    <td class="py-4">#4886</td>
                                    <td class="py-4">Rp 21.000</td>
                                    <td class="py-4">
                                        <span class="status-shipped px-2 py-1 rounded text-xs font-medium">Dikirim</span>
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-4">
                                        <div class="flex items-center">
                                            <img src="https://placehold.co/40x40/ddd/333?text=C" class="w-10 h-10 rounded-full mr-3" alt="Connel">
                                            <span>Connel</span>
                                        </div>
                                    </td>
                                    <td class="py-4">Nike Sport</td>
                                    <td class="py-4">#3015</td>
                                    <td class="py-4">Rp 88.000</td>
                                    <td class="py-4">
                                        <span class="status-shipped px-2 py-1 rounded text-xs font-medium">Dikirim</span>
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-4">
                                        <div class="flex items-center">
                                            <img src="https://placehold.co/40x40/ddd/333?text=D" class="w-10 h-10 rounded-full mr-3" alt="Derron">
                                            <span>Derron</span>
                                        </div>
                                    </td>
                                    <td class="py-4">Nike Sport</td>
                                    <td class="py-4">#5418</td>
                                    <td class="py-4">Rp 68.000</td>
                                    <td class="py-4">
                                        <span class="status-shipped px-2 py-1 rounded text-xs font-medium">Dikirim</span>
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-4">
                                        <div class="flex items-center">
                                            <img src="https://placehold.co/40x40/ddd/333?text=C" class="w-10 h-10 rounded-full mr-3" alt="Cambell">
                                            <span>Cambell</span>
                                        </div>
                                    </td>
                                    <td class="py-4">Nike Sport</td>
                                    <td class="py-4">#1136</td>
                                    <td class="py-4">Rp 21.000</td>
                                    <td class="py-4">
                                        <span class="status-shipped px-2 py-1 rounded text-xs font-medium">Dikirim</span>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="py-4">
                                        <div class="flex items-center">
                                            <img src="https://placehold.co/40x40/ddd/333?text=D" class="w-10 h-10 rounded-full mr-3" alt="Dylin">
                                            <span>Dylin</span>
                                        </div>
                                    </td>
                                    <td class="py-4">Nike Sport</td>
                                    <td class="py-4">#7238</td>
                                    <td class="py-4">Rp 32.000</td>
                                    <td class="py-4">
                                        <span class="status-shipped px-2 py-1 rounded text-xs font-medium">Dikirim</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- User List -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Daftar Pengguna Terdaftar</h2>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-sm text-gray-500 border-b">
                                <th class="pb-3">No</th>
                                <th class="pb-3">Nama Pengguna</th>
                                <th class="pb-3">Email</th>
                                <th class="pb-3">Role</th>
                                <th class="pb-3">Tanggal Daftar</th>
                                <th class="pb-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-4">1</td>
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <img src="https://placehold.co/40x40/ddd/333?text=A" class="w-10 h-10 rounded-full mr-3" alt="Abdalroof">
                                        <span>Abdalroof</span>
                                    </div>
                                </td>
                                <td class="py-4">abdalroof@example.com</td>
                                <td class="py-4">Pembeli</td>
                                <td class="py-4">15 Jan 2024</td>
                                <td class="py-4">
                                    <span class="status-shipped px-2 py-1 rounded text-xs font-medium">Aktif</span>
                                </td>
                            </tr>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-4">2</td>
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <img src="https://placehold.co/40x40/ddd/333?text=C" class="w-10 h-10 rounded-full mr-3" alt="Connel">
                                        <span>Connel</span>
                                    </div>
                                </td>
                                <td class="py-4">connel@example.com</td>
                                <td class="py-4">Pembeli</td>
                                <td class="py-4">12 Jan 2024</td>
                                <td class="py-4">
                                    <span class="status-shipped px-2 py-1 rounded text-xs font-medium">Aktif</span>
                                </td>
                            </tr>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-4">3</td>
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <img src="https://placehold.co/40x40/ddd/333?text=D" class="w-10 h-10 rounded-full mr-3" alt="Derron">
                                        <span>Derron</span>
                                    </div>
                                </td>
                                <td class="py-4">derron@example.com</td>
                                <td class="py-4">Pembeli</td>
                                <td class="py-4">10 Jan 2024</td>
                                <td class="py-4">
                                    <span class="status-shipped px-2 py-1 rounded text-xs font-medium">Aktif</span>
                                </td>
                            </tr>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-4">4</td>
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <img src="https://placehold.co/40x40/ddd/333?text=C" class="w-10 h-10 rounded-full mr-3" alt="Cambell">
                                        <span>Cambell</span>
                                    </div>
                                </td>
                                <td class="py-4">cambell@example.com</td>
                                <td class="py-4">Pembeli</td>
                                <td class="py-4">08 Jan 2024</td>
                                <td class="py-4">
                                    <span class="status-shipped px-2 py-1 rounded text-xs font-medium">Aktif</span>
                                </td>
                            </tr>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-4">5</td>
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <img src="https://placehold.co/40x40/ddd/333?text=D" class="w-10 h-10 rounded-full mr-3" alt="Dylin">
                                        <span>Dylin</span>
                                    </div>
                                </td>
                                <td class="py-4">dylin@example.com</td>
                                <td class="py-4">Pembeli</td>
                                <td class="py-4">05 Jan 2024</td>
                                <td class="py-4">
                                    <span class="status-shipped px-2 py-1 rounded text-xs font-medium">Aktif</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="py-4">6</td>
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <img src="https://placehold.co/40x40/ddd/333?text=M" class="w-10 h-10 rounded-full mr-3" alt="Moe">
                                        <span>Moe</span>
                                    </div>
                                </td>
                                <td class="py-4">moe@example.com</td>
                                <td class="py-4">Pembeli</td>
                                <td class="py-4">03 Jan 2024</td>
                                <td class="py-4">
                                    <span class="status-shipped px-2 py-1 rounded text-xs font-medium">Aktif</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </div>
    </main>

    <!-- script -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- end script -->

</body>

@endsection
