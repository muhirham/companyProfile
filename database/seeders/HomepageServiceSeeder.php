<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomepageService;

class HomepageServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'Genset',
                'subtitle' => 'Industrial power',
                'icon' => '⚡',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Lighting Tower',
                'subtitle' => 'Project lighting',
                'icon' => '💡',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Maintenance',
                'subtitle' => 'Professional service',
                'icon' => '🛠',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Spare Parts',
                'subtitle' => 'Original parts',
                'icon' => '📦',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            HomepageService::create($service);
        }
    }
}
