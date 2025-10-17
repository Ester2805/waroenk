
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
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="border border-primary-500 text-primary-500 hover:bg-primary-50 px-4 py-2 rounded-md text-sm font-medium transition-colors">
                    Logout
                </button>
            </form>
            @auth
                <span class="me-3">Halo, {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-signup">Logout</button>
                </form>
            @endauth
        </div>
        <!-- end right -->

    </div>
    <!-- end navbar --> 

    <!-- Sidebar partial -->
    <aside id="sideBar" class="hidden md:flex fixed left-0 top-20 z-20 h-screen w-64 bg-white border-r border-gray-200 p-6 flex-col text-black">

        <nav class="flex-1 overflow-y-auto">
        <p class="uppercase text-xs text-black mb-4 tracking-wider">Dashboard</p>

            <a href="{{ route('admin.dashboard') }}" class="mb-3 flex items-center capitalize font-medium text-sm transition px-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'text-primary-600 bg-primary-50' : 'text-black hover:text-primary-600' }}">
                <i class="fad fa-chart-pie text-xs mr-2"></i>
                Ikhtisar
            </a>

            <a href="{{ route('admin.analytics.index') }}" class="mb-3 flex items-center capitalize font-medium text-sm transition px-2 rounded-lg {{ request()->routeIs('admin.analytics.*') ? 'text-primary-600 bg-primary-50' : 'text-black hover:text-primary-600' }}">
                <i class="fad fa-chart-line text-xs mr-2"></i>
                Analytics
            </a>

            <a href="{{ route('admin.sales.index') }}" class="mb-3 flex items-center capitalize font-medium text-sm transition px-2 rounded-lg {{ request()->routeIs('admin.sales.*') ? 'text-primary-600 bg-primary-50' : 'text-black hover:text-primary-600' }}">
                <i class="fad fa-shopping-cart text-xs mr-2"></i>
                Penjualan
            </a>

            <a href="{{ route('admin.reports.index') }}" class="mb-3 flex items-center capitalize font-medium text-sm transition px-2 rounded-lg {{ request()->routeIs('admin.reports.*') ? 'text-primary-600 bg-primary-50' : 'text-black hover:text-primary-600' }}">
                <i class="fad fa-file-alt text-xs mr-2"></i>
                Laporan
            </a>

            <a href="{{ route('admin.users.index') }}" class="mb-3 flex items-center capitalize font-medium text-sm transition px-2 rounded-lg {{ request()->routeIs('admin.users.*') ? 'text-primary-600 bg-primary-50' : 'text-black hover:text-primary-600' }}">
                <i class="fad fa-users text-xs mr-2"></i>
                Pengguna
            </a>

        <p class="uppercase text-xs text-black mb-4 mt-6 tracking-wider">Manajemen</p>

            <a href="{{ route('admin.products.index') }}" class="mb-3 flex items-center capitalize font-medium text-sm transition px-2 rounded-lg {{ request()->routeIs('admin.products.index') ? 'text-primary-600 bg-primary-50' : 'text-black hover:text-primary-600' }}">
                <i class="fad fa-box text-xs mr-2"></i>
                Produk
            </a>

            <a href="{{ route('admin.products.create') }}" class="mb-3 flex items-center capitalize font-medium text-sm transition px-2 rounded-lg {{ request()->routeIs('admin.products.create') ? 'text-primary-600 bg-primary-50' : 'text-black hover:text-primary-600' }}">
                <i class="fad fa-cog text-xs mr-2"></i>
                Tambah Produk
            </a>

            <a href="{{ route('admin.categories.index') }}" class="mb-3 flex items-center capitalize font-medium text-sm transition px-2 rounded-lg {{ request()->routeIs('admin.categories.*') ? 'text-primary-600 bg-primary-50' : 'text-black hover:text-primary-600' }}">
                <i class="fad fa-tags text-xs mr-2"></i>
                Kategori
            </a>

            <a href="{{ route('admin.shipping-options.index') }}" class="mb-3 flex items-center capitalize font-medium text-sm transition px-2 rounded-lg {{ request()->routeIs('admin.shipping-options.*') ? 'text-primary-600 bg-primary-50' : 'text-black hover:text-primary-600' }}">
                <i class="fad fa-shipping-fast text-xs mr-2"></i>
                Opsi Pengiriman
            </a>
        </nav>

    </aside>
