<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        Achievement::query()->delete();

        $data = [
            [
                'title'    => 'Juara 2 LKS Tingkat Kota ',
                'subtitle' => 'Bidang Cyber security',
                'meta'     => 'Tingkat Kota - 2026',
                'image'    => 'images/achievements/prestasi1.png',
                'order'    => 1,
            ],
            [
                'title'    => 'Medali Emas Kejuaraan Pencak Silat',
                'subtitle' => 'Kategori Regu Putri',
                'meta'     => 'Kejuaraan Pencak Silat IPB Championship  - 2026',
                'image'    => 'images/achievements/prestasi2.png',
                'order'    => 2,
            ],
            [
                'title'    => 'Juara futsal',
                'subtitle' => 'IBG CHAMPIONSHIP FESTIVAL',
                'meta'     => 'Tingkat SMA/K Sederajat - 2026',
                'image'    => 'images/achievements/prestasi3.png',
                'order'    => 3,
            ],
            [
                'title'    => 'Juara 1 PMR',
                'subtitle' => 'Ekstrakulikuler PMR',
                'meta'     => 'Tingkat Sekolah - 2026',
                'image'    => 'images/achievements/prestasi4.png',
                'order'    => 4,
            ],
        ];

        foreach ($data as $item) {
            Achievement::updateOrCreate(['title' => $item['title']], $item);
        }
    }
}