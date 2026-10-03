@extends('layouts.dashboard')

@section('title', 'Dashboard - SISK4 Admin')
@section('page-title', 'Dashboard')

@section('content')

@php
    $statusMeta = [
    'tersedia'   => ['label' => 'Tersedia',       'color' => '#34d399'],
    'pesanan'    => ['label' => 'Terima Pesanan', 'color' => '#fbbf24'],
    'portofolio' => ['label' => 'Portofolio',     'color' => '#7c9dff'],
];

    // Donut produk: hitung potongan conic-gradient
    $total = max(1, $totalProducts);
    $stops = []; $acc = 0;
    foreach ($statusMeta as $key => $meta) {
        $pct = (($productStatus[$key] ?? 0) / $total) * 100;
        $stops[] = "{$meta['color']} {$acc}% " . ($acc + $pct) . '%';
        $acc += $pct;
    }
    $donut = $totalProducts ? implode(', ', $stops) : '#e7ecf5 0% 100%';
@endphp

{{-- Banner sapaan --}}
<div class="dx-banner">
    <div>
        <span class="dx-banner__date">{{ now()->locale('id')->translatedFormat('l, d F Y') }}</span>
        <h3 class="dx-banner__title">Halo, {{ auth()->user()->name }}!</h3>
        <p class="dx-banner__text">Berikut ringkasan aktivitas website SISK4 hari ini.</p>
    </div>
    <a href="{{ route('admin.messages.index') }}" class="dx-banner__pill">
        <i class="bi bi-envelope-fill"></i>
        {{ $unreadMessages }} pesan belum dibaca
    </a>
</div>

{{-- Kartu statistik --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="dx-stat dx-stat--blue">
            <i class="bi bi-newspaper dx-stat__icon"></i>
            <span class="dx-stat__label">Total Berita</span>
            <span class="dx-stat__value">{{ number_format($totalNews) }}</span>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="dx-stat dx-stat--navy">
            <i class="bi bi-images dx-stat__icon"></i>
            <span class="dx-stat__label">Foto Galeri</span>
            <span class="dx-stat__value">{{ number_format($totalGallery) }}</span>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="dx-stat dx-stat--rose">
            <i class="bi bi-heart-fill dx-stat__icon"></i>
            <span class="dx-stat__label">Total Like Galeri</span>
            <span class="dx-stat__value">{{ number_format($totalLikes) }}</span>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="dx-stat dx-stat--green">
            <i class="bi bi-box-seam-fill dx-stat__icon"></i>
            <span class="dx-stat__label">Produk Siswa</span>
            <span class="dx-stat__value">{{ number_format($totalProducts) }}</span>
        </div>
    </div>
</div>

{{-- Foto terpopuler + donut produk --}}
<div class="row g-3 mb-4">
    <div class="col-lg-7">
        <div class="dx-panel h-100">
            <div class="dx-panel__head">
                <h6>Foto Galeri Terpopuler</h6>
                <a href="{{ route('admin.gallery.index') }}">Kelola Galeri</a>
            </div>

            @forelse ($topPhotos as $i => $photo)
                <div class="dx-rank">
                    <span class="dx-rank__no">{{ $i + 1 }}</span>
                    @if ($photo->image_url)
                        <img src="{{ $photo->image_url }}" alt="" class="dx-rank__img">
                    @else
                        <div class="dx-rank__img dx-rank__img--empty"><i class="bi bi-image"></i></div>
                    @endif
                    <div class="dx-rank__body">
                        <div class="dx-rank__top">
                            <span class="dx-rank__title">{{ $photo->caption ?: 'Tanpa judul' }}</span>
                            <span class="dx-rank__likes"><i class="bi bi-heart-fill"></i> {{ number_format($photo->likes) }}</span>
                        </div>
                        <div class="dx-bar"><span style="width: {{ ($photo->likes / $maxLikes) * 100 }}%"></span></div>
                    </div>
                </div>
            @empty
                <p class="text-muted small mb-0">Belum ada foto yang mendapat like.</p>
            @endforelse
        </div>
    </div>

    <div class="col-lg-5">
        <div class="dx-panel h-100">
            <div class="dx-panel__head">
                <h6>Status Produk</h6>
            </div>
            <div class="dx-donut-wrap">
                <div class="dx-donut" style="background: conic-gradient({{ $donut }});">
                    <div class="dx-donut__hole">
                        <strong>{{ $totalProducts }}</strong>
                        <span>Produk</span>
                    </div>
                </div>
                <ul class="dx-legend">
                    @foreach ($statusMeta as $key => $meta)
                        <li>
                            <span class="dx-legend__dot" style="background: {{ $meta['color'] }}"></span>
                            {{ $meta['label'] }}
                            <strong>{{ $productStatus[$key] ?? 0 }}</strong>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

{{-- Daftar terbaru --}}
<div class="row g-3">
    <div class="col-lg-4">
        <div class="dx-panel h-100">
            <div class="dx-panel__head">
                <h6>Berita Terbaru</h6>
                <a href="{{ route('admin.news.index') }}">Lihat Semua</a>
            </div>
            @forelse ($latestNews as $item)
                <div class="dash-list-row">
                    <span>{{ $item->title }}</span>
                    <span class="dash-list-date">{{ $item->created_at->diffForHumans() }}</span>
                </div>
            @empty
                <p class="text-muted small mb-0">Belum ada berita.</p>
            @endforelse
        </div>
    </div>

    <div class="col-lg-4">
        <div class="dx-panel h-100">
            <div class="dx-panel__head">
                <h6>Pesan Masuk Terbaru</h6>
                <a href="{{ route('admin.messages.index') }}">Lihat Semua</a>
            </div>
            @forelse ($latestMessages as $item)
                <a href="{{ route('admin.messages.show', $item) }}" class="dash-list-row dash-list-row-link">
                    <span>{{ $item->name }} — {{ $item->subject }} @if (!$item->is_read) <span class="dash-dot-unread"></span> @endif</span>
                    <span class="dash-list-date">{{ $item->created_at->diffForHumans() }}</span>
                </a>
            @empty
                <p class="text-muted small mb-0">Belum ada pesan masuk.</p>
            @endforelse
        </div>
    </div>

    <div class="col-lg-4">
        <div class="dx-panel h-100">
            <div class="dx-panel__head">
                <h6>Produk Terbaru</h6>
                <a href="{{ route('admin.products.index') }}">Kelola Produk</a>
            </div>
            @forelse ($latestProducts as $product)
                @php $st = $product->sale_status ?? 'portofolio'; @endphp
                <div class="dash-list-row">
                    <span>
                        {{ $product->title }}
                        <small class="d-block text-muted">{{ $product->program?->code }} {{ $product->year ? '· ' . $product->year : '' }}</small>
                    </span>
                    <span class="dx-chip" style="--chip: {{ $statusMeta[$st]['color'] ?? '#0d2a5c' }}">
                        {{ $statusMeta[$st]['label'] ?? 'Portofolio' }}
                    </span>
                </div>
            @empty
                <p class="text-muted small mb-0">Belum ada produk.</p>
            @endforelse
        </div>
    </div>
</div>

@endsection