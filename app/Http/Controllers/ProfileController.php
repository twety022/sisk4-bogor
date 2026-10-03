<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Achievement;
use App\Models\Program;
use App\Models\SchoolProfile;

class ProfileController extends Controller
{
    private function profile(): SchoolProfile
    {
        return SchoolProfile::first() ?? new SchoolProfile([
            'about_content'   => 'Konten sekilas sekolah belum diisi.',
            'vision'          => 'Visi sekolah belum diisi.',
            'mission'         => [],
            'history_content' => 'Sejarah sekolah belum diisi.',
        ]);
    }

    // /profil/tentang 
    public function tentang()
    {
        return view('profile.tentang', [
            'profile'    => $this->profile(),
            'facilities' => Facility::active()->get(), 
        ]);
    }

    // /profil/program-keahlian
    public function program()
    {
        return view('profile.program', [
            'programs' => Program::active()->get(),
        ]);
    }

    // /profil/fasilitas
    public function fasilitas()
    {
        return view('profile.fasilitas', [
            'facilities' => Facility::active()->get(),
        ]);
    }

    // /profil/prestasi
    public function prestasi()
    {
        return view('profile.prestasi', [
            'achievements' => Achievement::active()->get(),
        ]);
    }
}