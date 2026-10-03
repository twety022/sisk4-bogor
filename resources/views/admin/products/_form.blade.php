@csrf
@if (isset($product)) @method('PUT') @endif

<div class="row g-3">
    <div class="col-md-8">
        <label class="dash-label">Nama Produk</label>
        <input type="text" name="title" value="{{ old('title', $product->title ?? '') }}"
               class="dash-input @error('title') is-invalid @enderror" required>
        @error('title') <span class="dash-error">{{ $message }}</span> @enderror
    </div>
    <div class="col-md-4">
        <label class="dash-label">Jurusan</label>
        <select name="program_id" class="dash-input">
            <option value="">- Pilih jurusan -</option>
            @foreach ($programs as $program)
                <option value="{{ $program->id }}"
                    {{ (string) old('program_id', $product->program_id ?? '') === (string) $program->id ? 'selected' : '' }}>
                    {{ $program->code }}
                </option>
            @endforeach
        </select>
        @error('program_id') <span class="dash-error">{{ $message }}</span> @enderror
    </div>

    <div class="col-md-8">
        <label class="dash-label">Pembuat / Kelas</label>
        <input type="text" name="team" value="{{ old('team', $product->team ?? '') }}"
               class="dash-input" placeholder="Contoh: Kelas XII PPLG 1">
    </div>
    <div class="col-md-4">
        <label class="dash-label">Tahun</label>
        <input type="text" name="year" value="{{ old('year', $product->year ?? date('Y')) }}" class="dash-input">
    </div>

    <div class="col-12">
        <label class="dash-label">Deskripsi</label>
        <textarea name="description" rows="4" class="dash-input">{{ old('description', $product->description ?? '') }}</textarea>
        @error('description') <span class="dash-error">{{ $message }}</span> @enderror
    </div>

    <div class="col-md-4">
        <label class="dash-label">Status Penjualan</label>
        <select name="sale_status" id="saleStatus" class="dash-input">
            @foreach ($statuses as $key => $label)
                <option value="{{ $key }}"
                    {{ old('sale_status', $product->sale_status ?? 'portofolio') === $key ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4 js-sale-field">
        <label class="dash-label">Harga (Rp)</label>
        <input type="number" name="price" min="0" value="{{ old('price', $product->price ?? '') }}"
               class="dash-input @error('price') is-invalid @enderror" placeholder="Kosongkan = hubungi untuk harga">
        @error('price') <span class="dash-error">{{ $message }}</span> @enderror
    </div>

    <div class="col-md-4 js-sale-field">
        <label class="dash-label">No. WhatsApp (opsional)</label>
        <input type="text" name="contact_whatsapp" value="{{ old('contact_whatsapp', $product->contact_whatsapp ?? '') }}"
               class="dash-input @error('contact_whatsapp') is-invalid @enderror" placeholder="Kosong = pakai nomor admin sekolah">
        @error('contact_whatsapp') <span class="dash-error">{{ $message }}</span> @enderror
    </div>

    <div class="col-12">
        <label class="dash-label">Link Demo / Produk (opsional)</label>
        <input type="url" name="link" value="{{ old('link', $product->link ?? '') }}"
               class="dash-input @error('link') is-invalid @enderror" placeholder="https://...">
        @error('link') <span class="dash-error">{{ $message }}</span> @enderror
    </div>

    <div class="col-12">
        <label class="dash-label">Foto Produk {{ isset($product) ? '(kosongkan kalau gak mau ganti)' : '' }}</label>
        <input type="file" name="image" accept="image/*"
               class="dash-input @error('image') is-invalid @enderror" {{ isset($product) ? '' : 'required' }}>
        @error('image') <span class="dash-error">{{ $message }}</span> @enderror
        @if (isset($product) && $product->image_url)
            <img src="{{ $product->image_url }}" alt="" class="dash-preview-img">
        @endif
    </div>

    <div class="col-12">
        <label class="dash-checkbox">
            <input type="checkbox" name="is_active" value="1"
                {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
            <span>Tampilkan di website</span>
        </label>
    </div>
</div>

<div class="dash-form-actions">
    <a href="{{ route('admin.products.index') }}" class="dash-btn-secondary">Batal</a>
    <button type="submit" class="dash-btn-primary">
        <i class="bi bi-check-lg"></i> {{ isset($product) ? 'Simpan Perubahan' : 'Tambah Produk' }}
    </button>
</div>

@push('scripts')
<script>
    (function () {
        const select = document.getElementById('saleStatus');
        const fields = document.querySelectorAll('.js-sale-field');
        const sync = () => fields.forEach(f => f.style.display = select.value === 'portofolio' ? 'none' : '');
        select.addEventListener('change', sync);
        sync();
    })();
</script>
@endpush