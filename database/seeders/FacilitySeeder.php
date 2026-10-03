<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    public function run(): void
    {
        Facility::query()->delete();

        $data = [

            [
                'title'    => 'Ruang Kelas',
                'subtitle' => 'Nyaman & kondusif',
                'image'    => 'images/facilities/ruang-kelas.jpg',
                'icon'     => 'bi-easel2-fill',
                'color'    => 'blue',
                'order'    => 1,
            ],

            [
                'title'    => 'Lab PPLG & TJKT',
                'subtitle' => 'Praktik IT',
                'image'    => 'images/facilities/laboratorium.jpg',
                'icon'     => 'bi-pc-display-horizontal',
                'color'    => 'green',
                'order'    => 2,
            ],

            [
                'title'    => 'Bengkel Praktik',
                'subtitle' => 'Sesuai standar industri',
                'image'    => 'images/facilities/bengkel.jpg',
                'icon'     => 'bi-tools',
                'color'    => 'purple',
                'order'    => 3,
            ],

            [
                'title'    => 'Lapangan Olahraga',
                'subtitle' => 'Kegiatan & ekstrakurikuler',
                'image'    => 'images/facilities/lapangan.jpg',
                'icon'     => 'bi-trophy-fill',
                'color'    => 'orange',
                'order'    => 4,
            ],

            [
                'title'    => 'Mushola',
                'subtitle' => 'Tempat ibadah siswa',
                'image'    => 'images/facilities/mushola.jpg',
                'icon'     => 'bi-moon-stars-fill',
                'color'    => 'green',
                'order'    => 5,
            ],

            [
                'title'    => 'Kantin & Koperasi',
                'subtitle' => 'Kebutuhan siswa',
                'image'    => 'images/facilities/kantin.jpg',
                'icon'     => 'bi-shop',
                'color'    => 'orange',
                'order'    => 6,
            ],

        ];

        foreach ($data as $item) {
            Facility::updateOrCreate(
                ['title' => $item['title']],
                $item
            );
        }
    }
}