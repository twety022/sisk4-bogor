<section class="section-timeline py-5">
    <div class="container">
        <div class="mb-5">
            <h2 class="section-title">Jejak Langkah Kami</h2>
            <p class="section-subtitle">
                Perjalanan panjang mendedikasikan diri untuk pendidikan vokasi
                yang berkualitas dan relevan dengan zaman.
            </p>
        </div>

        <div class="timeline">
            @forelse ($features as $index => $feature)
                <div class="timeline-item">
                    <div class="timeline-node-row">
                        <span class="timeline-year {{ $feature->is_current ? 'is-current' : '' }}">
                            {{ $feature->year }}
                        </span>
                        @if (!$loop->last)
                            <span class="timeline-line"></span>
                        @endif
                    </div>
                    <h6 class="timeline-title">{{ $feature->title }}</h6>
                    <p class="timeline-desc">{{ $feature->description }}</p>
                </div>
            @empty
                <p class="text-muted">Belum ada data perjalanan sekolah.</p>
            @endforelse
        </div>
    </div>
</section>
