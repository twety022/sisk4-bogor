<?php

namespace Database\Seeders;

use App\Models\SchoolProfile;
use Illuminate\Database\Seeder;

class SchoolProfileSeeder extends Seeder
{
    public function run(): void
    {
        SchoolProfile::updateOrCreate(['id' => 1], [

            'about_content' => "SMK Negeri 4 Bogor merupakan sekolah menengah kejuruan yang berkomitmen mencetak lulusan siap kerja, berjiwa wirausaha, dan berkarakter melalui pendidikan vokasi yang berkualitas.\n\nDengan fasilitas praktik yang lengkap dan kerja sama industri yang luas, siswa dibekali kompetensi teknis sekaligus soft skill agar siap bersaing di dunia kerja maupun melanjutkan pendidikan tinggi.",

            'about_image' => 'images/profile/sekilas-sekolah.jpg',

            'about_video' => 'https://www.youtube.com/embed/s3ewgCRLeOc',

            'principal_name' => 'Drs. Mulya Murprihartono, M.Si.',

            'principal_message' => "Selamat datang di website resmi SMK Negeri 4 Bogor.\n\nKami berkomitmen untuk terus memberikan pendidikan kejuruan yang berkualitas dengan mengembangkan kompetensi, karakter, kreativitas, dan kemandirian peserta didik. Melalui pembelajaran yang relevan dengan perkembangan teknologi serta kerja sama dengan dunia usaha dan dunia industri, kami berupaya mempersiapkan lulusan agar mampu menghadapi tantangan masa depan.\n\nSemoga website ini dapat menjadi media informasi yang bermanfaat bagi siswa, orang tua, masyarakat, dan seluruh pihak yang ingin mengenal lebih jauh SMK Negeri 4 Bogor.",

            'principal_image' => 'images/profile/kepala-sekolah.jpg',
            'vision' => 'Menjadi lembaga pendidikan vokasi yang unggul, kompetitif, dan berkarakter, serta mampu menghasilkan lulusan yang siap kerja, mandiri, dan berdaya saing global.',

            'mission' => [
                'Menyelenggarakan pendidikan kejuruan yang berkualitas dan relevan dengan kebutuhan industri.',
                'Mengembangkan karakter siswa yang disiplin, jujur, dan bertanggung jawab.',
                'Membangun kerja sama aktif dengan dunia usaha dan dunia industri (DUDI).',
                'Mendorong budaya inovasi dan pemanfaatan teknologi terkini dalam pembelajaran.',
            ],

            'education_commitment' => "SMK Negeri 4 Bogor berkomitmen menciptakan lingkungan pendidikan yang mendukung perkembangan kompetensi dan karakter peserta didik. Pendidikan tidak hanya diarahkan pada penguasaan keterampilan teknis, tetapi juga pada pembentukan sikap, kreativitas, tanggung jawab, dan kemampuan beradaptasi.\n\nMelalui pembelajaran berbasis praktik, pemanfaatan teknologi, serta hubungan yang erat dengan dunia usaha dan dunia industri, sekolah terus berupaya memberikan pengalaman belajar yang relevan dengan kebutuhan masa kini dan masa depan.",

            'history_content' => "SMKN 4 Bogor resmi didirikan pada tahun 2009 sebagai jawaban atas kebutuhan tenaga kerja terampil di bidang teknologi dan rekayasa. Sejak saat itu, sekolah terus berkembang baik dari sisi fasilitas, kurikulum, maupun kerja sama dengan dunia industri.\n\nKini SMKN 4 Bogor telah menyandang status sebagai salah satu Sekolah Pusat Keunggulan (SMK PK) dan terus berinovasi untuk menghasilkan lulusan yang kompeten dan siap menghadapi tantangan dunia kerja global.",

            'history_image' => 'images/profile/sejarah-sekolah.jpg',
        ]);
    }
}