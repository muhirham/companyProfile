<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | BRANDS TABLE
        |--------------------------------------------------------------------------
        */
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('logo')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | GENSET SPECS TABLE (Per Tipe + Image)
        |--------------------------------------------------------------------------
        */
        Schema::create('genset_specs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')
                  ->constrained('brands')
                  ->onDelete('cascade');

            $table->string('model');
            $table->string('engine');
            $table->string('alternator');
            $table->integer('kva');
            $table->integer('kw');
            $table->float('fuel');

            // 🔥 gambar per tipe
            $table->string('image')->nullable();

            $table->timestamps();

            // optional: prevent duplicate model per brand
            $table->unique(['brand_id','model']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('genset_specs');
        Schema::dropIfExists('brands');
    }
};
