<?php

namespace Database\Seeders;

use App\Models\Statistic;
use Illuminate\Database\Seeder;

class StatisticSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['label' => 'Siswa Aktif',              'value' => '1.079+', 'icon' => 'bi-people-fill',        'order' => 1],
            ['label' => 'Guru & Tenaga Kependidikan','value' => '56+',    'icon' => 'bi-person-workspace',   'order' => 2],
            ['label' => 'Ekstrakurikuler',           'value' => '11+',    'icon' => 'bi-trophy-fill',        'order' => 3],
            ['label' => 'Program Jurusan',           'value' => '4',      'icon' => 'bi-mortarboard-fill',   'order' => 4],
        ];

        foreach ($data as $item) {
            Statistic::updateOrCreate(['label' => $item['label']], $item);
        }
    }
}