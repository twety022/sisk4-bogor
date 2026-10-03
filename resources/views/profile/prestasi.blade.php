@extends('layouts.app')

@section('title', 'Prestasi - SISK4 Bogor')
@section('meta_description', 'Prestasi siswa-siswi SMKN 4 Bogor.')

@section('content')

<section class="prestasi-hero">
    <div class="container text-center">
        <span class="prestasi-eyebrow"><i class="bi bi-trophy-fill"></i> Pencapaian Siswa</span>
        <h1 class="prestasi-hero-title">Prestasi</h1>
        <p class="prestasi-hero-subtitle mx-auto">
            Berbagai pencapaian siswa-siswi SMK Negeri 4 Bogor dalam bidang akademik,
            kompetensi, olahraga, dan kegiatan ekstrakurikuler.
        </p>
    </div>
</section>

<section class="prestasi-section">
    <div class="container">
        <div class="row g-4">
            @forelse ($achievements as $achievement)
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="prestasi-card h-100">
                        <div class="prestasi-card-img-wrap">
                            @if ($achievement->image_url)
                                <img src="{{ $achievement->image_url }}" alt="{{ $achievement->title }}" class="prestasi-card-img">
                            @else
                                <div class="prestasi-card-placeholder">
                                    <i class="bi bi-trophy-fill"></i>
                                </div>
                            @endif
                        </div>
                        <div class="prestasi-card-body">
                            <h6 class="prestasi-card-title">{{ $achievement->title }}</h6>
                            <p class="prestasi-card-subtitle">{{ $achievement->subtitle }}</p>
                            <span class="prestasi-card-meta"><i class="bi bi-geo-alt"></i> {{ $achievement->meta }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted text-center py-5 mb-0">Belum ada data prestasi.</p>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('news.index') }}" class="btn btn-cta-pill">
                Lihat Berita & Pengumuman <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</section>

@endsection