<?php

namespace Database\Seeders;

use App\Models\PpdbPathway;
use Illuminate\Database\Seeder;

class PpdbPathwaySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name'        => 'Jalur Zonasi',
                'description' => 'Untuk calon siswa yang berdomisili di wilayah zonasi sekolah sesuai ketentuan yang berlaku.',
                'icon'        => 'bi-geo-alt-fill',
                'color'       => 'blue',
                'quota'       => '50% dari total daya tampung',
                'order'       => 1,
            ],
            [
                'name'        => 'Jalur Prestasi',
                'description' => 'Untuk calon siswa dengan prestasi akademik maupun non-akademik yang dibuktikan dengan sertifikat/piagam.',
                'icon'        => 'bi-trophy-fill',
                'color'       => 'orange',
                'quota'       => '30% dari total daya tampung',
                'order'       => 2,
            ],
            [
                'name'        => 'Jalur Afirmasi',
                'description' => 'Untuk calon siswa dari keluarga kurang mampu yang dibuktikan dengan Kartu Keluarga Sejahtera (KKS) atau bukti lain yang sah.',
                'icon'        => 'bi-heart-fill',
                'color'       => 'green',
                'quota'       => '15% dari total daya tampung',
                'order'       => 3,
            ],
            [
                'name'        => 'Jalur Perpindahan Tugas Orang Tua',
                'description' => 'Untuk calon siswa yang orang tua/walinya berpindah tugas, dibuktikan dengan surat penugasan resmi.',
                'icon'        => 'bi-briefcase-fill',
                'color'       => 'purple',
                'quota'       => '5% dari total daya tampung',
                'order'       => 4,
            ],
        ];

        foreach ($data as $item) {
            PpdbPathway::updateOrCreate(['name' => $item['name']], $item);
        }
    }
}
