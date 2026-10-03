@extends('layouts.app')

@section('title', 'Berita & Pengumuman - SISK4 Bogor')
@section('meta_description', 'Berita, kegiatan, dan pengumuman resmi SMKN 4 Bogor.')

@section('content')

<section class="news-hero">
    <div class="container">
        <nav class="news-breadcrumb">
            <a href="{{ route('home') }}">Beranda</a> <i class="bi bi-chevron-right"></i> <span>Berita</span>
        </nav>
        <h1 class="news-hero-title">Berita & Pengumuman</h1>
        <p class="news-hero-subtitle">
            Pusat informasi resmi kegiatan, prestasi, dan hal penting lainnya di lingkungan SMKN 4 Bogor.
        </p>
    </div>
</section>

<section class="news-content-section">
    <div class="container">

        {{-- Artikel utama (featured), disembunyikan kalau lagi nyari/filter --}}
        @if ($featured)
            <article class="news-featured-article">
                <span class="news-featured-tag"><i class="bi bi-lightning-fill"></i> Trending</span>
                <a href="{{ route('news.show', $featured->slug) }}">
                    <div class="news-featured-article-img-wrap">
                        @if ($featured->image_url)
                            <img src="{{ $featured->image_url }}" alt="{{ $featured->title }}">
                        @else
                            <div class="news-img-placeholder"><i class="bi bi-image"></i></div>
                        @endif
                    </div>
                </a>
                <a href="{{ route('news.show', $featured->slug) }}" class="news-featured-article-title">
                    {{ $featured->title }}
                </a>
                <p class="news-featured-article-excerpt">{{ $featured->excerpt }}</p>
                <a href="{{ route('news.show', $featured->slug) }}" class="link-read-more">
                    Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                </a>
            </article>
        @endif

        {{-- Pencarian sederhana --}}
        <form action="{{ route('news.index') }}" method="GET" class="news-search-bar">
            <input type="text" name="q" value="{{ $search }}" placeholder="Cari berita berdasarkan judul...">
            <button type="submit"><i class="bi bi-search"></i></button>
        </form>

        {{-- Filter kategori --}}
        <div class="news-filter-row">
            <a href="{{ route('news.index') }}" class="news-filter-pill {{ !$activeCategory ? 'active' : '' }}">
                Semua Berita
            </a>
            @foreach ($categories as $key => $label)
                <a href="{{ route('news.index', ['kategori' => $key]) }}"
                   class="news-filter-pill {{ $activeCategory === $key ? 'active' : '' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>
        <hr class="news-filter-divider">

        @if ($search)
            <p class="text-muted mb-3">Hasil pencarian untuk "<strong>{{ $search }}</strong>"</p>
        @endif

        {{-- Grid artikel --}}
        <div class="row g-4">
            @forelse ($articles as $article)
                <div class="col-md-6 col-lg-4">
                    <article class="news-card h-100">
                        <a href="{{ route('news.show', $article->slug) }}" class="news-card-img-wrap">
                            @if ($article->image_url)
                                <img src="{{ $article->image_url }}" alt="{{ $article->title }}">
                            @else
                                <div class="news-img-placeholder"><i class="bi bi-image"></i></div>
                            @endif
                        </a>
                        <span class="news-card-meta">
                            {{ $categories[$article->category] ?? ucfirst($article->category) }}
                            &middot; {{ $article->published_at?->locale('id')->translatedFormat('d F Y') }}
                        </span>
                        <a href="{{ route('news.show', $article->slug) }}" class="news-card-title">
                            {{ $article->title }}
                        </a>
                        <p class="news-card-excerpt">{{ \Illuminate\Support\Str::limit($article->excerpt, 90) }}</p>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted text-center">Belum ada berita untuk kategori/pencarian ini.</p>
                </div>
            @endforelse
        </div>

        {{-- Muat lebih banyak (pagination sederhana) --}}
        @if ($articles->hasMorePages())
            <div class="text-center mt-4">
                <a href="{{ $articles->nextPageUrl() }}" class="btn btn-load-more rounded-pill px-4">
                    Muat Lebih Banyak
                </a>
            </div>
        @endif
    </div>
</section>

@endsection
