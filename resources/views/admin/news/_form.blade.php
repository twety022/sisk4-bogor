@csrf
@if(isset($article)) @method('PUT') @endif

<div class="row g-3">
    <div class="col-md-8">
        <label class="dash-label">Judul Berita</label>
        <input type="text" name="title" value="{{ old('title', $article->title ?? '') }}" class="dash-input @error('title') is-invalid @enderror" required>
        @error('title') <span class="dash-error">{{ $message }}</span> @enderror
    </div>
    <div class="col-md-4">
        <label class="dash-label">Tanggal Terbit</label>
        <input type="datetime-local" name="published_at"
               value="{{ old('published_at', isset($article) && $article->published_at ? $article->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}"
               class="dash-input @error('published_at') is-invalid @enderror" required>
        @error('published_at') <span class="dash-error">{{ $message }}</span> @enderror
    </div>

    <div class="col-md-6">
        <label class="dash-label">Tipe</label>
        <select name="type" class="dash-input">
            <option value="berita" {{ old('type', $article->type ?? '') === 'berita' ? 'selected' : '' }}>Berita</option>
            <option value="pengumuman" {{ old('type', $article->type ?? '') === 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="dash-label">Kategori</label>
        <select name="category" class="dash-input">
            @foreach ($categories as $key => $label)
                <option value="{{ $key }}" {{ old('category', $article->category ?? '') === $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-12">
        <label class="dash-label">Ringkasan Singkat (excerpt)</label>
        <textarea name="excerpt" rows="2" class="dash-input @error('excerpt') is-invalid @enderror" required>{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
        @error('excerpt') <span class="dash-error">{{ $message }}</span> @enderror
    </div>

    <div class="col-12">
        <label class="dash-label">Isi Lengkap</label>
        <p class="dash-hint">Pisahkan tiap paragraf dengan baris kosong (Enter 2x) supaya rapi ditampilkan di halaman detail.</p>
        <textarea name="content" rows="8" class="dash-input @error('content') is-invalid @enderror" required>{{ old('content', $article->content ?? '') }}</textarea>
        @error('content') <span class="dash-error">{{ $message }}</span> @enderror
    </div>

    <div class="col-12">
        <label class="dash-label">Kutipan Highlight (opsional)</label>
        <textarea name="pull_quote" rows="2" class="dash-input">{{ old('pull_quote', $article->pull_quote ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="dash-label">Tag (pisahkan dengan koma)</label>
        <input type="text" name="tags" value="{{ old('tags', isset($article) ? implode(', ', $article->tags ?? []) : '') }}" class="dash-input" placeholder="Contoh: Pramuka, Ekstrakurikuler">
    </div>

    <div class="col-md-8">
        <label class="dash-label">Gambar {{ isset($article) ? '(kosongkan kalau gak mau ganti)' : '' }}</label>
        <input type="file" name="image" accept="image/*" class="dash-input @error('image') is-invalid @enderror">
        @error('image') <span class="dash-error">{{ $message }}</span> @enderror
        @if (isset($article) && $article->image_url)
            <img src="{{ $article->image_url }}" alt="" class="dash-preview-img">
        @endif
    </div>
    <div class="col-md-4 d-flex align-items-end">
        <label class="dash-checkbox">
            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $article->is_featured ?? false) ? 'checked' : '' }}>
            <span>Jadikan berita utama (featured)</span>
        </label>
    </div>
</div>

<div class="dash-form-actions">
    <a href="{{ route('admin.news.index') }}" class="dash-btn-secondary">Batal</a>
    <button type="submit" class="dash-btn-primary">
        <i class="bi bi-check-lg"></i> {{ isset($article) ? 'Simpan Perubahan' : 'Publikasikan Berita' }}
    </button>
</div>