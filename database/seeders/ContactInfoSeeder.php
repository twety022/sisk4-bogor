<?php

namespace Database\Seeders;

use App\Models\ContactInfo;
use Illuminate\Database\Seeder;

class ContactInfoSeeder extends Seeder
{
    public function run(): void
    {
        ContactInfo::updateOrCreate(['id' => 1], [
            'address'       => 'JL. Raya Tajur, Kampung Buntar, RT 02/RW 08, Kelurahan Muarasari, Kecamatan Bogor Selatan, Kota Bogor, Jawa Barat 16137',
            'phone'         => '(0251) 7547381',
            'whatsapp'      => '089527181118', 
            'email'         => 'smkn4@smkn4bogor.sch.id',
            'office_hours'  => 'Senin - Jumat, 07.00 - 16.00 WIB',
            'map_embed_url' => 'https://www.google.com/maps?q=SMK+Negeri+4+Bogor&output=embed',
            'instagram_url' => 'https://www.instagram.com/smkn4kotabogor?utm_source=ig_web_button_share_sheet&stkn=ZDNlZDc0MzIxNw==', 
            'facebook_url'  => 'https://www.facebook.com/smknegeri4bogor/',
            'youtube_url'   => 'https://www.youtube.com/@smknegeri4bogor905',
            'tiktok_url'    => null,
        ]);
    }
}