<section class="hv-hero">
    <div class="container">
        <div class="hv-hero__content">
            <span class="hv-eyebrow">SMK Negeri 4 Kota Bogor</span>
            <h1 class="hv-title">
                Unggul dalam prestasi,
                <span class="hv-em">berkarakter</span> dan adaptif
            </h1>
            <p class="hv-lead">
                Portal informasi resmi SMKN 4 Bogor: kabar sekolah, prestasi,
                karya siswa, dan informasi pendaftaran dalam satu tempat.
            </p>
            <div class="d-flex flex-wrap gap-3">
                <a href="#berita" class="hv-btn hv-btn--gold">Lihat Berita <i class="bi bi-arrow-down"></i></a>
                <a href="{{ route('contact.index') }}" class="hv-btn hv-btn--outline">Hubungi Kami</a>
            </div>
        </div>
    </div>
</section>

<section class="hv-cards">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <a href="{{ route('news.index') }}" class="hv-card">
                    <span class="hv-card__icon"><i class="bi bi-trophy-fill"></i></span>
                    <h3>Prestasi</h3>
                    <p>Berbagai penghargaan diraih siswa-siswi kami di tingkat kota hingga nasional.</p>
                    <span class="hv-card__go">Baca kabar terbaru <i class="bi bi-arrow-right"></i></span>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('profile.tentang') }}#fasilitas" class="hv-card">
                    <span class="hv-card__icon"><i class="bi bi-building"></i></span>
                    <h3>Fasilitas</h3>
                    <p>Fasilitas lengkap dan modern menunjang kegiatan belajar-mengajar siswa.</p>
                    <span class="hv-card__go">Kenali sekolah <i class="bi bi-arrow-right"></i></span>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('profile.program') }}" class="hv-card">
                    <span class="hv-card__icon"><i class="bi bi-mortarboard-fill"></i></span>
                    <h3>Jurusan</h3>
                    <p>Beragam pilihan jurusan kejuruan yang relevan dengan kebutuhan industri.</p>
                    <span class="hv-card__go">Lihat program <i class="bi bi-arrow-right"></i></span>
                </a>
            </div>
        </div>
    </div>
</section>