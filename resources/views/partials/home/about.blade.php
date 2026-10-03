@php
    $slides = $galleryPhotos->take(3)->map(fn ($p) => $p->image_url)->filter()->values()->all();
    while (count($slides) < 3) {
        $slides[] = asset('images/hero-students.JPG');
    }
@endphp

<section class="about-section" id="kepala-sekolah"> 
    <div class="container">
        <div class="row align-items-center g-5">

            <div class="col-lg-6">
                <div class="photo-stack" id="photoStack">
                    @foreach ($slides as $i => $src)
                        <img src="{{ $src }}" alt="Kegiatan SMKN 4 Bogor"
                             class="photo-stack__item" data-pos="{{ $i }}">
                    @endforeach
                </div>
            </div>

            <div class="col-lg-6">
                <h2 class="section-title">
                    Apa itu <span class="text-higlight">SISK4 Bogor?</span>
                </h2>
                <p class="section-subtitle">
                    SISK4 Bogor adalah Sistem informasi resmi SMKN 4 Bogor yang memudahkan siswa, orang tua,
                    dan masyarakat mengakses berita, prestasi, fasilitas, hingga galeri kegiatan sekolah
                    dalam satu tempat.
                </p>
            </div>
        </div>

        @if ($profile)
            <a href="{{ route('profile.tentang') }}" class="principal-card">
                <div class="principal-card__text">
                    <h5 class="principal-card__title">Sapaan hangat dari kepala sekolah</h5>
                    <p class="principal-card__msg">
                        {{ Str::limit(strip_tags($profile->principal_message), 220) }}
                    </p>
                    <span class="principal-card__link">
                        Kenali lebih banyak profil sekolah <i class="bi bi-arrow-right"></i>
                    </span>
                </div>
                <div class="principal-card__photo">
                    <img src="{{ $profile->principal_image_url }}" alt="{{ $profile->principal_name }}">
                    <small>
                        <strong>{{ $profile->principal_name }}</strong><br>
                        Kepala SMKN 4 Bogor
                    </small>
                </div>
            </a>
        @endif
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const stack = document.getElementById('photoStack');
        if (!stack) return;

        const items = stack.querySelectorAll('.photo-stack__item');
        const total = items.length;
        if (total < 2) return;

        let current = 0;
        let timer = null;

        const render = () => items.forEach((el, i) => {
            el.dataset.pos = (i - current + total) % total;
        });
        const start = () => {
            timer = setInterval(() => { current = (current + 1) % total; render(); }, 2000);
        };

        start();
        stack.addEventListener('mouseenter', () => clearInterval(timer));
        stack.addEventListener('mouseleave', start);
    });
</script>
@endpush