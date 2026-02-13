<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\GensetSpec;

class GensetSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            'Himoinsa',
            'Yanmar',
            'Kubota',
            'Perkins',
            'Cummins',
            'Doosan',
            'Mitsubishi',
            'MTU',
            'FPT'
        ];

        foreach ($brands as $brandName) {

            $brand = Brand::create([
                'name' => $brandName,
                'slug' => Str::slug($brandName),
                'logo' => null,
                'is_active' => true,
            ]);

            // Dummy specs + image kosong (fallback nanti dari accessor)
            GensetSpec::create([
                'brand_id' => $brand->id,
                'model' => 'APP10',
                'engine' => '4030x11G',
                'alternator' => 'PI044E',
                'kva' => 10,
                'kw' => 8,
                'fuel' => 2.8,
                'image' => null
            ]);

            GensetSpec::create([
                'brand_id' => $brand->id,
                'model' => 'APP20',
                'engine' => '4030x11G',
                'alternator' => 'PI044E',
                'kva' => 20,
                'kw' => 16,
                'fuel' => 5.3,
                'image' => null
            ]);

            GensetSpec::create([
                'brand_id' => $brand->id,
                'model' => 'APP30',
                'engine' => '4030x11G',
                'alternator' => 'PI044E',
                'kva' => 30,
                'kw' => 24,
                'fuel' => 7.2,
                'image' => null
            ]);
        }
    }
}
