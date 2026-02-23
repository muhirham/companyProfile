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

        // ABOUT PAGE (USER)
        $table->longText('description')->nullable(); // isi HTML summernote
        $table->string('about_image')->nullable();   // gambar kiri

        $table->timestamps();
    });

    }

    public function down(): void
    {
        Schema::dropIfExists('company_profiles');
    }
};
