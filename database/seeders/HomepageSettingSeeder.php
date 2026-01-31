<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomepageSetting;

class HomepageSettingSeeder extends Seeder
{
    public function run(): void
    {
        HomepageSetting::firstOrCreate([], [
            'hero_title'       => 'Solusi Genset Terpercaya untuk Kebutuhan Industri Anda',
            'hero_subtitle'    => 'Kami menyediakan layanan penjualan, sewa, dan perawatan genset dengan dukungan tim profesional.',
            'hero_button_text' => 'Lihat Produk',
            'hero_button_url'  => '#',
            'hero_image'       => null,
            'highlight_title'  => 'Layanan 24/7',
            'highlight_body'   => 'Tim kami siap membantu kebutuhan genset Anda kapan saja dengan respon cepat dan profesional.',
        ]);
    }
}
