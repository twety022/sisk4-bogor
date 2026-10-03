<?php

namespace App\Http\Controllers;

use App\Models\GalleryPhoto;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Menampilkan halaman Galeri Sekolah lengkap.
     */
    public function index()
    {
        $photos = GalleryPhoto::active()->get();

        $categories = [
            'kegiatan'    => 'Kegiatan',
            'event'       => 'Event',
            'prestasi'    => 'Prestasi',
            'momen-siswa' => 'Momen Siswa',
        ];

        return view('gallery.index', [
            'photos'     => $photos,
            'categories' => $categories,
        ]);
    }

    /**
     * Menyukai atau gaj menyukai foto galeri.
     */
    public function toggleLike(Request $request, GalleryPhoto $photo)
    {
        abort_unless($photo->is_active, 404);

        if ($request->input('action') === 'unlike') {
            GalleryPhoto::whereKey($photo->id)->where('likes', '>', 0)->decrement('likes');
        } else {
            $photo->increment('likes');
        }

        return response()->json(['likes' => (int) $photo->fresh()->likes]);
    }
}