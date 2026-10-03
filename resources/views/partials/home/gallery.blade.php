<section class="gallery-section py-5">
    <div class="gallery-scroll-wrapper">
        <button type="button" class="gallery-nav-btn gallery-nav-prev" aria-label="Sebelumnya">
            <i class="bi bi-chevron-left"></i>
        </button>

        <div class="gallery-track" id="galleryTrack">
            @forelse ($galleryPhotos as $photo)
                <div class="gallery-item">
                    @if ($photo->image_url)
                        <img src="{{ $photo->image_url }}" alt="{{ $photo->caption }}">
                    @else
                        <div class="gallery-item-placeholder">
                            <i class="bi bi-image"></i>
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-muted px-4">Belum ada foto galeri.</p>
            @endforelse
        </div>

        <button type="button" class="gallery-nav-btn gallery-nav-next" aria-label="Berikutnya">
            <i class="bi bi-chevron-right"></i>
        </button>
    </div>

    <div class="text-center mt-4">
        
        <a href="{{ route('gallery') }}" class="btn btn-gallery-more rounded-pill px-4">
            Lihat Lebih Banyak <i class="bi bi-chevron-right ms-1"></i>
        </a>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const track   = document.getElementById('galleryTrack');
        const prevBtn = document.querySelector('.gallery-nav-prev');
        const nextBtn = document.querySelector('.gallery-nav-next');
        if (!track || !prevBtn || !nextBtn) return;

        const items = Array.from(track.querySelectorAll('.gallery-item'));
        if (items.length === 0) return;

        const scrollAmount = 280;

        function updateActiveItem() {
            const trackRect = track.getBoundingClientRect();
            const trackCenter = trackRect.left + trackRect.width / 2;

            let closest = null;
            let closestDistance = Infinity;

            items.forEach(item => {
                const itemRect = item.getBoundingClientRect();
                const itemCenter = itemRect.left + itemRect.width / 2;
                const distance = Math.abs(itemCenter - trackCenter);

                if (distance < closestDistance) {
                    closestDistance = distance;
                    closest = item;
                }

                item.classList.remove('is-active');
            });

            if (closest) {
                closest.classList.add('is-active');
            }
        }


        function updateNavButtons() {
            const maxScroll = track.scrollWidth - track.clientWidth;
            const tolerance = 4;

            prevBtn.disabled = track.scrollLeft <= tolerance;
            nextBtn.disabled = track.scrollLeft >= maxScroll - tolerance;
        }

        function onTrackUpdate() {
            updateActiveItem();
            updateNavButtons();
        }

        let rafId = null;
        track.addEventListener('scroll', () => {
            if (rafId) cancelAnimationFrame(rafId);
            rafId = requestAnimationFrame(onTrackUpdate);
        });

        prevBtn.addEventListener('click', () => {
            if (prevBtn.disabled) return;
            track.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        });
        nextBtn.addEventListener('click', () => {
            if (nextBtn.disabled) return;
            track.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        });

        window.addEventListener('resize', onTrackUpdate);
        onTrackUpdate();

        let isDown = false;
        let startX = 0;
        let startScrollLeft = 0;
        let dragged = false;

track.addEventListener('mousedown', (e) => {
    isDown = true;
    dragged = false;
    track.classList.add('is-dragging');
    startX = e.pageX;
    startScrollLeft = track.scrollLeft;
});

window.addEventListener('mouseup', () => {
    isDown = false;
    track.classList.remove('is-dragging');
});

track.addEventListener('mouseleave', () => {
    isDown = false;
    track.classList.remove('is-dragging');
});

track.addEventListener('mousemove', (e) => {
    if (!isDown) return;
    e.preventDefault();
    const walk = e.pageX - startX;
    if (Math.abs(walk) > 5) dragged = true;
    track.scrollLeft = startScrollLeft - walk;
});

track.addEventListener('click', (e) => {
    if (dragged) {
        e.preventDefault();
        e.stopPropagation();
    }
}, true);
    });
</script>
@endpush