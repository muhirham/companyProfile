<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name'           => 'Genset Diesel 20 kVA',
                'category'       => 'Diesel',
                'power_capacity' => '20 kVA',
                'description'    => 'Cocok untuk kebutuhan usaha kecil, ruko, dan cadangan rumah tangga.',
                'image_path'     => null,
                'is_active'      => true,
            ],
            [
                'name'           => 'Genset Diesel 100 kVA',
                'category'       => 'Diesel',
                'power_capacity' => '100 kVA',
                'description'    => 'Solusi ideal untuk gedung perkantoran dan industri menengah.',
                'image_path'     => null,
                'is_active'      => true,
            ],
            [
                'name'           => 'Genset Silent 500 kVA',
                'category'       => 'Silent',
                'power_capacity' => '500 kVA',
                'description'    => 'Tingkat kebisingan rendah, cocok untuk kawasan perkotaan dan rumah sakit.',
                'image_path'     => null,
                'is_active'      => true,
            ],
        ];

        foreach ($products as $data) {
            $data['slug'] = Str::slug($data['name']);
            Product::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
