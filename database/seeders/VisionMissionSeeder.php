<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VisionMission;

class VisionMissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // optional: kosongin dulu
        VisionMission::truncate();

        VisionMission::create([
            'vision'  => 'Menjadi perusahaan penyedia solusi genset yang andal dan terpercaya.',
            'mission' => "1. Memberikan layanan terbaik kepada pelanggan.\n2. Menyediakan produk berkualitas tinggi.\n3. Mendukung operasional pelanggan dengan solusi energi yang stabil.",
        ]);
    }
}
