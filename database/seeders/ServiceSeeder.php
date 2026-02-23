<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                
        DB::table('services')->insert([
            [
                'name' => 'Installation Genset',
                'slug' => 'installation-genset',
                'type' => 'installation',
                'short_description' => 'Layanan instalasi genset profesional untuk kebutuhan industri, gedung, dan komersial.',
                'description' => 'Kami menyediakan layanan instalasi genset secara profesional dan terstandarisasi untuk berbagai kebutuhan seperti industri, gedung perkantoran, rumah sakit, hingga proyek komersial. 
                Proses instalasi meliputi pemasangan unit genset, sistem kelistrikan, panel kontrol, exhaust system, serta pengujian performa agar genset siap digunakan dengan aman dan optimal.',
                'image' => 'installation.jpg',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Maintenance Genset',
                'slug' => 'maintenance-genset',
                'type' => 'maintenance',
                'short_description' => 'Perawatan dan servis genset berkala untuk menjaga performa dan keandalan.',
                'description' => 'Layanan maintenance genset kami dirancang untuk menjaga performa genset tetap optimal dan memperpanjang usia pakai mesin. 
                Perawatan meliputi pengecekan sistem bahan bakar, pelumasan, pendinginan, sistem kelistrikan, serta penggantian sparepart sesuai standar pabrikan. Cocok untuk kontrak servis berkala maupun perawatan insidental.',
                'image' => 'maintenance.jpg',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rental Genset',
                'slug' => 'rental-genset',
                'type' => 'rental',
                'short_description' => 'Sewa genset berbagai kapasitas untuk kebutuhan sementara dan darurat.',
                'description' => 'Kami menyediakan layanan rental genset dengan berbagai pilihan kapasitas untuk kebutuhan proyek, event, backup listrik darurat, maupun kegiatan operasional sementara. 
                Unit genset kami terawat, siap pakai, dan didukung oleh teknisi berpengalaman untuk instalasi, standby, hingga pembongkaran setelah masa sewa berakhir.',
                'image' => 'rental.jpg',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
