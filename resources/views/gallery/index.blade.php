@extends('layouts.app')

@section('title', 'Galeri Sekolah - SISK4 Bogor')
@section('meta_description', 'Galeri foto kegiatan, fasilitas, prestasi, dan momen siswa SMKN 4 Bogor.')

@section('content')

<section class="gallery-hero">
    <div class="container text-center">
        <h1 class="gallery-hero-title">Galeri Sekolah</h1>
        <p class="gallery-hero-subtitle mx-auto">
            Menelusuri setiap momen berharga, prestasi gemilang, dan fasilitas unggulan
            di SMK Negeri 4 Kota Bogor.
        </p>
    </div>
</section>

<section class="gallery-filter-section">
    <div class="container">
        <div class="gallery-filter-row" id="galleryFilter">
            <button type="button" class="filter-pill active" data-filter="semua">Semua</button>
            @foreach ($categories as $key => $label)
                <button type="button" class="filter-pill" data-filter="{{ $key }}">{{ $label }}</button>
            @endforeach
        </div>
    </div>
</section>

<section class="gallery-grid-section">
    <div class="container">
        <div class="gallery-masonry" id="galleryMasonry">
            @forelse ($photos as $photo)
    <div class="gallery-masonry-item" data-category="{{ $photo->category }}" data-id="{{ $photo->id }}">
        <button type="button" class="gallery-masonry-btn"
            data-id="{{ $photo->id }}"
            data-full="{{ $photo->image_url ?? '' }}"
            data-caption="{{ $photo->caption }}"
            data-description="{{ $photo->description }}"
            data-date="{{ $photo->taken_at?->locale('id')->translatedFormat('d F Y') }}"
            data-category-label="{{ $categories[$photo->category] ?? ucfirst($photo->category) }}">
            @if ($photo->image_url)
                <img src="{{ $photo->image_url }}" alt="{{ $photo->caption }}">
            @else
                <div class="gallery-masonry-placeholder"><i class="bi bi-image"></i></div>
            @endif
            <span class="gallery-masonry-overlay">
                <i class="bi bi-zoom-in"></i>
                <span>{{ $photo->caption }}</span>
            </span>
        </button>

        <div class="gallery-card-actions">
            <button type="button" class="action-pill js-like" data-id="{{ $photo->id }}" aria-label="Suka">
                <i class="bi bi-heart"></i> <span class="js-like-count">{{ $photo->likes ?? 0 }}</span>
            </button>
            <button type="button" class="action-pill js-share" data-id="{{ $photo->id }}" aria-label="Bagikan">
                <i class="bi bi-share"></i>
            </button>
        </div>
    </div>
@empty
    <p class="text-muted">Belum ada foto galeri.</p>
@endforelse
        </div>

        <p class="gallery-empty-state text-muted text-center d-none" id="galleryEmptyState">
            Belum ada foto untuk kategori ini.
        </p>
    </div>
</section>

<section class="gallery-share-cta">
    <div class="container text-center">
        <h2 class="mb-2">Bagikan Momen Anda Bersama Kami</h2>
        <p class="mx-auto mb-4">
            Punya foto kegiatan sekolah yang menarik? Kirimkan kepada kami untuk
            ditampilkan di galeri resmi sekolah.
        </p>
        <a href="mailto:info@smkn4bogor.sch.id?subject=Kirim%20Foto%20Kegiatan" class="btn btn-hero-light rounded-pill px-4 py-2">
            Kirim Foto Kegiatan
        </a>
    </div>
</section>

{{-- Lightbox untuk lihat foto lebih besar --}}
<div class="gallery-lightbox" id="galleryLightbox">
    <button type="button" class="lightbox-close" id="lightboxClose" aria-label="Tutup"><i class="bi bi-x-lg"></i></button>
    <button type="button" class="lightbox-nav lightbox-prev" id="lightboxPrev" aria-label="Sebelumnya"><i class="bi bi-chevron-left"></i></button>
            <div class="lightbox-content">
        <img src="" alt="" id="lightboxImage">
        <div class="lightbox-info">
            <div class="lightbox-meta">
                <span class="lightbox-category-badge" id="lightboxCategory"></span>
                <span class="lightbox-date"><i class="bi bi-calendar3"></i> <span id="lightboxDate"></span></span>
            </div>
            <h4 class="lightbox-title" id="lightboxCaption"></h4>
            <p class="lightbox-description" id="lightboxDescription"></p>
            <div class="lightbox-actions">
    <button type="button" class="action-pill action-pill--dark js-like" id="lightboxLike" data-id="">
        <i class="bi bi-heart"></i> <span class="js-like-count">0</span>
    </button>
    <button type="button" class="action-pill action-pill--dark js-share" id="lightboxShare" data-id="">
        <i class="bi bi-share"></i> Bagikan
    </button>
</div>
        </div>
    </div>
    <button type="button" class="lightbox-nav lightbox-next" id="lightboxNext" aria-label="Berikutnya"><i class="bi bi-chevron-right"></i></button>
</div>
<div class="share-menu" id="shareMenu" hidden>
    <div class="share-menu__box">
        <h6 class="mb-3">Bagikan foto ini</h6>
        <a id="shareWa" class="share-menu__item" target="_blank" rel="noopener">
            <i class="bi bi-whatsapp"></i> WhatsApp
        </a>
        <button type="button" class="share-menu__item" id="shareCopy">
            <i class="bi bi-link-45deg"></i> Salin link
        </button>
        <button type="button" class="share-menu__close" id="shareClose">Tutup</button>
    </div>
</div>
<div class="gallery-toast" id="galleryToast" hidden></div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ===== 1. Filter kategori =====
        const filterButtons = document.querySelectorAll('.filter-pill');
        const items = document.querySelectorAll('.gallery-masonry-item');
        const emptyState = document.getElementById('galleryEmptyState');

        filterButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                filterButtons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const filter = btn.dataset.filter;
                let visibleCount = 0;

                items.forEach(item => {
                    const match = filter === 'semua' || item.dataset.category === filter;
                    item.style.display = match ? '' : 'none';
                    if (match) visibleCount++;
                });

                emptyState.classList.toggle('d-none', visibleCount > 0);
            });
        });

        // ===== 2. Lightbox =====
        const lightbox = document.getElementById('galleryLightbox');
        const lightboxImage = document.getElementById('lightboxImage');
        const lightboxCaption = document.getElementById('lightboxCaption');
        const lightboxDescription = document.getElementById('lightboxDescription');
        const lightboxDate = document.getElementById('lightboxDate');
        const lightboxCategory = document.getElementById('lightboxCategory');
        const closeBtn = document.getElementById('lightboxClose');
        const prevBtn = document.getElementById('lightboxPrev');
        const nextBtn = document.getElementById('lightboxNext');
        const buttons = Array.from(document.querySelectorAll('.gallery-masonry-btn'));
        let currentIndex = 0;

        function getVisibleButtons() {
            return buttons.filter(btn => btn.closest('.gallery-masonry-item').style.display !== 'none');
        }

        function openLightbox(btn) {
            const visible = getVisibleButtons();
            currentIndex = visible.indexOf(btn);
            showCurrent(visible);
            lightbox.classList.add('is-open');
            document.body.style.overflow = 'hidden';
        }

        function showCurrent(visible) {
            const btn = visible[currentIndex];
            if (!btn) return;
            lightboxImage.src = btn.dataset.full;
                       lightboxCaption.textContent = btn.dataset.caption || '';
            lightboxDescription.textContent = btn.dataset.description || '';
            lightboxDate.textContent = btn.dataset.date || '-';
            lightboxCategory.textContent = btn.dataset.categoryLabel || '';
            syncLightboxActions(btn);

            updateLightboxNav(visible);
        }

        function updateLightboxNav(visible) {
            prevBtn.disabled = currentIndex <= 0;
            nextBtn.disabled = currentIndex >= visible.length - 1;
        }

        function closeLightbox() {
            lightbox.classList.remove('is-open');
            document.body.style.overflow = '';
        }

        buttons.forEach(btn => btn.addEventListener('click', () => openLightbox(btn)));
        closeBtn.addEventListener('click', closeLightbox);
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) closeLightbox();
        });

        prevBtn.addEventListener('click', () => {
            if (prevBtn.disabled) return;
            const visible = getVisibleButtons();
            currentIndex = Math.max(currentIndex - 1, 0);
            showCurrent(visible);
        });
        nextBtn.addEventListener('click', () => {
            if (nextBtn.disabled) return;
            const visible = getVisibleButtons();
            currentIndex = Math.min(currentIndex + 1, visible.length - 1);
            showCurrent(visible);
        });

        document.addEventListener('keydown', (e) => {
            if (!lightbox.classList.contains('is-open')) return;
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowLeft') prevBtn.click();
            if (e.key === 'ArrowRight') nextBtn.click();
        });

        // ===== 3. Like & Share =====
const csrf = document.querySelector('meta[name="csrf-token"]').content;
const LIKE_KEY = 'sisk4_liked_photos';
const likeUrl = (id) => `{{ url('/galeri') }}/${id}/like`;

let liked = new Set();
try { liked = new Set(JSON.parse(localStorage.getItem(LIKE_KEY) || '[]').map(String)); } catch (e) {}
const saveLiked = () => { try { localStorage.setItem(LIKE_KEY, JSON.stringify([...liked])); } catch (e) {} };

function setLikeUI(id, count, isLiked) {
    document.querySelectorAll(`.js-like[data-id="${id}"]`).forEach(b => {
        b.classList.toggle('is-liked', isLiked);
        b.querySelector('i').className = isLiked ? 'bi bi-heart-fill' : 'bi bi-heart';
        b.querySelector('.js-like-count').textContent = count;
    });
}
function currentCount(id) {
    const el = document.querySelector(`.gallery-masonry-item[data-id="${id}"] .js-like-count`);
    return el ? el.textContent : 0;
}

// hati merah untuk foto yang sudah pernah di-like di browser ini
document.querySelectorAll('.gallery-masonry-item').forEach(item => {
    const id = item.dataset.id;
    if (liked.has(id)) setLikeUI(id, currentCount(id), true);
});

function syncLightboxActions(btn) {
    const id = btn.dataset.id;
    document.getElementById('lightboxLike').dataset.id = id;
    document.getElementById('lightboxShare').dataset.id = id;
    setLikeUI(id, currentCount(id), liked.has(id));
}

function showToast(msg) {
    const t = document.getElementById('galleryToast');
    t.textContent = msg;
    t.hidden = false;
    clearTimeout(showToast.timer);
    showToast.timer = setTimeout(() => t.hidden = true, 2200);
}

async function toggleLike(id) {
    const action = liked.has(id) ? 'unlike' : 'like';
    try {
        const res = await fetch(likeUrl(id), {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ action }),
        });
        if (!res.ok) throw new Error();
        const data = await res.json();
        action === 'like' ? liked.add(id) : liked.delete(id);
        saveLiked();
        setLikeUI(id, data.likes, liked.has(id));
    } catch (e) {
        showToast('Gagal memproses like, coba lagi.');
    }
}

// ----- Share -----
const shareMenu = document.getElementById('shareMenu');
let shareUrl = '';

function photoShareUrl(id) {
    return `${location.origin}${location.pathname}?foto=${id}`;
}

async function sharePhoto(id) {
    const btn = document.querySelector(`.gallery-masonry-btn[data-id="${id}"]`);
    const title = btn?.dataset.caption || 'Galeri SMKN 4 Bogor';
    shareUrl = photoShareUrl(id);

    if (navigator.share) {
        try {
            await navigator.share({ title, text: `${title} - Galeri SMKN 4 Bogor`, url: shareUrl });
        } catch (e) { /* dibatalkan pengguna */ }
        return;
    }
    // Desktop: tampilkan menu sederhana
    document.getElementById('shareWa').href =
        'https://wa.me/?text=' + encodeURIComponent(`${title} - Galeri SMKN 4 Bogor\n${shareUrl}`);
    shareMenu.hidden = false;
}

document.getElementById('shareCopy').addEventListener('click', async () => {
    try {
        await navigator.clipboard.writeText(shareUrl);
        showToast('Link berhasil disalin');
    } catch (e) {
        prompt('Salin link ini:', shareUrl);
    }
    shareMenu.hidden = true;
});
document.getElementById('shareClose').addEventListener('click', () => shareMenu.hidden = true);
shareMenu.addEventListener('click', (e) => { if (e.target === shareMenu) shareMenu.hidden = true; });

// Satu listener untuk tombol di card maupun lightbox
document.addEventListener('click', (e) => {
    const likeBtn = e.target.closest('.js-like');
    if (likeBtn && likeBtn.dataset.id) { toggleLike(likeBtn.dataset.id); return; }

    const shareBtn = e.target.closest('.js-share');
    if (shareBtn && shareBtn.dataset.id) sharePhoto(shareBtn.dataset.id);
});

// Link share (?foto=ID) langsung membuka foto di lightbox
const sharedId = new URLSearchParams(location.search).get('foto');
if (sharedId) {
    const target = document.querySelector(`.gallery-masonry-btn[data-id="${sharedId}"]`);
    if (target) target.click();
}
    });
</script>
@endpush
