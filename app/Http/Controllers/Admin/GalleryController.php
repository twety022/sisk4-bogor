<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryPhoto;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    protected array $categories = [
        'kegiatan'    => 'Kegiatan',
        'event'       => 'Event',
        'prestasi'    => 'Prestasi',
        'momen-siswa' => 'Momen Siswa',
    ];

    public function index()
    {
        $photos = GalleryPhoto::orderBy('order')->paginate(12);

        return view('admin.gallery.index', ['photos' => $photos]);
    }

    public function create()
    {
        return view('admin.gallery.create', ['categories' => $this->categories]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'caption'      => ['required', 'string', 'max:150'],
            'description'  => ['nullable', 'string', 'max:1000'],
            'taken_at'     => ['nullable', 'date'],
            'category'     => ['required', 'in:kegiatan,event,prestasi,momen-siswa'],
            'show_on_home' => ['nullable', 'boolean'],
            'image'        => ['required', 'image', 'max:3072'],
        ]);

        $data['show_on_home'] = $request->boolean('show_on_home');
        $data['image'] = $this->storeImage($request->file('image'));
        $data['order'] = (int) GalleryPhoto::max('order') + 1;

        GalleryPhoto::create($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Foto berhasil ditambahkan ke galeri.');
    }

    public function edit(GalleryPhoto $photo)
    {
        return view('admin.gallery.edit', ['photo' => $photo, 'categories' => $this->categories]);
    }

    public function update(Request $request, GalleryPhoto $photo)
    {
        $data = $request->validate([
            'caption'      => ['required', 'string', 'max:150'],
            'description'  => ['nullable', 'string', 'max:1000'],
            'taken_at'     => ['nullable', 'date'],
            'category'     => ['required', 'in:kegiatan,event,prestasi,momen-siswa'],
            'show_on_home' => ['nullable', 'boolean'],
            'image'        => ['nullable', 'image', 'max:3072'],
        ]);

        $data['show_on_home'] = $request->boolean('show_on_home');

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeImage($request->file('image'));
        }

        $photo->update($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Foto berhasil diperbarui.');
    }

    public function destroy(GalleryPhoto $photo)
    {
        $photo->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Foto berhasil dihapus.');
    }

    private function storeImage($file): string
    {
        $filename = uniqid('galeri_').'.'.$file->getClientOriginalExtension();
        $file->move(public_path('images/gallery'), $filename);

        return 'images/gallery/'.$filename;
    }
}