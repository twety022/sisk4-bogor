@extends('layouts.dashboard')

@section('title', 'Pesan Masuk - SISK4 Admin')
@section('page-title', 'Pesan Masuk')

@section('content')

<div class="dash-table-wrap">
    <table class="dash-table">
        <thead>
            <tr>
                <th>Pengirim</th>
                <th>Subjek</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th class="text-end">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($messages as $message)
                <tr class="{{ !$message->is_read ? 'dash-row-unread' : '' }}">
                    <td>
                        <span class="dash-table-title">{{ $message->name }}</span>
                        <span class="d-block text-muted small">{{ $message->email }}</span>
                    </td>
                    <td>{{ $message->subject }}</td>
                    <td class="text-muted small">{{ $message->created_at->diffForHumans() }}</td>
                    <td>
                        @if ($message->is_read)
                            <span class="dash-badge dash-badge-muted">Dibaca</span>
                        @else
                            <span class="dash-badge dash-badge-success">Baru</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.messages.show', $message) }}" class="dash-action-btn" title="Lihat"><i class="bi bi-eye"></i></a>
                        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus pesan ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="dash-action-btn dash-action-btn-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Belum ada pesan masuk.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">{{ $messages->links() }}</div>

@endsection