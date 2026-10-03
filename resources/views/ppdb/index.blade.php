@extends('layouts.app')

@section('title', 'PPDB - SISK4 Bogor')
@section('meta_description', 'Informasi Penerimaan Peserta Didik Baru (PPDB) SMKN 4 Bogor.')

@section('content')

<section class="ppdb-hero">
    <div class="container text-center text-white">
        <span class="ppdb-hero-tag"><i class="bi bi-lock-fill me-1"></i> PPDB {{ $info->academic_year }} Telah Ditutup</span>
        <h1 class="ppdb-hero-title">Penerimaan Peserta Didik Baru</h1>
        <p class="ppdb-hero-subtitle mx-auto">{{ $info->intro_content }}</p>

        <div class="ppdb-closed-note mt-3">
            <i class="bi bi-info-circle"></i>
            Pendaftaran sudah selesai. Pertanyaan seputar PPDB bisa disampaikan lewat
            <a href="{{ route('contact.index') }}">halaman Kontak</a>.
        </div>
    </div>
</section>

{{-- Jadwal Pendaftaran --}}
<section class="ppdb-section" style="background: var(--sisk4-navy-light);">
    <div class="container">
        <h2 class="profile-section-title text-center">Jadwal Pendaftaran</h2>
        <p class="profile-section-subtitle text-center mx-auto mb-5">
            Perhatikan setiap tahapan dan jadwalnya, jangan sampai terlewat.
        </p>

        <div class="ppdb-timeline">
            @forelse ($schedules as $schedule)
                <div class="ppdb-timeline-item">
                    <div class="ppdb-timeline-marker {{ $schedule->is_current ? 'is-current' : '' }}">
                        <i class="bi {{ $schedule->is_current ? 'bi-play-fill' : 'bi-check' }}"></i>
                    </div>
                    <div class="ppdb-timeline-content">
                        <span class="ppdb-timeline-date">{{ $schedule->date_range }}</span>
                        <h6 class="ppdb-timeline-label">{{ $schedule->label }}</h6>
                        <p class="ppdb-timeline-desc">{{ $schedule->description }}</p>
                    </div>
                </div>
            @empty
                <p class="text-muted text-center">Jadwal PPDB belum diisi.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- Jalur Pendaftaran --}}
<section class="ppdb-section">
    <div class="container">
        <h2 class="profile-section-title text-center">Jalur Pendaftaran</h2>
        <p class="profile-section-subtitle text-center mx-auto mb-5">
            Pilih jalur pendaftaran yang sesuai dengan kondisi calon siswa.
        </p>

        <div class="row g-4">
            @forelse ($pathways as $pathway)
                <div class="col-md-6 col-lg-3">
                    <div class="ppdb-pathway-card h-100">
                        <div class="program-icon program-icon-{{ $pathway->color }}">
                            <i class="bi {{ $pathway->icon ?? 'bi-signpost-2-fill' }}"></i>
                        </div>
                        <h6 class="ppdb-pathway-name">{{ $pathway->name }}</h6>
                        <p class="ppdb-pathway-desc">{{ $pathway->description }}</p>
                        @if ($pathway->quota)
                            <span class="ppdb-pathway-quota"><i class="bi bi-pie-chart-fill"></i> {{ $pathway->quota }}</span>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-muted text-center">Jalur pendaftaran belum diisi.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- Syarat Pendaftaran --}}
<section class="ppdb-section" style="background: var(--sisk4-navy-light);">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-5">
                <h2 class="profile-section-title">Syarat Pendaftaran</h2>
                <p class="profile-section-subtitle">
                    Siapkan berkas-berkas berikut sebelum melakukan pendaftaran, biar prosesnya lancar tanpa bolak-balik.
                </p>
            </div>
            <div class="col-lg-7">
                <div class="mission-card">
                    <ul class="mission-list">
                        @forelse ($info->requirements ?? [] as $item)
                            <li><i class="bi bi-check-circle-fill"></i><span>{{ $item }}</span></li>
                        @empty
                            <li class="text-muted">Syarat pendaftaran belum diisi.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA akhir --}}
<section class="ppdb-cta">
    <div class="container text-center text-white">
        <h2 class="mb-2">Ada Pertanyaan Seputar PPDB?</h2>
        <p class="mx-auto mb-4">
            Pendaftaran tahun ini sudah ditutup. Hubungi panitia untuk informasi PPDB berikutnya.
        </p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            @if ($info->whatsapp_url)
                <a href="{{ $info->whatsapp_url }}" target="_blank" rel="noopener" class="btn btn-hero-light rounded-pill px-4 py-2">
                    <i class="bi bi-whatsapp me-1"></i> {{ $info->contact_whatsapp }}
                </a>
            @endif
            @if ($info->contact_email)
                <a href="mailto:{{ $info->contact_email }}" class="btn btn-hero-outline rounded-pill px-4 py-2">
                    <i class="bi bi-envelope me-1"></i> {{ $info->contact_email }}
                </a>
            @endif
        </div>
    </div>
</section>

@endsection
