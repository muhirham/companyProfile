<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GensetSpec;
use App\Models\GensetInquiry;


class QuoteRequestSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua spec yang sudah ada
        $specs = GensetSpec::all();

        if ($specs->count() === 0) {
            $this->command->info('No genset specs found. Run GensetSeeder first.');
            return;
        }

        // Generate 20 dummy quote requests
        for ($i = 1; $i <= 2; $i++) {

            $spec = $specs->random();

            GensetInquiry::create([
                'name' => fake()->name(),
                'email' => fake()->safeEmail(),
                'phone' => fake()->phoneNumber(),
                'address' => fake()->address(),
                'note' => fake()->sentence(),
                'brand_id' => $spec->brand_id,
                'genset_spec_id' => $spec->id,
                'status' => collect(['new','contacted','closed','deal'])->random()
            ]);
        }
    }
}