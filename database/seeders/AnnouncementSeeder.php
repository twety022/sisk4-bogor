<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'title'       => 'Siswa SMKN 4 Bogor Kembali Meraih Prestasi!',
                'type'        => 'berita',
                'category'    => 'prestasi',
                'tags'        => ['Prestasi', 'Lomba', 'Tarik Tambang'],
                'image'       => 'images/news/biabersama.jpg',
                'excerpt'     => 'Tim SMKN 4 Bogor berhasil meraih juara pada perlombaan tarik tambang tingkat kota, menambah daftar prestasi membanggakan sekolah.',
                'content'     => "BOGOR — SMKN 4 Bogor kembali menorehkan prestasi membanggakan setelah tim perwakilan sekolah berhasil meraih juara pada perlombaan tarik tambang tingkat kota yang diikuti puluhan sekolah se-Kota Bogor.\n\nKemenangan ini merupakan hasil dari latihan rutin dan kekompakan tim yang telah dipersiapkan sejak beberapa minggu sebelumnya. Semangat pantang menyerah dan kerja sama tim menjadi kunci utama keberhasilan ini.\n\nPihak sekolah menyampaikan apresiasi tinggi kepada seluruh siswa yang telah berjuang, serta berharap prestasi ini dapat memotivasi siswa lain untuk terus berprestasi di berbagai bidang.",
                'pull_quote'  => 'Kemenangan ini bukan hanya soal juara, tapi bukti nyata bahwa kerja sama dan semangat pantang menyerah selalu membuahkan hasil.',
                'is_featured' => true,
                'published_at'=> now()->subDays(1),
            ],
            [
                'title'       => 'Siswa SMKN 4 Bogor Mengikuti Tes TOEIC',
                'type'        => 'berita',
                'category'    => 'akademik',
                'tags'        => ['Paskibra', '17 agustus', 'Upacara'],
                'image'       => 'images/news/upacara.jpg',
                'excerpt'     => 'Tes TOEIC diselenggarakan untuk mengukur kemampuan Bahasa Inggris siswa kelas XII sebagai bekal memasuki dunia kerja.',
                'content'     => "Sebanyak 120 siswa kelas XII SMKN 4 Bogor mengikuti Tes TOEIC (Test of English for International Communication) yang diselenggarakan di aula sekolah.\n\nTes ini bertujuan mengukur kemampuan Bahasa Inggris siswa, khususnya dalam konteks komunikasi profesional, sebagai salah satu bekal penting menghadapi dunia kerja maupun melanjutkan pendidikan tinggi.\n\nHasil tes ini juga akan menjadi salah satu pertimbangan sekolah dalam menyusun program peningkatan kompetensi bahasa asing bagi siswa di tahun ajaran berikutnya.",
                'is_featured' => false,
                'published_at'=> now()->subDays(3),
            ],
            [
                'title'       => 'Demo Ekstrakurikuler SMKN 4 Bogor',
                'type'        => 'berita',
                'category'    => 'kegiatan',
                'tags'        => ['Ekstrakurikuler', 'Bakat Minat'],
                'image'       => 'images/news/bia.jpg',
                'excerpt'     => 'Pengenalan ragam ekstrakurikuler sekolah kepada siswa baru melalui penampilan demo dari setiap unit kegiatan.',
                'content'     => "Dalam rangka mengenalkan ragam kegiatan ekstrakurikuler kepada siswa baru, SMKN 4 Bogor menggelar acara Demo Ekstrakurikuler yang diikuti oleh seluruh unit kegiatan siswa (UKS), mulai dari Paskibra, Pramuka, PMR, hingga klub-klub minat bakat lainnya.\n\nSetiap unit menampilkan atraksi dan penjelasan singkat mengenai kegiatan masing-masing, dengan harapan siswa baru dapat menemukan wadah yang sesuai dengan minat dan bakatnya.",
                'is_featured' => false,
                'published_at'=> now()->subDays(5),
            ],
            [
                'title'       => 'Pemanfaatan AI di SMKN 4 Bogor',
                'type'        => 'berita',
                'category'    => 'akademik',
                'tags'        => ['Teknologi', 'AI', 'Inovasi'],
                'image'       => 'images/news/maulid.png',
                'excerpt'     => 'Kegiatan pemanfaatan AI di SMKN 4 Bogor yang diselenggarakan untuk membekali guru dan siswa dalam menghadapi perkembangan teknologi.',
                'content'     => "SMKN 4 Bogor mengadakan workshop pemanfaatan kecerdasan buatan (AI) dalam proses pembelajaran, yang diikuti oleh guru dan perwakilan siswa dari berbagai program keahlian.\n\nWorkshop ini membahas bagaimana AI dapat dimanfaatkan secara etis dan produktif, baik untuk membantu proses belajar mengajar maupun untuk meningkatkan efisiensi tugas administratif di sekolah.",
                'is_featured' => false,
                'published_at'=> now()->subDays(7),
            ],
            [
                'title'       => 'Pelaksanaan Maulid Nabi',
                'type'        => 'pengumuman',
                'category'    => 'pengumuman',
                'tags'        => ['Keagamaan', 'Peringatan Hari Besar'],
                'image'       => 'images/news/TOEIC.png',
                'excerpt'     => 'Peringatan Maulid Nabi Muhammad SAW diselenggarakan dengan penuh khidmat oleh seluruh warga sekolah.',
                'content'     => "SMKN 4 Bogor menyelenggarakan peringatan Maulid Nabi Muhammad SAW yang diisi dengan pembacaan shalawat, tausiyah, serta doa bersama.\n\nKegiatan ini diikuti oleh seluruh siswa, guru, dan tenaga kependidikan sebagai bentuk syiar dan penguatan nilai-nilai keagamaan di lingkungan sekolah.",
                'is_featured' => false,
                'published_at'=> now()->subDays(9),
            ],
            [
                'title'       => 'Kunjungan Industri Jurusan TKJ',
                'type'        => 'berita',
                'category'    => 'kegiatan',
                'tags'        => ['Kunjungan Industri', 'TJKT'],
                'image'       => 'images/news/psikolog.png',
                'excerpt'     => 'Siswa jurusan TJKT melaksanakan kunjungan industri guna menambah wawasan dunia kerja.',
                'content'     => "Siswa jurusan Teknik Jaringan Komputer dan Telekomunikasi (TJKT) SMKN 4 Bogor melaksanakan kunjungan industri ke salah satu perusahaan penyedia layanan jaringan di Bogor.\n\nKegiatan ini bertujuan memberikan gambaran nyata tentang penerapan kompetensi yang dipelajari di sekolah dalam dunia kerja sesungguhnya, sekaligus membangun jejaring dengan dunia usaha dan dunia industri (DUDI).",
                'is_featured' => false,
                'published_at'=> now()->subDays(11),
            ],
        ];

        foreach ($data as $item) {
            $item['slug'] = Str::slug($item['title']);

            Announcement::updateOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
