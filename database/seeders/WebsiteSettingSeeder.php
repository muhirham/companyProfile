<?php

namespace Database\Seeders;

use App\Models\WebsiteSetting;
use Illuminate\Database\Seeder;

class WebsiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $address = 'PT. Bach Multi Global Jakarta';
        $zoom = 18;

        WebsiteSetting::updateOrCreate(
            ['id' => 1],
            [
                'whatsapp_number' => '6281234567890',
                'address' => $address,
                'map_zoom' => $zoom,
                'map_embed_url' =>
                    "https://www.google.com/maps?q=" . urlencode($address) . "&z={$zoom}&output=embed",

                'wa_template' => "Halo {name},

                    Terima kasih atas inquiry Anda mengenai:
                    {brand} {model}

                    Catatan:
                    {note}

                    Tim kami akan segera menghubungi Anda."
            ]
        );
    }
}