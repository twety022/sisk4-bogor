@csrf
@if(isset($photo)) @method('PUT') @endif

<div class="row g-3">
    <div class="col-md-8">
        <label class="dash-label">Judul Foto (caption)</label>
        <input type="text" name="caption" value="{{ old('caption', $photo->caption ?? '') }}" class="dash-input @error('caption') is-invalid @enderror" required>
        @error('caption') <span class="dash-error">{{ $message }}</span> @enderror
    </div>
    <div class="col-md-4">
        <label class="dash-label">Tanggal Momen</label>
        <input type="date" name="taken_at" value="{{ old('taken_at', isset($photo) && $photo->taken_at ? $photo->taken_at->format('Y-m-d') : '') }}" class="dash-input">
    </div>

    <div class="col-md-6">
        <label class="dash-label">Kategori</label>
        <select name="category" class="dash-input">
            @foreach ($categories as $key => $label)
                <option value="{{ $key }}" {{ old('category', $photo->category ?? '') === $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6 d-flex align-items-end">
        <label class="dash-checkbox">
            <input type="checkbox" name="show_on_home" value="1" {{ old('show_on_home', $photo->show_on_home ?? true) ? 'checked' : '' }}>
            <span>Tampilkan di preview Beranda</span>
        </label>
    </div>

    <div class="col-12">
        <label class="dash-label">Deskripsi (opsional, muncul di lightbox)</label>
        <textarea name="description" rows="3" class="dash-input">{{ old('description', $photo->description ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="dash-label">Foto {{ isset($photo) ? '(kosongkan kalau gak mau ganti)' : '' }}</label>
        <input type="file" name="image" accept="image/*" class="dash-input @error('image') is-invalid @enderror" {{ isset($photo) ? '' : 'required' }}>
        @error('image') <span class="dash-error">{{ $message }}</span> @enderror
        @if (isset($photo) && $photo->image_url)
            <img src="{{ $photo->image_url }}" alt="" class="dash-preview-img">
        @endif
    </div>
</div>

<div class="dash-form-actions">
    <a href="{{ route('admin.gallery.index') }}" class="dash-btn-secondary">Batal</a>
    <button type="submit" class="dash-btn-primary">
        <i class="bi bi-check-lg"></i> {{ isset($photo) ? 'Simpan Perubahan' : 'Tambah ke Galeri' }}
    </button>
</div>