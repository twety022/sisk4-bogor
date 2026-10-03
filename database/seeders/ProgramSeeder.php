<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'code'        => 'PPLG',
                'slug'        => 'pplg',
                'image'       => 'images/programs/pplg.jpg',
                'name'        => 'Pengembangan Perangkat Lunak dan Gim',
                'description' => 'Membekali siswa kemampuan pemrograman, pengembangan aplikasi, dan pembuatan gim sesuai kebutuhan industri digital.',
                'full_description' => "Program Keahlian Pengembangan Perangkat Lunak dan Gim (PPLG) membekali siswa dengan kompetensi merancang, membangun, dan menguji aplikasi perangkat lunak maupun gim digital.\n\nSiswa belajar mulai dari dasar pemrograman, basis data, pengembangan aplikasi web dan mobile, hingga pembuatan gim menggunakan game engine yang umum dipakai industri. Pembelajaran menekankan praktik langsung lewat proyek nyata, termasuk kerja sama dengan dunia usaha dan dunia industri (DUDI).",
                'competencies' => [
                    'Dasar pemrograman (Python, Java, Kotlin)',
                    'Pengembangan aplikasi web & mobile',
                    'Basis data dan manajemen data',
                    'Pengembangan gim dengan game engine',
                    'UI/UX design dasar',
                ],
                'career_prospects' => [
                    'Software Developer / Programmer',
                    'Mobile App Developer',
                    'Game Developer',
                    'UI/UX Designer',
                    'Quality Assurance Tester',
                ],
                'icon'        => 'bi-controller',
                'color'       => 'purple',
                'order'       => 1,
            ],
            [
                'code'        => 'TJKT',
                'slug'        => 'tjkt',
                'image'       => 'images/programs/tjkt.jpg',
                'name'        => 'Teknik Jaringan Komputer dan Telekomunikasi',
                'description' => 'Mempelajari instalasi, konfigurasi, dan perawatan jaringan komputer serta sistem telekomunikasi.',
                'full_description' => "Program Keahlian Teknik Jaringan Komputer dan Telekomunikasi (TJKT) membekali siswa dengan kompetensi merancang, memasang, dan memelihara infrastruktur jaringan komputer serta sistem telekomunikasi.\n\nSiswa berlatih langsung menggunakan perangkat jaringan standar industri, mulai dari konfigurasi router dan switch, instalasi kabel jaringan, hingga administrasi server dan keamanan jaringan.",
                'competencies' => [
                    'Instalasi & konfigurasi jaringan LAN/WAN',
                    'Administrasi server',
                    'Keamanan jaringan (network security)',
                    'Instalasi sistem telekomunikasi',
                    'Troubleshooting jaringan',
                ],
                'career_prospects' => [
                    'Network Engineer',
                    'System Administrator',
                    'IT Support / Technician',
                    'Technical Support Provider Internet',
                ],
                'icon'        => 'bi-hdd-network',
                'color'       => 'blue',
                'order'       => 2,
            ],
            [
                'code'        => 'TO',
                'slug'        => 'to',
                'image'       => 'images/programs/to.jpg',
                'name'        => 'Teknik Otomotif',
                'description' => 'Membekali siswa kompetensi perawatan dan perbaikan kendaraan bermotor sesuai standar industri otomotif.',
                'full_description' => "Program Keahlian Teknik Otomotif membekali siswa dengan kompetensi perawatan, perbaikan, dan diagnosis kerusakan kendaraan bermotor, baik mesin konvensional maupun kendaraan dengan teknologi terkini.\n\nSiswa berlatih langsung di bengkel praktik sekolah yang dilengkapi peralatan sesuai standar industri, serta menjalani praktik kerja lapangan di bengkel resmi mitra sekolah.",
                'competencies' => [
                    'Perawatan berkala kendaraan bermotor',
                    'Perbaikan sistem mesin, kelistrikan, dan sasis',
                    'Diagnosis kerusakan kendaraan',
                    'Penggunaan alat ukur & diagnostik otomotif',
                ],
                'career_prospects' => [
                    'Mekanik / Teknisi Otomotif',
                    'Service Advisor',
                    'Quality Control Bengkel',
                    'Wirausaha bengkel',
                ],
                'icon'        => 'bi-car-front-fill',
                'color'       => 'green',
                'order'       => 3,
            ],
            [
                'code'        => 'TPFL',
                'slug'        => 'tpfl',
                'image'       => 'images/programs/tpfl.jpg',
                'name'        => 'Teknik Pengelasan dan Fabrikasi Logam',
                'description' => 'Mempelajari teknik pengelasan, pembentukan, dan fabrikasi logam sesuai standar keselamatan kerja industri.',
                'full_description' => "Program Keahlian Teknik Pengelasan dan Fabrikasi Logam (TPFL) membekali siswa dengan kompetensi pengelasan berbagai jenis logam serta proses fabrikasi sesuai standar keselamatan kerja industri.\n\nSiswa berlatih menggunakan berbagai teknik pengelasan (SMAW, GMAW/MIG, GTAW/TIG) serta proses pembentukan dan perakitan logam untuk keperluan konstruksi maupun manufaktur.",
                'competencies' => [
                    'Teknik pengelasan SMAW, MIG, dan TIG',
                    'Pembacaan gambar teknik',
                    'Pembentukan & fabrikasi logam',
                    'Keselamatan dan kesehatan kerja (K3)',
                ],
                'career_prospects' => [
                    'Welder / Juru Las',
                    'Teknisi Fabrikasi Logam',
                    'Quality Control Konstruksi Logam',
                    'Wirausaha bengkel las',
                ],
                'icon'        => 'bi-fire',
                'color'       => 'orange',
                'order'       => 4,
            ],
        ];

        foreach ($data as $item) {
            Program::updateOrCreate(['code' => $item['code']], $item);
        }
    }
}
