<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyValue;

class CompanyValueSeeder extends Seeder
{
    public function run(): void
    {
        $values = [
            [
                'name'        => 'Integritas',
                'description' => 'Kami menjunjung tinggi kejujuran dan transparansi dalam setiap layanan.',
                'order'       => 1,
            ],
            [
                'name'        => 'Profesionalisme',
                'description' => 'Tim berpengalaman dengan standar kerja yang tinggi dan terukur.',
                'order'       => 2,
            ],
            [
                'name'        => 'Pelayanan Cepat',
                'description' => 'Respons cepat dan solusi tepat untuk kebutuhan kelistrikan Anda.',
                'order'       => 3,
            ],
        ];

        foreach ($values as $val) {
            CompanyValue::updateOrCreate(
                ['name' => $val['name']],
                $val
            );
        }
    }
}
