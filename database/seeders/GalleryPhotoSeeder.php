<?php

namespace Database\Seeders;

use App\Models\GalleryPhoto;
use Illuminate\Database\Seeder;

class GalleryPhotoSeeder extends Seeder
{
    public function run(): void
    {
       GalleryPhoto::query()->delete();  
        $data = [
            // ft yg ikut ke beranda:
            [
                'image'        => 'images/gallery/foto1.jpg',
                'caption'      => 'Pilketos',
                'description'  => 'Foto Bersama After Pilketos SMKN 4 Bogor.',
                'taken_at'     => '2026-08-26',
                'category'     => 'momen',
                'show_on_home' => true,
                'order'        => 1,
            ],
            [
                'image'        => 'images/gallery/foto2.jpg',
                'caption'      => 'fotp bersama tim Paskibra',
                'description'  => 'foto bersama para tim pengibar bendera 17 agustus 2026',
                'taken_at'     => '2026-01-20',
                'category'     => 'kegiatan',
                'show_on_home' => true,
                'order'        => 2,
            ],
            [
                'image'        => 'images/gallery/foto3.jpg',
                'caption'      => 'Kegiatan Pramuka',
                'description'  => 'Latihan rutin ekstrakurikuler Pramuka sebagai bagian dari pembentukan karakter siswa.',
                'taken_at'     => '2026-02-03',
                'category'     => 'kegiatan',
                'show_on_home' => true,
                'order'        => 3,
            ],
            [
                'image'        => 'images/gallery/foto4.jpg',
                'caption'      => 'CLASSMEET',
                'description'  => 'Kegiatan slassmeeting siswa smkn 4 bogor',
                'taken_at'     => '2026-02-14',
                'category'     => 'event',
                'show_on_home' => true,
                'order'        => 4,
            ],
            [
                'image'        => 'images/gallery/foto5.jpg',
                'caption'      => 'Sholat dhuha bersama',
                'description'  => 'Siswa melaksanakan sholat dhuha bersama warga sekolah.',
                'taken_at'     => '2026-02-20',
                'category'     => 'event',
                'show_on_home' => true,
                'order'        => 5,
            ],
            [
                'image'        => 'images/gallery/foto6.jpg',
                'caption'      => 'Kegiatan Ekstrakurikuler',
                'description'  => 'Beragam kegiatan ekstrakurikuler digelar rutin setiap pekan untuk mengasah minat dan bakat siswa.',
                'taken_at'     => '2026-03-01',
                'category'     => 'kegiatan',
                'show_on_home' => true,
                'order'        => 6,
            ],

            // cuma di galeri
            [
                'image'        => 'images/gallery/foto7.jpg',
                'caption'      => 'Jalan Sehat',
                'description'  => 'Kegiatan Jalan sehat bersama para guru guru dan seluruh murid SMKN 4 Bogor',
                'taken_at'     => '2026-07-10',
                'category'     => 'Kegiatan',
                'show_on_home' => false,
                'order'        => 7,
            ],
            [
                'image'        => 'images/gallery/foto8.jpg',
                'caption'      => 'Keseruan Jalan Sehat',
                'description'  => 'Momen Jalan Sehat bersama Guru dan siswa SMKN 4 BOGOR ',
                'taken_at'     => '2026-07-10',
                'category'     => 'momen-siswa',
                'show_on_home' => false,
                'order'        => 8,
            ],
            [
                'image'        => 'images/gallery/foto9.jpg',
                'caption'      => 'Keseruan di Pensi Malam LDKS',
                'description'  => 'Tampilan dari para peserta LDKS',
                'taken_at'     => '2026-07-10',
                'category'     => 'Momen-siswa',
                'show_on_home' => false,
                'order'        => 9,
            ],
            [
                'image'        => 'images/gallery/foto10.jpg',
                'caption'      => 'Keseruan malam LDKS',
                'description'  => 'Malam LDKS',
                'taken_at'     => '2026-07-10',
                'category'     => 'momen-siswa',
                'show_on_home' => false,
                'order'        => 10,
            ],
            [
                'image'        => 'images/gallery/foto11.jpg',
                'caption'      => 'Kegiatan Pentas Seni SMK Negeri 4 Bogor',
                'description'  => 'Kegiatan Pentas Seni SMK Negeri 4 Bogor',
                'taken_at'     => '2025-09-25',
                'category'     => 'Event',
                'show_on_home' => false,
                'order'        => 11,
            ],
            [
                'image'        => 'images/gallery/foto12.jpg',
                'caption'      => 'Momen Penutupan LDKS 2026',
                'description'  => 'Momen Penutupan LDKS 2026',
                'taken_at'     => '2026-07-17',
                'category'     => 'momen-siswa',
                'show_on_home' => false,
                'order'        => 12,
            ],
            [
                'image'        => 'images/gallery/foto13.jpg',
                'caption'      => 'Penampilan Demo ekstrakulikuler Paduan suara',
                'description'  => 'Demo Ekstrakulikuler Paduan suara',
                'taken_at'     => '2026-17-07',
                'category'     => 'Kegiatan',
                'show_on_home' => false,
                'order'        => 13,
            ],
            [
                'image'        => 'images/gallery/foto14.jpg',
                'caption'      => 'Demo Ekstrakulikuler Paduan suara',
                'description'  => 'Demo Ekstrakulikuler Paduan suara',
                'taken_at'     => '2026-17-07',
                'category'     => 'kegiatan',
                'show_on_home' => false,
                'order'        => 14,
            ],
            [
                'image'        => 'images/gallery/foto15.jpg',
                'caption'      => 'Penampilan drama dari tim PMR',
                'description'  => 'Demo Ekstrakulikuler PMR',
                'taken_at'     => '2026-17-07',
                'category'     => 'kegiatan',
                'show_on_home' => false,
                'order'        => 15,
            ],
        ];

        foreach ($data as $item) {
            GalleryPhoto::updateOrCreate(['caption' => $item['caption']], $item);
        }
    }
}
