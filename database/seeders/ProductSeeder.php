<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Program;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $pplg = Program::where('code', 'PPLG')->first();
        $tjkt = Program::where('code', 'TJKT')->first();

        $data = [
            [
                'program_id'  => $pplg?->id,
                'title'       => 'Pilketos',
                'description' => 'Aplikasi Pemilihan Ketua OSIS berbasis web, dibuat oleh siswa PPLG untuk memudahkan proses pemungutan suara secara digital, transparan, dan real-time.',
                'image'       => 'images/products/pilketos.png',
                'link'        => null, 
                'team'        => 'Kelas XII PPLG',
                'year'        => '2026',
                'order'       => 1,
            ],
            [
                'program_id'  => $tjkt?->id,
                'title'       => 'Monitoring Jaringan Sekolah',
                'description' => 'Sistem monitoring status jaringan dan perangkat di lingkungan sekolah, dibuat oleh siswa TJKT sebagai proyek akhir kompetensi.',
                'image'       => 'images/products/monitoring-jaringan.jpg',
                'link'        => null,
                'team'        => 'Kelas XII TJKT',
                'year'        => '2026',
                'order'       => 2,
            ],
        ];

        foreach ($data as $item) {
            $item['slug'] = \Illuminate\Support\Str::slug($item['title']);
            Product::updateOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
