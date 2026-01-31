<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyProfile;

class CompanyProfileSeeder extends Seeder
{
    public function run(): void
    {
        CompanyProfile::firstOrCreate([], [
            'company_name'      => 'PT Contoh Genset Indonesia',
            'tagline'           => 'Solusi Kelistrikan Andal untuk Industri dan Event Anda',
            'short_description' => 'PT Contoh Genset Indonesia adalah perusahaan yang fokus pada penyediaan solusi kelistrikan melalui penjualan dan penyewaan genset untuk berbagai kebutuhan industri, komersial, maupun event.',
            'description'       => 'PT Contoh Genset Indonesia merupakan perusahaan yang bergerak di bidang penyediaan solusi kelistrikan terpadu. Kami melayani kebutuhan genset untuk pabrik, gedung perkantoran, pusat perbelanjaan, rumah sakit, hingga event skala kecil maupun besar. Dengan dukungan tim teknisi berpengalaman dan armada unit yang terawat, kami berkomitmen memberikan layanan yang responsif, aman, dan terpercaya kepada seluruh pelanggan.',
            'about_image'       => null, // nanti diisi lewat upload
            'address'           => 'Jl. Contoh Raya No. 123, Jakarta Selatan',
            'phone'             => '021-1234567',
            'email'             => 'info@contohgenset.co.id',
            'website'           => 'https://www.contohgenset.co.id',
            'facebook_url'      => 'https://facebook.com/contohgenset',
            'instagram_url'     => 'https://instagram.com/contohgenset',
            'linkedin_url'      => 'https://linkedin.com/company/contohgenset',
            'youtube_url'       => 'https://youtube.com/@contohgenset',
            'map_embed_url'     => null,
        ]);
    }
}
