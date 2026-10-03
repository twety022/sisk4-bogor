<?php

namespace Database\Seeders;

use App\Models\PpdbInfo;
use Illuminate\Database\Seeder;

class PpdbInfoSeeder extends Seeder
{
    public function run(): void
    {
        PpdbInfo::updateOrCreate(['id' => 1], [
            'academic_year' => '2027/2028',
            'intro_content' => 'Selamat datang calon siswa-siswi SMK Negeri 4 Bogor! Ikuti tahapan Penerimaan Peserta Didik Baru (PPDB) di bawah ini untuk bergabung menjadi bagian dari keluarga besar SMKN 4 Bogor.',
            'requirements'  => [
                'Fotokopi Kartu Keluarga (KK) yang masih berlaku',
                'Fotokopi akta kelahiran',
                'Fotokopi ijazah/SKL SMP atau sederajat, dilegalisir',
                'Fotokopi rapor semester 1-5 (kelas VII-IX)',
                'Pas foto berwarna terbaru ukuran 3x4 (2 lembar)',
                'Surat keterangan sehat dari dokter/puskesmas',
            ],
            'registration_url'  => null, 
            'contact_whatsapp'  => '089527181118',
            'contact_email'     => 'ppdb@smkn4bogor.sch.id',
            'brochure_file'     => null, 
        ]);
    }
}
