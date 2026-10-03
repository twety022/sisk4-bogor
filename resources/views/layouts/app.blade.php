<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SISK4 Bogor - Sistem Informasi SMKN 4 Bogor')</title>
    <meta name="description" content="@yield('meta_description', 'Website resmi Sistem Informasi SMKN 4 Bogor (SISK4).')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swapfamily=Playfair+Display:wght@600;700" rel="stylesheet">

    {{-- Custom CSS project --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('styles')
    @stack('styles')
</head>
<body>

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    {{-- Bootstrap JS Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/reveal.js') }}" defer></script>

    @stack('scripts')
</body>
</html>
