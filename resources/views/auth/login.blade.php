@extends('layouts.auth')

@section('title', 'Login Admin - SISK4 Bogor')

@section('content')
<div class="login-shell">

    {{-- Sisi kiri: foto sekolah --}}
    <aside class="login-visual" style="background-image: url('{{ asset('images/hero-students.JPG') }}');">
        <div class="login-visual-overlay"></div>
        <div class="login-visual-inner">
            <a href="{{ route('home') }}" class="login-brand">
                <img src="{{ asset('images/logo-smkn4.png') }}" alt="Logo SMKN 4 Bogor" width="34" height="34" onerror="this.style.display='none'">
                <span>SMK NEGERI 4 BOGOR</span>
            </a>

            <div class="login-visual-copy">
                <h2>Kelola informasi sekolah dalam satu tempat.</h2>
                <p>
                    Dashboard administrator SISK4 untuk mengelola konten dan
                    informasi website SMK Negeri 4 Bogor.
                </p>
            </div>

            <span class="login-visual-foot">&copy; {{ date('Y') }} SMK Negeri 4 Bogor</span>
        </div>
    </aside>

    {{-- Sisi kanan: form --}}
    <main class="login-panel">
        <a href="{{ route('home') }}" class="login-back">
            <i class="bi bi-arrow-left"></i> Kembali ke beranda
        </a>

        <div class="login-box">
            <span class="login-badge"><i class="bi bi-shield-lock-fill"></i> Area Administrator</span>
            <h1 class="login-title">Masuk ke Dashboard</h1>
            <p class="login-desc">
                Gunakan akun administrator yang terdaftar untuk mengelola konten website sekolah.
            </p>

            @if ($errors->any())
                <div class="login-alert" role="alert">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" id="loginForm">
                @csrf

                <div class="login-field">
                    <label class="login-label" for="loginEmail">Email</label>
                    <div class="login-input-wrap">
                        <i class="bi bi-envelope"></i>
                        <input type="email" id="loginEmail" name="email" value="{{ old('email') }}"
                               placeholder="Masukkan email" autocomplete="username" required autofocus>
                    </div>
                </div>

                <div class="login-field">
                    <label class="login-label" for="loginPassword">Password</label>
                    <div class="login-input-wrap">
                        <i class="bi bi-lock"></i>
                        <input type="password" id="loginPassword" name="password"
                               placeholder="Masukkan password" autocomplete="current-password" required>
                        <button type="button" class="login-toggle" id="loginToggle" aria-label="Tampilkan password">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="login-options">
                    <label class="login-remember">
                        <input type="checkbox" name="remember">
                        <span>Ingat saya</span>
                    </label>
                    <button type="button" class="login-forgot" id="loginForgot">Lupa password?</button>
                </div>

                <div class="login-forgot-note" id="loginForgotNote">
                    Reset password belum tersedia lewat halaman ini. Silakan hubungi administrator utama untuk mengganti password akun kamu.
                </div>

                <button type="submit" class="login-submit" id="loginSubmit">
                    <span>Masuk</span> <i class="bi bi-arrow-right"></i>
                </button>
            </form>

            <p class="login-note">Akses ini khusus untuk administrator resmi SMKN 4 Bogor.</p>
        </div>
    </main>
</div>
@endsection

@push('scripts')
<script>
    // Tampilkan / sembunyikan password
    document.getElementById('loginToggle').addEventListener('click', function () {
        const input = document.getElementById('loginPassword');
        const icon = this.querySelector('i');
        const hidden = input.type === 'password';

        input.type = hidden ? 'text' : 'password';
        icon.classList.toggle('bi-eye', !hidden);
        icon.classList.toggle('bi-eye-slash', hidden);
        this.setAttribute('aria-label', hidden ? 'Sembunyikan password' : 'Tampilkan password');
    });

    // Info "Lupa password?"
    document.getElementById('loginForgot').addEventListener('click', function () {
        document.getElementById('loginForgotNote').classList.toggle('is-visible');
    });

    // Cegah klik ganda saat submit
    document.getElementById('loginForm').addEventListener('submit', function () {
        const btn = document.getElementById('loginSubmit');
        btn.classList.add('is-loading');
        btn.querySelector('span').textContent = 'Memproses...';
    });
</script>
@endpush
