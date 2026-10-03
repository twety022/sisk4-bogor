<section class="section-stats py-5">
    <div class="container">
        <div class="row g-4 text-white">
            @foreach ($statistics as $stat)
                @php
                    $numericTarget = (int) preg_replace('/\D/', '', $stat->value);
                    preg_match('/\D+$/', $stat->value, $m);
                    $suffix = $m[0] ?? '';
                @endphp
                <div class="col-6 col-md-3">
                    <div class="stat-value" data-target="{{ $numericTarget }}" data-suffix="{{ $suffix }}">0</div>
                    <div class="stat-label">{{ $stat->label }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const statEls = document.querySelectorAll('.stat-value');
        if (statEls.length === 0) return;

        function animateCount(el) {
            const target = parseInt(el.dataset.target, 10) || 0;
            const suffix = el.dataset.suffix || '';
            const duration = 1400;
            const startTime = performance.now();

            function tick(now) {
                const progress = Math.min((now - startTime) / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 2);
                const current = Math.floor(eased * target);
                el.textContent = current.toLocaleString('id-ID') + suffix;
                if (progress < 1) {
                    requestAnimationFrame(tick);
                } else {
                    el.textContent = target.toLocaleString('id-ID') + suffix;
                }
            }
            requestAnimationFrame(tick);
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCount(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.4 });

        statEls.forEach(el => observer.observe(el));
    });
</script>
@endpush