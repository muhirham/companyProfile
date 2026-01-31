<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_values', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();       // deskripsi nilai perusahaan
            $table->string('image_path')->nullable();  // foto kecil nilai perusahaan
            $table->integer('order')->default(0);      // urutan tampil
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_values');
    }
};
