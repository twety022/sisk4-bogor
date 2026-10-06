<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin - SISK4 Bogor')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body class="dash-body">

    <div class="dash-shell">
        <aside class="dash-sidebar" id="dashSidebar">
            <div class="dash-sidebar-brand">
                <img src="{{ asset('images/logo-smkn4.png') }}" alt="Logo" width="30" height="30" onerror="this.style.display='none'">
                <span>SISK4 Admin</span>
            </div>

            <nav class="dash-nav">
                <a href="{{ route('dashboard') }}" class="dash-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>

                <span class="dash-nav-label">Konten Website</span>
                <a href="{{ route('admin.news.index') }}" class="dash-nav-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                    <i class="bi bi-newspaper"></i> Berita & Pengumuman
                </a>
                <a href="{{ route('admin.gallery.index') }}" class="dash-nav-link {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                    <i class="bi bi-images"></i> Galeri
                </a>

                <a href="{{ route('admin.products.index') }}" class="dash-nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam"></i> Produk Siswa
                </a>

                <span class="dash-nav-label">Interaksi</span>
                <a href="{{ route('admin.messages.index') }}" class="dash-nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                    <i class="bi bi-envelope"></i> Pesan Masuk
                    @php $unread = \App\Models\ContactMessage::where('is_read', false)->count(); @endphp
                    @if ($unread > 0)
                        <span class="dash-nav-badge">{{ $unread }}</span>
                    @endif
                </a>

                @if (auth()->user()->role === 'super_admin')
    <span class="dash-nav-label">Pengaturan</span>
    <a href="{{ route('admin.admins.index') }}" class="dash-nav-link {{ request()->routeIs('admin.admins.*') ? 'active' : '' }}">
        <i class="bi bi-people"></i> Lihat Admin
    </a>
@endif
            </nav>

            <div class="dash-sidebar-foot">
                <a href="{{ route('home') }}" target="_blank" class="dash-view-site">
                    <i class="bi bi-box-arrow-up-right"></i> Lihat Website
                </a>
            </div>
        </aside>

        <div class="dash-main">
            <header class="dash-topbar">
                <button type="button" class="dash-burger" id="dashBurger" aria-label="Buka menu">
                    <i class="bi bi-list"></i>
                </button>

                <h1 class="dash-page-title">@yield('page-title', 'Dashboard')</h1>

                <div class="dash-user">
                    <span class="dash-user-name">{{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="dash-logout-btn">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </div>
            </header>

            <main class="dash-content">
                @if (session('success'))
                    <div class="dash-alert dash-alert-success">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="dash-alert dash-alert-error">
                        <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('dashBurger').addEventListener('click', function () {
            document.getElementById('dashSidebar').classList.toggle('is-open');
        });
    </script>
    @stack('scripts')
</body>
</html>