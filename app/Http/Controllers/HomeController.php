<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\GalleryPhoto;
use App\Models\SchoolFeature;
use App\Models\Statistic;
use App\Models\SchoolProfile;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman Beranda SISK4 Bogor.
     */
    public function index()
    {
        
        $statistics = Statistic::active()->get();

        $features = SchoolFeature::active()->get();
        
        $featuredAnnouncement = Announcement::published()
            ->featured()
            ->first();

        $latestAnnouncements = Announcement::published()
            ->when($featuredAnnouncement, function ($query) use ($featuredAnnouncement) {
                $query->where('id', '!=', $featuredAnnouncement->id);
            })
            ->take(3)
            ->get();

        $galleryPhotos = GalleryPhoto::active()->take(8)->get();

        $profile = SchoolProfile::first();

return view('home.index', [
    'statistics'           => $statistics,
    'features'             => $features,
    'featuredAnnouncement' => $featuredAnnouncement,
    'latestAnnouncements'  => $latestAnnouncements,
    'galleryPhotos'        => $galleryPhotos,
    'profile'              => $profile, // BARU
]);

        return view('home.index', [
            'statistics'           => $statistics,
            'features'             => $features,
            'featuredAnnouncement' => $featuredAnnouncement,
            'latestAnnouncements'  => $latestAnnouncements,
            'galleryPhotos'        => $galleryPhotos,
        ]);
    }
}