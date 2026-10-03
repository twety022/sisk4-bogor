@extends('layouts.dashboard')

@section('title', 'Kelola Galeri - SISK4 Admin')
@section('page-title', 'Galeri')

@section('content')

<div class="dash-toolbar">
    <p class="text-muted small mb-0">Total {{ $photos->total() }} foto</p>
    <a href="{{ route('admin.gallery.create') }}" class="dash-btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Foto
    </a>
</div>

<div class="row g-3">
    @forelse ($photos as $photo)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="dash-photo-card">
                <div class="dash-photo-img-wrap">
                    @if ($photo->image_url)
                        <img src="{{ $photo->image_url }}" alt="{{ $photo->caption }}">
                    @else
                        <div class="dash-photo-placeholder"><i class="bi bi-image"></i></div>
                    @endif
                    @if ($photo->show_on_home)
                        <span class="dash-badge dash-badge-success dash-photo-badge">Di Beranda</span>
                    @endif
                </div>
                <div class="dash-photo-body">
                    <span class="dash-photo-caption">{{ $photo->caption }}</span>
                    <span class="dash-badge">{{ $photo->category }}</span>
                    <div class="dash-photo-actions">
                        <a href="{{ route('admin.gallery.edit', $photo) }}" class="dash-action-btn"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.gallery.destroy', $photo) }}" method="POST" onsubmit="return confirm('Yakin mau hapus foto ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="dash-action-btn dash-action-btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12"><p class="text-muted text-center py-5">Belum ada foto galeri.</p></div>
    @endforelse
</div>

<div class="mt-3">{{ $photos->links() }}</div>

@endsection