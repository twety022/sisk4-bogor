@extends('layouts.app')

@section('title', 'Fasilitas - SISK4 Bogor')
@section('meta_description', 'Fasilitas penunjang pembelajaran dan kegiatan siswa di SMKN 4 Bogor.')

@section('content')

<div class="profile-page py-5">
    <div class="container">

        <div class="row g-4">

            {{-- SIDEBAR --}}
            <div class="col-lg-3">
                @include('partials.profile.sidebar')
            </div>


            {{-- CONTENT --}}
            <div class="col-lg-9">

                {{-- INTRO --}}
                <section class="facility-intro mb-5">

                    <span class="facility-eyebrow">
                        <i class="bi bi-building-fill"></i>
                        Lingkungan Sekolah
                    </span>

                    <h1 class="profile-section-title mb-3">
                        Fasilitas
                    </h1>

                    <p class="profile-section-subtitle mb-0">
                        Berbagai fasilitas disediakan untuk mendukung kegiatan
                        pembelajaran, praktik keahlian, pengembangan diri,
                        dan aktivitas siswa di SMK Negeri 4 Bogor.
                    </p>

                </section>

                @forelse ($facilities as $facility)

                    @if ($loop->first)

                        <section
                            id="fasilitas-{{ $loop->iteration }}"
                            class="facility-feature mb-5"
                        >

                            <div class="facility-feature-media">

                                @if ($facility->image_url)

                                    <img
                                        src="{{ $facility->image_url }}"
                                        alt="{{ $facility->title }}"
                                        class="facility-feature-image"
                                    >

                                @else

                                    <div class="facility-feature-placeholder facility-icon-{{ $facility->color }}">
                                        <i class="bi {{ $facility->icon ?? 'bi-building-fill' }}"></i>
                                    </div>

                                @endif

                            </div>


                            <div class="facility-feature-content">

                                <div class="facility-icon facility-icon-{{ $facility->color }}">
                                    <i class="bi {{ $facility->icon ?? 'bi-building-fill' }}"></i>
                                </div>

                                <span class="facility-feature-label">
                                    Fasilitas Utama
                                </span>

                                <h2 class="facility-feature-title">
                                    {{ $facility->title }}
                                </h2>

                                <p class="facility-feature-subtitle">
                                    {{ $facility->subtitle }}
                                </p>

                                <div class="facility-feature-line"></div>

                                <p class="facility-feature-description">
                                    Ruang yang mendukung kegiatan belajar siswa
                                    agar berlangsung dengan nyaman, tertib,
                                    dan kondusif.
                                </p>

                            </div>

                        </section>

                    @endif

                @empty

                    <div class="py-5 text-center">
                        <p class="text-muted mb-0">
                            Belum ada data fasilitas.
                        </p>
                    </div>

                @endforelse

                @if ($facilities->count() > 1)

                    <section class="facility-secondary-section">

                        <div class="facility-secondary-heading mb-4">

                            <span class="facility-eyebrow">
                                <i class="bi bi-grid-1x2-fill"></i>
                                Fasilitas Pendukung
                            </span>

                            <h2 class="profile-section-title mb-2">
                                Ruang untuk Belajar & Berkembang
                            </h2>

                            <p class="profile-section-subtitle">
                                Fasilitas lain yang melengkapi kegiatan akademik,
                                praktik, ibadah, olahraga, dan kebutuhan siswa.
                            </p>

                        </div>


                        <div class="facility-secondary-grid">

                            @foreach ($facilities->skip(1) as $facility)

                                <article
                                    id="fasilitas-{{ $loop->iteration + 1 }}"
                                    class="facility-small-card"
                                >

                                    <div class="facility-small-media">

                                        @if ($facility->image_url)

                                            <img
                                                src="{{ $facility->image_url }}"
                                                alt="{{ $facility->title }}"
                                                class="facility-small-image"
                                            >

                                        @else

                                            <div class="facility-small-placeholder facility-icon-{{ $facility->color }}">
                                                <i class="bi {{ $facility->icon ?? 'bi-building-fill' }}"></i>
                                            </div>

                                        @endif

                                    </div>


                                    <div class="facility-small-content">

                                        <div class="facility-icon facility-icon-{{ $facility->color }} facility-icon-small">
                                            <i class="bi {{ $facility->icon ?? 'bi-building-fill' }}"></i>
                                        </div>

                                        <h3 class="facility-small-title">
                                            {{ $facility->title }}
                                        </h3>

                                        <p class="facility-small-subtitle">
                                            {{ $facility->subtitle }}
                                        </p>

                                    </div>

                                </article>

                            @endforeach

                        </div>

                    </section>

                @endif

            </div>

        </div>

    </div>
</div>

@endsection