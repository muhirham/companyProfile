<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            \Database\Seeders\HomepageSettingSeeder::class,
            \Database\Seeders\HomepageServiceSeeder::class,
            \Database\Seeders\CompanyProfileSeeder::class,
            \Database\Seeders\CompanyValueSeeder::class,
            \Database\Seeders\VisionMissionSeeder::class,
            \Database\Seeders\ProductSeeder::class,
            \Database\Seeders\PostSeeder::class,
            \Database\Seeders\ContactMessageSeeder::class,
            \Database\Seeders\ServiceSeeder::class,
            \Database\Seeders\GensetSeeder::class,
            \Database\Seeders\QuoteRequestSeeder::class,
            
        ]);
    }
}
