<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            StatisticSeeder::class,
            SchoolFeatureSeeder::class,
            AnnouncementSeeder::class,
            SchoolProfileSeeder::class,
            ProgramSeeder::class,
            FacilitySeeder::class,
            AchievementSeeder::class,
            GalleryPhotoSeeder::class,
            ProductSeeder::class,
            PpdbInfoSeeder::class,
            PpdbScheduleSeeder::class,
            PpdbPathwaySeeder::class,
            ContactInfoSeeder::class,
            AdminSeeder::class,
        ]);
    }
}