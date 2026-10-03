<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('program')->orderBy('order')->paginate(10);

        return view('admin.products.index', ['products' => $products]);
    }

    public function create()
    {
        return view('admin.products.create', $this->formData());
    }

    public function store(Request $request)
    {
        $data = $this->validated($request, true);

        $data['slug']  = $this->uniqueSlug($data['title']);
        $data['image'] = $this->storeImage($request->file('image'));
        $data['order'] = (int) Product::max('order') + 1;

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', $this->formData() + ['product' => $product]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validated($request, false);

        if ($data['title'] !== $product->title) {
            $data['slug'] = $this->uniqueSlug($data['title'], $product->id);
        }

        if ($request->hasFile('image')) {
            $this->deleteImage($product->image);
            $data['image'] = $this->storeImage($request->file('image'));
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $this->deleteImage($product->image);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    // ---------------------------------------------------------------

    private function formData(): array
    {
        return [
            'programs' => Program::active()->get(),
            'statuses' => Product::STATUS_LABELS,
        ];
    }

    private function validated(Request $request, bool $isNew): array
    {
        $data = $request->validate([
            'title'            => ['required', 'string', 'max:150'],
            'program_id'       => ['nullable', 'exists:programs,id'],
            'description'      => ['nullable', 'string', 'max:2000'],
            'team'             => ['nullable', 'string', 'max:100'],
            'year'             => ['nullable', 'string', 'max:10'],
            'link'             => ['nullable', 'url', 'max:255'],
            'sale_status'      => ['required', 'in:tersedia,pesanan,portofolio'],
            'price'            => ['nullable', 'integer', 'min:0'],
            'contact_whatsapp' => ['nullable', 'string', 'max:20', 'regex:/^[0-9+\s-]+$/'],
            'is_active'        => ['nullable', 'boolean'],
            'image'            => [$isNew ? 'required' : 'nullable', 'image', 'max:3072'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        if ($data['sale_status'] === 'portofolio') {
            $data['price'] = null;
            $data['contact_whatsapp'] = null;
        }

        unset($data['image']); 

        return $data;
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'produk';
        $slug = $base;
        $i = 2;

        while (Product::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    private function storeImage($file): string
    {
        $filename = uniqid('produk_') . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/products'), $filename);

        return 'images/products/' . $filename;
    }

    private function deleteImage(?string $path): void
    {
        if ($path && str_starts_with($path, 'images/products/')) {
            $full = public_path($path);
            if (is_file($full)) {
                @unlink($full);
            }
        }
    }
}