@extends('layouts.app')

@section('title', 'Tentang Sekolah - SISK4 Bogor')
@section('meta_description', 'Gambaran umum, sambutan kepala sekolah, visi misi, komitmen pendidikan, dan sejarah SMKN 4 Bogor.')

@section('content')

@include('partials.profile.sidebar')

@php
    $wakasek = [
        ['jabatan' => 'Wakasek Kurikulum', 'nama' => null],
        ['jabatan' => 'Wakasek Kesiswaan', 'nama' => null],
        ['jabatan' => 'Wakasek Sarana & Prasarana', 'nama' => null],
        ['jabatan' => 'Wakasek Humas', 'nama' => null],
    ];

    $commitments = [
        ['icon' => 'bi-lightbulb-fill', 'title' => 'Kompetensi', 'text' => 'Mengembangkan keterampilan siswa yang relevan dengan kebutuhan dunia usaha dan industri.'],
        ['icon' => 'bi-person-check-fill', 'title' => 'Karakter & Kreativitas', 'text' => 'Membentuk siswa yang disiplin, bertanggung jawab, kreatif, dan mampu beradaptasi.'],
        ['icon' => 'bi-tools', 'title' => 'Praktik & Teknologi', 'text' => 'Mengutamakan pengalaman belajar melalui praktik dan pemanfaatan teknologi dalam pembelajaran.'],
        ['icon' => 'bi-buildings-fill', 'title' => 'Kemitraan Industri', 'text' => 'Membangun hubungan aktif dengan dunia usaha dan dunia industri untuk mendukung kesiapan siswa.'],
    ];
@endphp

<div class="profile-page py-5">
    <div class="container">
        <div class="profile-content">

            <section id="gambaran-umum" class="profile-section">
                <div class="row align-items-center g-4">
                    <div class="col-lg-7">
                        <h2 class="profile-section-title">Gambaran Umum</h2>
                        <div class="profile-text">
                            @foreach (explode("\n\n", $profile->about_content) as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <img src="{{ $profile->about_image_url }}" alt="Gambaran Umum SMKN 4 Bogor" class="profile-rounded-img">
                    </div>
                </div>
            </section>

            <section id="sambutan-kepala-sekolah" class="profile-section">
                <h2 class="profile-section-title mb-4">Sambutan Kepala Sekolah</h2>

                <div class="principal-message-card">
                    <div class="row align-items-center g-4">
                        <div class="col-md-4 text-center">
                            <img src="{{ $profile->principal_image_url }}" alt="{{ $profile->principal_name }}" class="principal-image">
                            <h5 class="principal-name mt-3 mb-1">{{ $profile->principal_name }}</h5>
                            <span class="principal-position">Kepala SMK Negeri 4 Bogor</span>
                        </div>

                        <div class="col-md-8">
                            <div class="principal-quote-icon">
                                <i class="bi bi-quote"></i>
                            </div>
                            <div class="profile-text principal-message">
                                @foreach (explode("\n\n", $profile->principal_message) as $paragraph)
                                    <p>{{ $paragraph }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="visi-misi" class="profile-section">
                <h2 class="profile-section-title mb-4">Visi & Misi</h2>

                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="vision-card h-100">
                            <div class="vision-icon"><i class="bi bi-eye-fill"></i></div>
                            <h6 class="vision-title">Visi</h6>
                            <p class="vision-text">{{ $profile->vision }}</p>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mission-card h-100">
                            <div class="mission-icon"><i class="bi bi-compass-fill"></i></div>
                            <h6 class="mission-title">Misi</h6>
                            <ul class="mission-list">
                                @forelse ($profile->mission ?? [] as $item)
                                    <li>
                                        <i class="bi bi-check-circle-fill"></i>
                                        <span>{{ $item }}</span>
                                    </li>
                                @empty
                                    <li class="text-muted">Misi sekolah belum diisi.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <section id="komitmen-pendidikan" class="profile-section">
                <div class="commitment-header mb-4">
                    <span class="commitment-eyebrow">
                        <i class="bi bi-mortarboard-fill"></i>
                        Komitmen Sekolah
                    </span>
                    <h2 class="profile-section-title mb-2">Komitmen Pendidikan</h2>
                    <p class="commitment-intro">
                        Membangun pendidikan yang relevan, berkarakter, dan dekat dengan kebutuhan dunia kerja.
                    </p>
                </div>

                <div class="row g-3">
                    @foreach ($commitments as $item)
                        <div class="col-md-6">
                            <div class="commitment-card">
                                <div class="commitment-icon"><i class="bi {{ $item['icon'] }}"></i></div>
                                <div>
                                    <h5>{{ $item['title'] }}</h5>
                                    <p>{{ $item['text'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <section id="fasilitas" class="profile-section">
                <h2 class="profile-section-title">Fasilitas Sekolah</h2>
                <p class="profile-section-subtitle mb-4">Sarana yang menunjang kegiatan belajar dan praktik siswa.</p>

                <div class="facility-secondary-grid">
                    @foreach ($facilities as $facility)
                        <div class="facility-small-card">
                            <div class="facility-small-media">
                                @if ($facility->image_url)
                                    <img src="{{ $facility->image_url }}" alt="{{ $facility->name }}" class="facility-small-image">
                                @else
                                    <div class="facility-small-placeholder"><i class="bi bi-building"></i></div>
                                @endif
                            </div>
                            <div class="facility-small-content">
                                <h3 class="facility-small-title">{{ $facility->name }}</h3>
                                <p class="facility-small-subtitle">{{ $facility->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <section id="struktur" class="profile-section">
                <h2 class="profile-section-title mb-4">Struktur Organisasi</h2>

                <div class="org-top">
                    <div class="org-card org-card--head">
                        <span>Kepala Sekolah</span>
                        <strong>{{ $profile->principal_name }}</strong>
                    </div>
                </div>

                <div class="org-grid">
                    @foreach ($wakasek as $item)
                        <div class="org-card">
                            <span>{{ $item['jabatan'] }}</span>
                            <strong>{{ $item['nama'] ?? '-' }}</strong>
                        </div>
                    @endforeach
                </div>
            </section>

            <section id="sejarah" class="profile-section">
                <h2 class="profile-section-title mb-4">Sejarah Sekolah</h2>

                <div class="row align-items-center g-4">
                    <div class="col-lg-5">
                        <img src="{{ $profile->history_image_url }}" alt="Sejarah SMKN 4 Bogor" class="profile-rounded-img">
                    </div>
                    <div class="col-lg-7">
                        <div class="profile-text">
                            @foreach (explode("\n\n", $profile->history_content) as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>

@endsection