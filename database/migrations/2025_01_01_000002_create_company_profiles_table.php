<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();       // Nama perusahaan
            $table->string('tagline')->nullable();            // “Find Out More About Us” / slogan singkat

            $table->text('short_description')->nullable();    // paragraf pendek (yang miring / italic)
            $table->longText('description')->nullable();      // deskripsi panjang (paragraf bawah)

            $table->string('about_image')->nullable();        // gambar di sebelah kiri (ganti about.jpg)

            // Contact info
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();

            // Sosial media (buat header/footer)
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('youtube_url')->nullable();

            $table->text('map_embed_url')->nullable();        // buat section Contact / footer map
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_profiles');
    }
};
