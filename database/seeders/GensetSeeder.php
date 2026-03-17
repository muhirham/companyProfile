<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\GensetSpec;
use App\Models\GensetSpecModelDetail;

class GensetSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            'Perkins',
        ];

        foreach ($brands as $brandName) {

            $brand = Brand::create([
                'name' => $brandName,
                'slug' => Str::slug($brandName),
                'logo' => null,
                'is_active' => true,
            ]);

            // Generate 10 specs per brand
            for ($i = 1; $i <= 4; $i++) {

                // Base KVA naik per level
                $baseKva = $i * 20;

                $prpKva = $baseKva;
                $espKva = $baseKva + 2;

                // KW kira-kira 0.8 dari KVA
                $prpKw = round($prpKva * 0.8);
                $espKw = round($espKva * 0.8);

                // Fuel random realistis
                $fuel = round(($prpKw * 0.25), 1);

                // Dimensi Open
                $lOpen = 1500 + ($i * 120);
                $wOpen = 900 + ($i * 30);
                $hOpen = 1100 + ($i * 40);
                $kgOpen = 800 + ($i * 150);

                // Dimensi Silent (lebih besar & berat)
                $lSilent = $lOpen + 300;
                $wSilent = $wOpen + 100;
                $hSilent = $hOpen + 150;
                $kgSilent = $kgOpen + 250;

                $spec = GensetSpec::create([
                    'brand_id' => $brand->id,
                    'model' => 'APP-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                    'engine' => 'Engine-' . rand(1000, 9999),
                    'alternator' => 'ALT-' . rand(100, 999),

                    'prp_kva' => $prpKva,
                    'esp_kva' => $espKva,
                    'prp_kw'  => $prpKw,
                    'esp_kw'  => $espKw,

                    'fuel' => $fuel,

                    'l_open' => $lOpen,
                    'w_open' => $wOpen,
                    'h_open' => $hOpen,
                    'kg_open' => $kgOpen,

                    'l_silent' => $lSilent,
                    'w_silent' => $wSilent,
                    'h_silent' => $hSilent,
                    'kg_silent' => $kgSilent,

                    'image' => null
                ]);

                GensetSpecModelDetail::create([
                    'genset_spec_id' => $spec->id,

                    'tipe_mesin' => $brandName,
                    'nomor_silinder' => rand(3, 8),
                    'ukuran_silinder' => rand(90, 130) . ' mm',
                    'bore_stroke' => rand(90, 130) . ' x ' . rand(100, 150) . ' mm',
                    'displacement' => rand(3000, 8000) . ' cc',
                    'kapasitas_minyak' => rand(10, 30) . ' ltr',
                    'generator' => 'GEN-' . rand(100, 999),
                ]);
            }
        }
    }
}