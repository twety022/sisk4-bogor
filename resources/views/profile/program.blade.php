@extends('layouts.app')

@section('title', 'Program Keahlian - SISK4 Bogor')
@section('meta_description', 'Pilihan program keahlian (jurusan) di SMKN 4 Bogor.')

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
                <section class="program-intro mb-5">

                    <span class="program-eyebrow">
                        <i class="bi bi-mortarboard-fill"></i>
                        Program Keahlian
                    </span>

                    <h1 class="profile-section-title mb-3">
                        Kenali Program Keahlian Kami
                    </h1>

                    <p class="profile-section-subtitle mb-0">
                        SMK Negeri 4 Bogor menyediakan program keahlian
                        yang dirancang untuk membekali peserta didik dengan
                        kompetensi sesuai perkembangan dunia usaha dan dunia industri.
                    </p>

                </section>


                {{-- PROGRAM KEAHLIAN --}}
                <section class="program-list">

                    @forelse ($programs as $program)

                        @php
                            $programId = 'program-' . strtolower($program->code);
                            $isReverse = $loop->iteration % 2 === 0;
                        @endphp

                        <article
                            id="{{ $programId }}"
                            class="program-feature {{ $isReverse ? 'program-feature-reverse' : '' }}"
                        >

                            {{-- TEXT --}}
                            <div class="program-feature-content">

                                

                                <span class="program-feature-code">
                                    {{ $program->code }}
                                </span>

                                <h2 class="program-feature-title">
                                    {{ $program->name }}
                                </h2>

                                <div class="program-feature-line"></div>

                                <p class="program-feature-description">
                                    {{ $program->description }}
                                </p>

                            </div>


                            {{-- IMAGE --}}
                            <div class="program-feature-media">

                                @if ($program->image_url)

                                    <img
                                        src="{{ $program->image_url }}"
                                        alt="{{ $program->name }}"
                                        class="program-feature-image"
                                    >

                                @else

                                    <div class="program-feature-placeholder program-icon-{{ $program->color ?? 'blue' }}">
                                        <i class="bi {{ $program->icon ?? 'bi-mortarboard-fill' }}"></i>
                                    </div>

                                @endif

                            </div>

                        </article>

                    @empty

                        <div class="py-5 text-center">
                            <p class="text-muted mb-0">
                                Belum ada data program keahlian.
                            </p>
                        </div>

                    @endforelse

                </section>

            </div>

        </div>

    </div>
</div>

@endsection