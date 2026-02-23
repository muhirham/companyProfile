<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyProfile;

class CompanyProfileSeeder extends Seeder
{
    public function run(): void
    {
        CompanyProfile::firstOrCreate([], [
            'description' => '
                <p>
                    Berdiri sejak tahun 2006, <strong>PT. BACH MULTI GLOBAL</strong> merupakan
                    perusahaan penyedia mesin pembangkit listrik berbahan bakar diesel
                    (<em>Diesel Genset</em>) dengan kapasitas daya mulai dari
                    <strong>5 kVA hingga 3000 kVA</strong>.
                </p>

                <p>
                    Perusahaan kami juga merupakan agen tunggal produk
                    <strong>HIMOINSA (Spain)</strong> yang dikenal sebagai salah satu
                    produsen genset terbesar di Eropa.
                </p>

                <p>
                    Dengan dukungan tenaga profesional, kami telah berhasil menangani
                    berbagai kebutuhan genset industri di seluruh Indonesia.
                </p>
            ',
            'about_image' => null, // default dulu
        ]);
    }
}
