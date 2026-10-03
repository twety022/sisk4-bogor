@extends('layouts.app')

@section('title', 'Kontak - SISK4 Bogor')
@section('meta_description', 'Hubungi SMKN 4 Bogor: alamat, telepon, email, dan form kontak.')

@section('content')

<section class="contact-hero">
    <div class="container text-center text-white">
        <h1 class="contact-hero-title">Hubungi Kami</h1>
        <p class="contact-hero-subtitle mx-auto">
            Ada pertanyaan seputar sekolah, pendaftaran, atau kerja sama? Jangan ragu untuk menghubungi kami.
        </p>
    </div>
</section>

<section class="contact-section">
    <div class="container">

        {{-- Notifikasi sukses kirim pesan --}}
        @if (session('success'))
            <div class="alert alert-success-custom">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="row g-4">

            {{-- Info kontak --}}
            <div class="col-lg-5">
                <div class="contact-info-card h-100">
                    <h5 class="mb-4">Informasi Kontak</h5>

                    <ul class="location-info-list mb-4">
                        <li>
                            <div class="location-icon"><i class="bi bi-geo-alt-fill"></i></div>
                            <div>
                                <span class="location-label">Alamat</span>
                                <span class="location-value">{{ $info->address }}</span>
                            </div>
                        </li>
                        @if ($info->phone)
                            <li>
                                <div class="location-icon"><i class="bi bi-telephone-fill"></i></div>
                                <div>
                                    <span class="location-label">Telepon</span>
                                    <span class="location-value">{{ $info->phone }}</span>
                                </div>
                            </li>
                        @endif
                        @if ($info->email)
                            <li>
                                <div class="location-icon"><i class="bi bi-envelope-fill"></i></div>
                                <div>
                                    <span class="location-label">Email</span>
                                    <span class="location-value">{{ $info->email }}</span>
                                </div>
                            </li>
                        @endif
                        @if ($info->office_hours)
                            <li>
                                <div class="location-icon"><i class="bi bi-clock-fill"></i></div>
                                <div>
                                    <span class="location-label">Jam Operasional</span>
                                    <span class="location-value">{{ $info->office_hours }}</span>
                                </div>
                            </li>
                        @endif
                    </ul>

                    @if ($info->whatsapp_url)
                        <a href="{{ $info->whatsapp_url }}" target="_blank" rel="noopener" class="btn btn-brand-navbar rounded-pill px-4 mb-4">
                            <i class="bi bi-whatsapp me-1"></i> Chat via WhatsApp
                        </a>
                    @endif

                    @if ($info->instagram_url || $info->facebook_url || $info->youtube_url || $info->tiktok_url)
                        <div>
                            <span class="location-label d-block mb-2">Ikuti Kami</span>
                            <div class="d-flex gap-2">
                                @if ($info->instagram_url)
                                    <a href="{{ $info->instagram_url }}" target="_blank" rel="noopener" class="social-icon" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                                @endif
                                @if ($info->facebook_url)
                                    <a href="{{ $info->facebook_url }}" target="_blank" rel="noopener" class="social-icon" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                                @endif
                                @if ($info->youtube_url)
                                    <a href="{{ $info->youtube_url }}" target="_blank" rel="noopener" class="social-icon" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                                @endif
                                @if ($info->tiktok_url)
                                    <a href="{{ $info->tiktok_url }}" target="_blank" rel="noopener" class="social-icon" aria-label="TikTok"><i class="bi bi-tiktok"></i></a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Form kontak --}}
            <div class="col-lg-7">
                <div class="contact-form-card">
                    <h5 class="mb-4">Kirim Pesan</h5>

                    <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="contact-form-label">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="contact-form-input @error('name') is-invalid @enderror" placeholder="Nama kamu">
                                @error('name') <span class="contact-form-error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="contact-form-label">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="contact-form-input @error('email') is-invalid @enderror" placeholder="nama@email.com">
                                @error('email') <span class="contact-form-error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="contact-form-label">No. Telepon (opsional)</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="contact-form-input" placeholder="0812xxxxxxxx">
                            </div>
                            <div class="col-md-6">
                                <label class="contact-form-label">Subjek</label>
                                <input type="text" name="subject" value="{{ old('subject') }}" class="contact-form-input @error('subject') is-invalid @enderror" placeholder="Tentang apa pesan ini?">
                                @error('subject') <span class="contact-form-error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-12">
                                <label class="contact-form-label">Pesan</label>
                                <textarea name="message" rows="5" class="contact-form-input @error('message') is-invalid @enderror" placeholder="Tulis pesan kamu di sini...">{{ old('message') }}</textarea>
                                @error('message') <span class="contact-form-error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-brand-navbar rounded-pill px-4 mt-3">
                            Kirim Pesan <i class="bi bi-send-fill ms-1"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>{{-- akhir row --}}

        {{-- Map selebar penuh di bawah --}}
        @if ($info->map_embed_url)
            <div class="contact-map mt-4">
                <iframe src="{{ $info->map_embed_url }}" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
            </div>
        @endif

    </div>
</section>

@endsection