
<!doctype html>
<html lang="en">
<head> 
  <title>Welcome To Admin Dashboard</title>
</head>
<body class="bg-gray-100">

    <!-- start navbar -->
    <div class="px-6 md:fixed md:w-full md:top-0 md:z-30 flex flex-row flex-wrap items-center bg-white p-4 border-b border-gray-200 shadow-md">

        <!-- logo -->
        <div class="flex-none w-60 flex flex-row items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Waroenk" style="height:45px; margin-right:8px;">
        </div>
        <!-- end logo -->

        <!-- right -->
        <div class="hidden md:flex flex-1 justify-end items-center">
            <span class="mr-4">Halo, Admin Waroenk</span>
            <button class="border border-primary-500 text-primary-500 hover:bg-primary-50 px-4 py-2 rounded-md text-sm font-medium transition-colors">
                Logout
            </button>
        </div>
        <!-- end right -->

    </div>
    <!-- end navbar --> 

    <!-- Sidebar partial -->
    <aside id="sideBar" class="hidden md:flex fixed left-0 top-20 z-20 h-screen w-64 bg-white border-r border-gray-200 p-6 flex-col text-black">

        <nav class="flex-1 overflow-y-auto">
        <p class="uppercase text-xs text-black mb-4 tracking-wider">Dashboard</p>

            <a href="{{ route('admin.dashboard') }}" class="mb-3 flex items-center capitalize font-medium text-sm text-primary-500 hover:text-primary-600 transition bg-primary-50 rounded-lg px-2">
                <i class="fad fa-chart-pie text-xs mr-2"></i>
                Analytics dashboard
            </a>

            <a href="#" class="mb-3 flex items-center capitalize font-medium text-sm text-black hover:text-primary-600 transition">
                <i class="fad fa-shopping-cart text-xs mr-2"></i>
                Penjualan
            </a>

            <a href="#" class="mb-3 flex items-center capitalize font-medium text-sm text-black hover:text-primary-600 transition">
                <i class="fad fa-file-alt text-xs mr-2"></i>
                Laporan
            </a>

            <a href="#" class="mb-3 flex items-center capitalize font-medium text-sm text-black hover:text-primary-600 transition">
                <i class="fad fa-users text-xs mr-2"></i>
                Pengguna
            </a>

        <p class="uppercase text-xs text-black mb-4 mt-6 tracking-wider">Manajemen</p>

            <a href="#" class="mb-3 flex items-center capitalize font-medium text-sm text-black hover:text-primary-600 transition">
                <i class="fad fa-box text-xs mr-2"></i>
                Produk
            </a>

            <a href="/products/create" class="mb-3 flex items-center capitalize font-medium text-sm text-black hover:text-primary-600 transition">
                <i class="fad fa-cog text-xs mr-2"></i>
                Tambah Produk
            </a>

            <a href="#" class="mb-3 flex items-center capitalize font-medium text-sm text-black hover:text-primary-600 transition">
                <i class="fad fa-question-circle text-xs mr-2"></i>
                Bantuan
            </a>
        </nav>

    </aside>

</body>
</html>
