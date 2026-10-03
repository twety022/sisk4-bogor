<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\ContactMessage;
use App\Models\GalleryPhoto;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        //Like galeri
        $topPhotos = GalleryPhoto::where('likes', '>', 0)
            ->orderByDesc('likes')
            ->take(5)
            ->get();

        // Produk
        $productStatus = Product::pluck('sale_status')
            ->map(fn ($s) => $s ?: 'portofolio')
            ->countBy();

        return view('dashboard.index', [
            'totalNews'      => Announcement::count(),
            'totalGallery'   => GalleryPhoto::count(),
            'unreadMessages' => ContactMessage::where('is_read', false)->count(),
            'latestMessages' => ContactMessage::orderByDesc('created_at')->take(5)->get(),
            'latestNews'     => Announcement::orderByDesc('created_at')->take(5)->get(),

            'totalLikes'     => (int) GalleryPhoto::sum('likes'),
            'topPhotos'      => $topPhotos,
            'maxLikes'       => max(1, (int) $topPhotos->max('likes')),

            'totalProducts'  => Product::count(),
            'productStatus'  => $productStatus,
            'latestProducts' => Product::with('program')->latest()->take(5)->get(),
        ]);
    }
}