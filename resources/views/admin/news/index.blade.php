@extends('layouts.dashboard')

@section('title', 'Kelola Berita - SISK4 Admin')
@section('page-title', 'Berita & Pengumuman')

@section('content')

<div class="dash-toolbar">
    <form action="{{ route('admin.news.index') }}" method="GET" class="dash-search-form">
        <input type="text" name="q" value="{{ $search }}" placeholder="Cari judul berita...">
        <button type="submit"><i class="bi bi-search"></i></button>
    </form>
    <a href="{{ route('admin.news.create') }}" class="dash-btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Berita
    </a>
</div>

<div class="dash-table-wrap">
    <table class="dash-table">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th class="text-end">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($articles as $article)
                <tr>
                    <td>
                        <span class="dash-table-title">{{ $article->title }}</span>
                        @if ($article->is_featured)
                            <span class="dash-badge dash-badge-featured">Featured</span>
                        @endif
                    </td>
                    <td><span class="dash-badge">{{ ucfirst($article->category) }}</span></td>
                    <td>
                        @if ($article->published_at && $article->published_at->isPast())
                            <span class="dash-badge dash-badge-success">Terbit</span>
                        @else
                            <span class="dash-badge dash-badge-muted">Draft/Terjadwal</span>
                        @endif
                    </td>
                    <td class="text-muted small">{{ $article->published_at?->translatedFormat('d M Y') }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.news.edit', $article) }}" class="dash-action-btn" title="Edit"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.news.destroy', $article) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus berita ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="dash-action-btn dash-action-btn-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Belum ada berita.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">{{ $articles->links() }}</div>

@endsection