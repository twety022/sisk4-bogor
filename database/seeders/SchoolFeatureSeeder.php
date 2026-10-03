<?php

namespace Database\Seeders;

use App\Models\SchoolFeature;
use Illuminate\Database\Seeder;

class SchoolFeatureSeeder extends Seeder
{
    public function run(): void
    {
        
        SchoolFeature::query()->delete();

        $data = [
            [
                'year' => '2008',
                'title' => 'Pembangunan',
                'description' => 'Pembangunan awal sekolah dimulai sebagai lembaga pendidikan kejuruan berbasis Teknologi Informasi dan Komunikasi (TIK) di wilayah Bogor Selatan.',
                'is_current' => false,
                'order' => 1,
            ],
            [
                'year' => '2009',
                'title' => 'Resmi didirikan',
                'description' => 'SMKN 4 Bogor resmi didirikan sebagai sekolah kejuruan untuk menjawab kebutuhan tenaga kerja terampil.',
                'is_current' => false,
                'order' => 2,
            ],
            [
                'year' => '2019',
                'title' => 'Akreditasi A',
                'description' => 'Meraih akreditasi A yang menjadi bukti standar mutu pendidikan yang terus ditingkatkan.',
                'is_current' => false,
                'order' => 3,
            ],
            [
                'year' => 'Kini',
                'title' => 'Inovasi Global',
                'description' => 'Terus berinovasi dalam kurikulum dan kerja sama industri agar siap bersaing di tingkat global.',
                'is_current' => true,
                'order' => 4,
            ],
        ];

        foreach ($data as $item) {
            SchoolFeature::create($item);
        }
    }
}