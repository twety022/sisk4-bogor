@extends('layouts.app')

@section('title', $article->title . ' - SISK4 Bogor')
@section('meta_description', $article->excerpt)

@section('content')

<section class="news-detail-section">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
            <a href="{{ route('news.index') }}" class="news-back-link">
                <i class="bi bi-arrow-left"></i> Kembali ke Berita
            </a>
            <nav class="news-breadcrumb mb-0">
                <a href="{{ route('home') }}">Beranda</a> <i class="bi bi-chevron-right"></i>
                <a href="{{ route('news.index') }}">Berita</a> <i class="bi bi-chevron-right"></i>
                <span>Detail</span>
            </nav>
        </div>

        <div class="row g-4">
            {{-- Konten utama --}}
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="news-category-badge">{{ $categories[$article->category] ?? ucfirst($article->category) }}</span>
                    <span class="news-detail-meta">
                        {{ $article->published_at?->locale('id')->diffForHumans() }}
                        &middot; {{ $article->reading_time }} menit baca
                    </span>
                </div>

                <h1 class="news-detail-title">{{ $article->title }}</h1>

                <div class="news-detail-img-wrap">
                    @if ($article->image_url)
                        <img src="{{ $article->image_url }}" alt="{{ $article->title }}">
                    @else
                        <div class="news-img-placeholder"><i class="bi bi-image"></i></div>
                    @endif
                </div>

                <div class="news-detail-body">
                    @foreach (explode("\n\n", $article->content) as $index => $paragraph)
                        <p>{{ $paragraph }}</p>

                        {{-- Pull quote disisipkan setelah paragraf pertama --}}
                        @if ($index === 0 && $article->pull_quote)
                            <blockquote class="news-pull-quote">
                                {{ $article->pull_quote }}
                            </blockquote>
                        @endif
                    @endforeach
                </div>

                @if (!empty($article->tags))
                    <div class="news-tags">
                        @foreach ($article->tags as $tag)
                            <span class="news-tag-pill">{{ $tag }}</span>
                        @endforeach
                    </div>
                @endif

                <div class="news-share-row">
                    <span>Bagikan artikel</span>
                    <div class="d-flex gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                           target="_blank" rel="noopener" class="btn-share btn-share-facebook">
                            <i class="bi bi-facebook"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($article->title) }}"
                           target="_blank" rel="noopener" class="btn-share btn-share-twitter">
                            <i class="bi bi-twitter-x"></i> Twitter
                        </a>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                <div class="news-sidebar-card">
                    <h6 class="news-sidebar-title">Cari Berita</h6>
                    <form action="{{ route('news.index') }}" method="GET" class="news-search-form">
                        <input type="text" name="q" placeholder="Kata kunci artikel...">
                        <button type="submit"><i class="bi bi-search"></i></button>
                    </form>
                </div>

                @if ($related->isNotEmpty())
                    <div class="news-sidebar-card">
                        <h6 class="news-sidebar-title">Berita Terkait</h6>
                        <div class="news-related-list">
                            @foreach ($related as $item)
                                <a href="{{ route('news.show', $item->slug) }}" class="news-related-item">
                                    <div class="news-related-img">
                                        @if ($item->image_url)
                                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}">
                                        @else
                                            <div class="news-img-placeholder small"><i class="bi bi-image"></i></div>
                                        @endif
                                    </div>
                                    <div>
                                        <span class="news-related-title">{{ $item->title }}</span>
                                        <span class="news-related-date">{{ $item->published_at?->locale('id')->diffForHumans() }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="news-sidebar-card">
                    <h6 class="news-sidebar-title">Kategori Berita</h6>
                    <ul class="news-category-list">
                        @foreach ($categories as $key => $label)
                            <li>
                                <a href="{{ route('news.index', ['kategori' => $key]) }}"
                                   class="{{ $article->category === $key ? 'active' : '' }}">
                                    {{ $label }}
                                    <span class="news-category-count">{{ $categoryCounts[$key] ?? 0 }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
