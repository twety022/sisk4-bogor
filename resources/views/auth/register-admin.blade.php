@extends('layouts.auth')

@section('title', 'Daftar Admin - SISK4 Bogor')

@section('content')
<div class="login-shell">

    <aside class="login-visual" style="background-image: url('{{ asset('images/hero-students.jpg') }}');">
        <div class="login-visual-overlay"></div>
        <div class="login-visual-inner">
            <span class="login-brand">
                <img src="{{ asset('images/logo-smkn4.png') }}" alt="Logo SMKN 4 Bogor" width="34" height="34" onerror="this.style.display='none'">
                <span>SMK NEGERI 4 BOGOR</span>
            </span>

            <div class="login-visual-copy">
                <h2>Pendaftaran akun administrator.</h2>
                <p>Halaman ini khusus untuk mendaftarkan admin baru SISK4. Kode pendaftaran diberikan oleh admin utama.</p>
            </div>

            <span class="login-visual-foot">&copy; {{ date('Y') }} SMK Negeri 4 Bogor</span>
        </div>
    </aside>

    <main class="login-panel">
        <a href="{{ route('login') }}" class="login-back">
            <i class="bi bi-arrow-left"></i> Ke halaman login
        </a>

        <div class="login-box">
            <span class="login-badge"><i class="bi bi-person-plus-fill"></i> Daftar Administrator</span>
            <h1 class="login-title">Buat Akun Admin</h1>
            <p class="login-desc">Isi data di bawah dan masukkan kode pendaftaran dari admin utama.</p>

            @if (session('success'))
                <div class="login-alert login-alert--ok" role="status">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>{{ session('success') }} Silakan <a href="{{ route('login') }}">masuk</a>.</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="login-alert" role="alert">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form action="{{ route('register.admin.store') }}" method="POST">
                @csrf

                <div class="login-field">
                    <label class="login-label" for="regName">Nama lengkap</label>
                    <div class="login-input-wrap">
                        <i class="bi bi-person"></i>
                        <input type="text" id="regName" name="name" value="{{ old('name') }}" placeholder="Nama admin" autocomplete="name" required autofocus>
                    </div>
                </div>

                <div class="login-field">
                    <label class="login-label" for="regEmail">Email</label>
                    <div class="login-input-wrap">
                        <i class="bi bi-envelope"></i>
                        <input type="email" id="regEmail" name="email" value="{{ old('email') }}" placeholder="Masukkan email" autocomplete="username" required>
                    </div>
                </div>

                <div class="login-field">
                    <label class="login-label" for="regPassword">Password</label>
                    <div class="login-input-wrap">
                        <i class="bi bi-lock"></i>
                        <input type="password" id="regPassword" name="password" placeholder="Minimal 8 karakter" autocomplete="new-password" required>
                    </div>
                </div>

                <div class="login-field">
                    <label class="login-label" for="regConfirm">Ulangi password</label>
                    <div class="login-input-wrap">
                        <i class="bi bi-lock-fill"></i>
                        <input type="password" id="regConfirm" name="password_confirmation" placeholder="Ketik ulang password" autocomplete="new-password" required>
                    </div>
                </div>

                <div class="login-field">
                    <label class="login-label" for="regKode">Kode pendaftaran</label>
                    <div class="login-input-wrap">
                        <i class="bi bi-key"></i>
                        <input type="password" id="regKode" name="kode" placeholder="Kode dari admin utama" autocomplete="off" required>
                    </div>
                </div>

                <button type="submit" class="login-submit">
                    <span>Daftar</span> <i class="bi bi-arrow-right"></i>
                </button>
            </form>

            <p class="login-note">Akun hanya boleh dibuat oleh pihak yang berwenang.</p>
        </div>
    </main>
</div>
@endsection