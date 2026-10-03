<nav class="navbar navbar-expand-lg navbar-sisk4 sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/logo-smkn4.png') }}" alt="Logo SMKN 4 Bogor" width="30" height="30"
                 class="me-2" onerror="this.style.display='none'">
            <span class="navbar-brand-text">SMK NEGERI 4 BOGOR</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSisk4">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSisk4">
            <ul class="navbar-nav mx-auto gap-lg-1">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
    </li>

    {{-- Profil: berdiri sendiri --}}
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('profile.tentang') ? 'active' : '' }}" href="{{ route('profile.tentang') }}">Profil</a>
    </li>

    {{-- Informasi Umum: dropdown --}}
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle {{ request()->routeIs('profile.program', 'ppdb.*', 'products.*') ? 'active' : '' }}"
           href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Informasi Umum
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item {{ request()->routeIs('profile.program') ? 'active' : '' }}" href="{{ route('profile.program') }}">Program Keahlian</a></li>
            <li><a class="dropdown-item {{ request()->routeIs('ppdb.*') ? 'active' : '' }}" href="{{ route('ppdb.index') }}">PPDB</a></li>
            <li><a class="dropdown-item {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">Produk</a></li>
        </ul>
    </li>

    <li class="nav-item"><a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">Galeri</a></li>
    <li class="nav-item"><a class="nav-link {{ request()->routeIs('news.*') ? 'active' : '' }}" href="{{ route('news.index') }}">Berita</a></li>
    <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact.*') ? 'active' : '' }}" href="{{ route('contact.index') }}">Kontak</a></li>
</ul>

            <a href="{{ Route::has('login') ? route('login') : '#' }}" class="btn btn-brand-navbar rounded-pill px-4 mt-3 mt-lg-0">
                Login
            </a>
        </div>
    </div>
</nav>
