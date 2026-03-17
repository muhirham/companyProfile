<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('genset_spec_model_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('genset_spec_id')
                  ->constrained('genset_specs')
                  ->onDelete('cascade');

            // FIELD TAMBAHAN DETAIL MODEL
            $table->string('tipe_mesin')->nullable();
            $table->string('nomor_silinder')->nullable();
            $table->string('ukuran_silinder')->nullable();

            // FIELD YANG TANDA (?) DI GAMBAR
            $table->string('bore_stroke')->nullable();

            // 7010 cc
            $table->string('displacement')->nullable();

            $table->string('kapasitas_minyak')->nullable();
            $table->string('generator')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('genset_spec_model_details');
    }
};