<section id="berita" class="section-news py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-title mb-0">Berita & Pengumuman <span class="text-brand">SISK4</span></h2>
            <a href="{{ route('news.index') }}" class="link-see-all">Lihat Semua Berita <i class="bi bi-arrow-right ms-1"></i></a>
        </div>

        <div class="row g-5">
            {{-- Berita utama --}}
            <div class="col-lg-7">
                @if ($featuredAnnouncement)
                    <article class="news-featured">
                        <a href="{{ route('news.show', $featuredAnnouncement->slug) }}" class="news-featured-img-wrap">
                            @if ($featuredAnnouncement->image_url)
                                <img src="{{ $featuredAnnouncement->image_url }}"
                                     alt="{{ $featuredAnnouncement->title }}"
                                     class="news-featured-img">
                            @else
                                <div class="news-img-placeholder"><i class="bi bi-image"></i></div>
                            @endif
                            <span class="news-featured-badge">{{ ucfirst($featuredAnnouncement->type) }}</span>
                        </a>
                        <span class="news-date">{{ $featuredAnnouncement->published_at?->locale('id')->diffForHumans() }}</span>
                        <a href="{{ route('news.show', $featuredAnnouncement->slug) }}" class="news-featured-title-link">
                            <h3 class="news-featured-title">{{ $featuredAnnouncement->title }}</h3>
                        </a>
                        <p class="news-featured-excerpt">{{ $featuredAnnouncement->excerpt }}</p>
                    </article>
                @else
                    <p class="text-muted">Belum ada berita utama.</p>
                @endif
            </div>

            {{-- Daftar berita lainnya --}}
            <div class="col-lg-5">
                <div class="news-list">
                    @forelse ($latestAnnouncements as $item)
                        <a href="{{ route('news.show', $item->slug) }}" class="news-list-item">
                            <span class="news-list-meta">
                                {{ ucfirst($item->type) }} &middot; {{ $item->published_at?->locale('id')->diffForHumans() }}
                            </span>
                            <h6 class="news-list-title">{{ $item->title }}</h6>
                            <span class="news-list-link">Baca selengkapnya <i class="bi bi-arrow-right"></i></span>
                        </a>
                    @empty
                        <p class="text-muted">Belum ada berita lainnya.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
