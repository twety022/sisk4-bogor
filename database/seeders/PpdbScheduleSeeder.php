<?php

namespace Database\Seeders;

use App\Models\PpdbSchedule;
use Illuminate\Database\Seeder;

class PpdbScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['Tahap 1: Pemetaan Calon Murid Baru (PCMB)', '29 Mei - 8 Juni 2026',  'Prapendaftaran dan pemetaan calon murid baru.'],
            ['Tahap 1: Pendaftaran & Unggah Dokumen',     '15 - 19 Juni 2026',     'Pendaftaran dan pengunggahan dokumen untuk jalur afirmasi, prestasi, perpindahan tugas, dan lainnya.'],
            ['Tahap 1: Pengumuman Hasil Seleksi',         '25 Juni 2026',          'Hasil seleksi Tahap 1 diumumkan.'],
            ['Tahap 1: Daftar Ulang',                     '26 & 29 Juni 2026',     'Daftar ulang bagi peserta yang lulus Tahap 1.'],
            ['Tahap 2: Pendaftaran & Seleksi',            '30 Juni - 6 Juli 2026', 'Pendaftaran dan seleksi Tahap 2 untuk jalur zonasi/umum SMK sesuai ketentuan.'],
            ['Tahap 2: Pengumuman Hasil Seleksi',         '10 Juli 2026',          'Hasil seleksi Tahap 2 diumumkan.'],
            ['Tahap 2: Daftar Ulang',                     '13 - 14 Juli 2026',     'Daftar ulang bagi peserta yang lulus Tahap 2.'],
            ['Masa Pengenalan Lingkungan Sekolah (MPLS)', 'Juli 2026',             'Peserta didik baru mengikuti MPLS.'],
            ['PPDB 2026 Telah Ditutup',                   'Selesai',               'Seluruh tahapan telah selesai. Pantau website ini untuk informasi PPDB tahun berikutnya.'],
        ];

        
        PpdbSchedule::query()->delete();

        $last = count($data) - 1;
        foreach ($data as $i => [$label, $range, $desc]) {
            PpdbSchedule::create([
                'label'       => $label,
                'date_range'  => $range,
                'description' => $desc,
                'is_current'  => $i === $last, 
                'order'       => $i + 1,
            ]);
        }
    }
}