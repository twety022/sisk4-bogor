@extends('layouts.app')

@section('title', 'Produk Siswa - SISK4 Bogor')
@section('meta_description', 'Karya dan produk hasil siswa SMKN 4 Bogor dari berbagai program keahlian.')

@section('content')

<section class="gallery-hero">
    <div class="container text-center">
        <h1 class="gallery-hero-title">Produk Siswa</h1>
        <p class="gallery-hero-subtitle mx-auto">
            Karya nyata siswa-siswi SMKN 4 Bogor dari berbagai program keahlian —
            bukti kompetensi yang diaplikasikan langsung ke proyek yang bermanfaat.
        </p>
    </div>
</section>

<section class="gallery-filter-section">
    <div class="container">
        <div class="gallery-filter-row">
            <a href="{{ route('products.index') }}" class="filter-pill {{ !$activeProgram ? 'active' : '' }}">
                Semua Produk
            </a>
            @foreach ($programs as $program)
                <a href="{{ route('products.index', ['jurusan' => $program->slug]) }}"
                   class="filter-pill {{ $activeProgram === $program->slug ? 'active' : '' }}">
                    {{ $program->code }}
                </a>
            @endforeach
        </div>
    </div>
</section>
@php
    $adminNumber = preg_replace('/\D/', '', config('sisk4.whatsapp'));
    if (str_starts_with($adminNumber, '0')) {
        $adminNumber = '62' . substr($adminNumber, 1);
    }
    $adminWa = $adminNumber
        ? 'https://wa.me/' . $adminNumber . '?text=' . rawurlencode('Halo, saya ingin memesan produk siswa SMKN 4 Bogor. Boleh minta info lebih lanjut?')
        : null;
@endphp

<section class="order-banner-section">
    <div class="container">
        <div class="order-banner">
            <div class="order-banner__text">
                <span class="order-banner__eyebrow"><i class="bi bi-bag-heart-fill"></i> Pesan Karya Siswa</span>
                <h2>Tertarik dengan produk kami?</h2>
                <p>Hubungi admin untuk menanyakan ketersediaan, harga, atau memesan sesuai kebutuhanmu.</p>
                <ol class="order-steps">
                    <li><span>1</span> Pilih produk dan buka detailnya</li>
                    <li><span>2</span> Hubungi admin lewat WhatsApp</li>
                    <li><span>3</span> Admin menghubungkan dengan tim pembuat</li>
                </ol>
            </div>
            @if ($adminWa)
                <a href="{{ $adminWa }}" target="_blank" rel="noopener" class="order-banner__btn">
                    <i class="bi bi-whatsapp"></i>
                    <span>Hubungi Admin<small>via WhatsApp</small></span>
                </a>
            @endif
        </div>
    </div>
</section>
<section class="gallery-grid-section">
    <div class="container">
        <div class="row g-4">
            @forelse ($products as $product)
                @php
                    $status = $product->sale_status ?? 'portofolio';
                    $wa     = $product->whatsapp_url;
                @endphp
                <div class="col-md-6 col-lg-4">
                    <div class="news-card h-100 product-card">
                        <button type="button" class="product-card__open"
                            data-title="{{ $product->title }}"
                            data-image="{{ $product->image_url }}"
                            data-desc="{{ $product->description }}"
                            data-team="{{ $product->team }}"
                            data-meta="{{ ($product->program ? $product->program->code . ' · ' : '') . $product->year }}"
                            data-status="{{ $status }}"
                            data-status-label="{{ $product->status_label }}"
                            data-price="{{ $product->price_label }}"
                            data-wa="{{ $wa }}"
                            data-link="{{ $product->link }}">

                            <div class="news-card-img-wrap product-card__img">
                                @if ($product->image_url)
                                    <img src="{{ $product->image_url }}" alt="{{ $product->title }}"
                                         onerror="this.replaceWith(Object.assign(document.createElement('div'),{className:'news-img-placeholder',innerHTML:'<i class=&quot;bi bi-box-seam&quot;></i>'}))">
                                @else
                                    <div class="news-img-placeholder"><i class="bi bi-box-seam"></i></div>
                                @endif
                                <span class="status-badge status-badge--{{ $status }}">{{ $product->status_label }}</span>
                            </div>

                            <span class="news-card-meta">
                                @if ($product->program){{ $product->program->code }} &middot;@endif
                                {{ $product->year }}
                            </span>
                            <span class="news-card-title">{{ $product->title }}</span>
                            <span class="news-card-excerpt d-block">{{ Str::limit($product->description, 110) }}</span>
                        </button>

                        <div class="product-card__footer">
                            <div>
                                <span class="facility-subtitle d-block">{{ $product->team }}</span>
                                @if ($product->price_label)
                                    <strong class="product-price">{{ $product->price_label }}</strong>
                                @endif
                                <span class="product-card__more">Lihat detail <i class="bi bi-arrow-right"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted text-center">Belum ada produk untuk kategori ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@if ($adminWa)
<section class="order-cta">
    <div class="container">
        <div class="order-cta__box">
            <div>
                <h3>Ingin pesan produk custom?</h3>
                <p>Kami bisa menghubungkanmu dengan siswa dan guru pembimbing dari jurusan yang sesuai.</p>
            </div>
            <a href="{{ $adminWa }}" target="_blank" rel="noopener" class="order-banner__btn order-banner__btn--light">
                <i class="bi bi-whatsapp"></i> <span>Chat Admin</span>
            </a>
        </div>
    </div>
</section>
@endif
{{-- Modal detail produk --}}
<div class="product-modal" id="productModal" hidden>
    <div class="product-modal__box">
        <button type="button" class="product-modal__close" id="productModalClose" aria-label="Tutup">
            <i class="bi bi-x-lg"></i>
        </button>
        <img src="" alt="" id="pmImage" class="product-modal__img">
        <div class="product-modal__body">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="status-badge status-badge--static" id="pmStatus"></span>
                <span class="text-muted small" id="pmMeta"></span>
            </div>
            <h4 class="fw-bold" id="pmTitle"></h4>
            <p class="text-muted" id="pmDesc"></p>
            <p class="small mb-1"><i class="bi bi-people"></i> <span id="pmTeam"></span></p>
            <p class="product-price mb-3" id="pmPrice"></p>
            <div class="d-flex flex-wrap gap-2">
                <a href="#" target="_blank" rel="noopener" class="btn-wa" id="pmWa">
                    <i class="bi bi-whatsapp"></i> Tanya / Pesan via WhatsApp
                </a>
                <a href="#" target="_blank" rel="noopener" class="btn-outline-pill" id="pmLink">
                    Lihat Produk <i class="bi bi-box-arrow-up-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('productModal');
        const $ = (id) => document.getElementById(id);

        const close = () => { modal.hidden = true; document.body.style.overflow = ''; };

        document.querySelectorAll('.product-card__open').forEach(btn => {
            document.querySelectorAll('.product-card__footer').forEach(f => {
    f.style.cursor = 'pointer';
    f.addEventListener('click', () => f.closest('.product-card').querySelector('.product-card__open').click());
});
            btn.addEventListener('click', () => {
                const d = btn.dataset;
                $('pmTitle').textContent = d.title;
                $('pmDesc').textContent  = d.desc || '';
                $('pmTeam').textContent  = d.team || '-';
                $('pmMeta').textContent  = d.meta;

                const img = $('pmImage');
                img.style.display = d.image ? '' : 'none';
                img.src = d.image || '';
                img.alt = d.title;

                const st = $('pmStatus');
                st.textContent = d.statusLabel;
                st.className = 'status-badge status-badge--static status-badge--' + d.status;

                $('pmPrice').textContent = d.price || '';
                $('pmPrice').style.display = d.price ? '' : 'none';

                const wa = $('pmWa');
                wa.style.display = d.wa ? '' : 'none';
                wa.href = d.wa || '#';

                const link = $('pmLink');
                link.style.display = d.link ? '' : 'none';
                link.href = d.link || '#';

                modal.hidden = false;
                document.body.style.overflow = 'hidden';
            });
        });

        $('productModalClose').addEventListener('click', close);
        modal.addEventListener('click', (e) => { if (e.target === modal) close(); });
        document.addEventListener('keydown', (e) => { if (e.key === 'Escape') close(); });
    });
</script>
@endpush