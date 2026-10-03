<footer class="footer-sisk4">
    <div class="container py-5">
        <div class="row gy-4">
            <div class="col-lg-4">
                <h6 class="footer-brand mb-3">SMK NEGERI 4 BOGOR</h6>
                <p class="text-white-50 mb-3">
                    Mencetak lulusan berkualitas yang siap kerja, berjiwa wirausaha,
                    dan berkarakter melalui pendidikan kejuruan yang unggul.
                </p>
                <div class="d-flex gap-2">
                    <a href="#" class="social-icon" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-6">
                <h6 class="footer-heading mb-3">Tautan Cepat</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('profile.tentang') }}">Profil Sekolah</a></li>
                    <li><a href="{{ route('gallery') }}">Galeri</a></li>
                    <li><a href="{{ route('news.index') }}">Berita</a></li>
                    <li><a href="{{ route('contact.index') }}">Kontak</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-6">
                <h6 class="footer-heading mb-3">Kontak</h6>
                <ul class="list-unstyled footer-links footer-contact">
                    <li><i class="bi bi-geo-alt"></i><span>Jl. Raya Tajur, Kampung Buntar, RT 02 / RW 08, Kelurahan Muarasari, Kecamatan Bogor Selatan, Kota Bogor, Jawa Barat 16137.</span></li>
                    <li><i class="bi bi-telephone"></i><span>(0251) 7547381</span></li>
                    <li><i class="bi bi-envelope"></i><span>smkn4@smkn4bogor.sch.id</span></li>
                </ul>
            </div>
        </div>

        <hr class="footer-divider">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <p class="text-white-50 small mb-0">
                &copy; {{ date('Y') }} SMK Negeri 4 Bogor. Seluruh hak cipta dilindungi.
            </p>
            <div class="d-flex gap-3">
                <a href="#" class="footer-bottom-link">Kebijakan Privasi</a>
                <a href="#" class="footer-bottom-link">Syarat & Ketentuan</a>
            </div>
        </div>
    </div>
</footer>
