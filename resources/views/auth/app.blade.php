<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ url('/') }}">Waroenk</a>

        <!-- Form Pencarian -->
        <form action="{{ route('products.search') }}" method="GET" class="d-flex ms-auto">
            <input 
                class="form-control me-2" 
                type="search" 
                name="q" 
                placeholder="Cari produk..." 
                aria-label="Search"
                value="{{ request('q') }}">
            <button class="btn btn-outline-success" type="submit">Cari</button>
        </form>
    </div>
</nav>
