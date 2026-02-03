<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomepageSetting;

class HomepageSettingSeeder extends Seeder
{
    public function run(): void
    {
        HomepageSetting::firstOrCreate(
            [],
            [
                // HERO TEXT
                'hero_title'    => 'Solusi Genset Terpercaya untuk Kebutuhan Industri Anda',
                'hero_subtitle' => 'Kami menyediakan layanan penjualan, sewa, dan perawatan genset dengan dukungan tim profesional.',

                // OPTIONAL CTA
                'hero_button_text' => 'Lihat Produk',
                'hero_button_url'  => '#',

                // HERO SLIDER (JSON ARRAY OF OBJECTS)
                'hero_images' => [
                    [
                        'id'    => 'slide_1',
                        'image' => 'hero/slide1.jpg',
                    ],
                    [
                        'id'    => 'slide_2',
                        'image' => 'hero/slide2.jpg',
                    ],
                    [
                        'id'    => 'slide_3',
                        'image' => 'hero/slide3.jpg',
                    ],
                    [
                        'id'    => 'slide_4',
                        'image' => 'hero/slide4.jpg',
                    ],
                ],

                // OPTIONAL HIGHLIGHT
                'highlight_title' => 'Layanan 24/7',
                'highlight_body'  => 'Tim kami siap membantu kebutuhan genset Anda kapan saja dengan respon cepat dan profesional.',

                // TRUST COUNTER
                'years_experience'    => 10,
                'projects_completed'  => 250,
                'support_service'     => 24,
            ]
        );
    }
}
