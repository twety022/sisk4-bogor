@extends('layouts.dashboard')

@section('title', 'Kelola Admin - SISK4 Admin')
@section('page-title', 'Admin')

@section('content')

<div class="dash-toolbar d-flex justify-content-between align-items-center mb-3">
    <div class="d-flex align-items-center gap-3">
        <p class="text-muted small mb-0">Total {{ $admins->count() }} admin aktif</p>
        {{-- Tombol Menuju Halaman Arsip --}}
        <a href="{{ route('admin.admins.archived') }}" class="dash-btn-secondary text-decoration-none">
            <i class="bi bi-archive"></i> Lihat Arsip Admin
        </a>
    </div>

    <button type="button" class="dash-btn-primary" data-bs-toggle="collapse" data-bs-target="#addAdmin">
        <i class="bi bi-person-plus"></i> Tambah Admin
    </button>
</div>

<div class="collapse {{ $errors->any() ? 'show' : '' }} mb-4" id="addAdmin">
    <div class="dash-panel">
        <form action="{{ route('admin.admins.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="dash-label">Nama lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="dash-input @error('name') is-invalid @enderror" required>
                    @error('name') <span class="dash-error">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6">
                    <label class="dash-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="dash-input @error('email') is-invalid @enderror" required>
                    @error('email') <span class="dash-error">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6">
                    <label class="dash-label">Password</label>
                    <input type="password" name="password" class="dash-input @error('password') is-invalid @enderror" required>
                    @error('password') <span class="dash-error">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6">
                    <label class="dash-label">Ulangi password</label>
                    <input type="password" name="password_confirmation" class="dash-input" required>
                </div>
            </div>
            <div class="dash-form-actions mt-3">
                <button type="submit" class="dash-btn-primary"><i class="bi bi-check-lg"></i> Simpan Admin</button>
            </div>
        </form>
    </div>
</div>

<div class="dash-table-wrap">
    <table class="dash-table">
        <thead>
            <tr>
                <th>Admin</th>
                <th>Peran</th>
                <th>Status</th>
                <th>Terdaftar</th>
                <th class="text-end">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($admins as $admin)
                <tr>
                    <td>
                        <span class="dash-table-title d-block">{{ $admin->name }}</span>
                        <small class="text-muted">{{ $admin->email }}</small>
                    </td>
                    <td>
                        @if ($admin->role === 'super_admin')
                            <span class="dash-badge dash-badge-featured">Admin Utama</span>
                        @else
                            <span class="dash-badge">Admin</span>
                        @endif
                    </td>
                    <td>
                        {{-- Menggunakan $admin->blocked sesuai nama kolom di database --}}
                        @if ($admin->blocked)
                            <span class="dash-badge dash-badge-danger">Diblokir</span>
                        @else
                            <span class="dash-badge dash-badge-success">Aktif</span>
                        @endif
                    </td>
                    <td>{{ $admin->created_at?->locale('id')->diffForHumans() }}</td>
                    <td class="text-end">
                        @if ($admin->role !== 'super_admin' && $admin->id !== auth()->id())
                            <form action="{{ route('admin.admins.toggle', $admin) }}" method="POST"
                                  onsubmit="return confirm('Blokir admin ini? Dia akan dipindahkan ke Arsip.');">
                                @csrf 
                                @method('PATCH')
                                <button type="submit" class="dash-btn-danger-outline dash-btn-secondary">
                                    <i class="bi bi-slash-circle"></i> Blokir
                                </button>
                            </form>
                        @else
                            <span class="text-muted small">-</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">Belum ada data admin aktif.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection