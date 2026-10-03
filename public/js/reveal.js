document.addEventListener('DOMContentLoaded', () => {
    // Elemen yang otomatis dianimasikan (tanpa perlu edit tiap view)
    const selectors = [
        '.hv-hero__content', '.hv-card', '.about-section .row', '.principal-card',
        '.timeline-item', '.stat-value', '.news-featured', '.news-list-item',
        '.gallery-scroll-wrapper', '.location-section .row > *',
        '.news-card', '.facility-small-card', '.org-card', '.order-banner', '.order-cta__box',
        '.profile-section', '.program-feature', '.prestasi-card', '.ppdb-timeline-item',
        '.ppdb-pathway-card', '.gallery-masonry-item', '.contact-info-card', '.contact-form-card'
    ];

    const els = document.querySelectorAll(selectors.join(','));

    // Beri jeda bertahap untuk elemen bersaudara (kartu muncul satu per satu)
    els.forEach(el => {
        el.classList.add('reveal');
        const siblings = Array.from(el.parentElement.children).filter(c => c.classList.contains('reveal'));
        const idx = Math.max(0, siblings.indexOf(el));
        el.style.setProperty('--reveal-delay', Math.min(idx, 5) * 120 + 'ms');
    });

    const io = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                io.unobserve(entry.target); // sekali saja
            }
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

    els.forEach(el => io.observe(el));
});