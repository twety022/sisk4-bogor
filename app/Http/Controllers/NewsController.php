<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Daftar kategori berita: dipakai buat tombol filter & sidebar "Kategori Berita".
     * Key = nilai yang disimpan di database, Value = label yang ditampilkan.
     */
    protected array $categories = [
        'akademik'   => 'Akademik',
        'kegiatan'   => 'Kegiatan',
        'prestasi'   => 'Prestasi',
        'pengumuman' => 'Pengumuman',
    ];

    /**
     * Halaman daftar Berita & Pengumuman, dengan featured article, filter kategori, dan "Muat Lebih Banyak".
     */
    public function index(Request $request)
    {
        $activeCategory = $request->query('kategori');
        $search = $request->query('q');

        $featured = Announcement::published()->featured()->first();

        $articles = Announcement::published()
            ->category($activeCategory)
            ->when($search, fn ($query) => $query->where('title', 'like', "%{$search}%"))
            ->when($featured && !$search, fn ($query) => $query->where('id', '!=', $featured->id))
            ->paginate(6)
            ->withQueryString();

        $categoryCounts = Announcement::published()
            ->selectRaw('category, count(*) as total')
            ->groupBy('category')
            ->pluck('total', 'category');

        return view('news.index', [
            'featured'       => $search ? null : $featured,
            'articles'       => $articles,
            'categories'     => $this->categories,
            'categoryCounts' => $categoryCounts,
            'activeCategory' => $activeCategory,
            'search'         => $search,
        ]);
    }

    /**
     * Halaman detail satu Berita/Pengumuman.
     */
    public function show(string $slug)
    {
        $article = Announcement::published()->where('slug', $slug)->firstOrFail();

        // Berita terkait: kategori sama
        $related = Announcement::published()
            ->where('category', $article->category)
            ->where('id', '!=', $article->id)
            ->take(3)
            ->get();

        $categoryCounts = Announcement::published()
            ->selectRaw('category, count(*) as total')
            ->groupBy('category')
            ->pluck('total', 'category');

        return view('news.show', [
            'article'        => $article,
            'related'        => $related,
            'categories'     => $this->categories,
            'categoryCounts' => $categoryCounts,
        ]);
    }
}
