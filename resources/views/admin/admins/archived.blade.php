@extends('layouts.dashboard')

@section('title', 'Arsip Admin - SISK4 Admin')
@section('page-title', 'Arsip Admin')

@section('content')

<div class="dash-toolbar d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('admin.admins.index') }}" class="dash-btn-secondary text-decoration-none">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Admin
    </a>
    <p class="text-muted small mb-0">Total {{ $admins->count() }} admin terarsip</p>
</div>

<div class="dash-table-wrap">
    <table class="dash-table">
        <thead>
            <tr>
                <th>Admin</th>
                <th>Peran</th>
                <th>Status</th>
                <th>Terarsip</th>
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
                        <span class="dash-badge">Admin</span>
                    </td>
                    <td>
                        <span class="dash-badge dash-badge-danger">Diblokir</span>
                    </td>
                    <td>{{ $admin->updated_at?->locale('id')->diffForHumans() }}</td>
                    <td class="text-end">
                        <div class="d-flex justify-content-end gap-2">
                            {{-- Form Unblock --}}
                            <form action="{{ route('admin.admins.toggle', $admin) }}" method="POST"
                                  onsubmit="return confirm('Buka blokir admin ini? Akun akan kembali aktif.');">
                                @csrf 
                                @method('PATCH')
                                <button type="submit" class="dash-btn-primary">
                                    <i class="bi bi-unlock"></i> Unblock
                                </button>
                            </form>

                            {{-- Form Hapus Permanen --}}
                            <form action="{{ route('admin.admins.destroy', $admin) }}" method="POST"
                                  onsubmit="return confirm('Hapus admin ini secara permanen? Data tidak dapat dikembalikan.');">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="dash-btn-danger-outline dash-btn-secondary">
                                    <i class="bi bi-trash"></i> Hapus Permanen
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">Tidak ada admin yang diarsip/diblokir.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection