<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    protected array $categories = [
        'akademik'   => 'Akademik',
        'kegiatan'   => 'Kegiatan',
        'prestasi'   => 'Prestasi',
        'pengumuman' => 'Pengumuman',
    ];

    public function index(Request $request)
    {
        $articles = Announcement::orderByDesc('published_at')
            ->when($request->q, fn ($q) => $q->where('title', 'like', '%'.$request->q.'%'))
            ->paginate(10)
            ->withQueryString();

        return view('admin.news.index', [
            'articles' => $articles,
            'search'   => $request->q,
        ]);
    }

    public function create()
    {
        return view('admin.news.create', ['categories' => $this->categories]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['slug'] = $this->uniqueSlug($data['title']);

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeImage($request->file('image'));
        }

        if (!empty($data['is_featured'])) {
            Announcement::query()->update(['is_featured' => false]);
        }

        Announcement::create($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Announcement $article)
    {
        return view('admin.news.edit', ['article' => $article, 'categories' => $this->categories]);
    }

    public function update(Request $request, Announcement $article)
    {
        $data = $this->validateData($request, $article->id);

        if ($data['title'] !== $article->title) {
            $data['slug'] = $this->uniqueSlug($data['title'], $article->id);
        }

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeImage($request->file('image'));
        }

        if (!empty($data['is_featured'])) {
            Announcement::where('id', '!=', $article->id)->update(['is_featured' => false]);
        }

        $article->update($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Announcement $article)
    {
        $article->delete();

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus.');
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        $validated = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'type'         => ['required', 'in:berita,pengumuman'],
            'category'     => ['required', 'in:akademik,kegiatan,prestasi,pengumuman'],
            'tags'         => ['nullable', 'string'],
            'excerpt'      => ['required', 'string', 'max:500'],
            'content'      => ['required', 'string'],
            'pull_quote'   => ['nullable', 'string'],
            'image'        => ['nullable', 'image', 'max:2048'],
            'is_featured'  => ['nullable', 'boolean'],
            'published_at' => ['required', 'date'],
        ]);

        $validated['tags'] = $validated['tags']
            ? array_values(array_filter(array_map('trim', explode(',', $validated['tags']))))
            : [];

        $validated['is_featured'] = $request->boolean('is_featured');

        return $validated;
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $i = 1;

        while (Announcement::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $original.'-'.$i++;
        }

        return $slug;
    }

    private function storeImage($file): string
    {
        $filename = uniqid('berita_').'.'.$file->getClientOriginalExtension();
        $file->move(public_path('images/news'), $filename);

        return 'images/news/'.$filename;
    }
}