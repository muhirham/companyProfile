<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('homepage_settings', function (Blueprint $table) {
            $table->id();

            // HERO
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();

            // OPTIONAL BUTTON (kalau nanti dipakai)
            $table->string('hero_button_text')->nullable();
            $table->string('hero_button_url')->nullable();

            // HERO SLIDER (JSON ARRAY OF OBJECTS)
            $table->json('hero_images')->nullable();

            // HIGHLIGHT (optional / future use)
            $table->string('highlight_title')->nullable();
            $table->text('highlight_body')->nullable();

            // TRUST COUNTER
            $table->integer('years_experience')->nullable();
            $table->integer('projects_completed')->nullable();
            $table->integer('support_service')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('homepage_settings');
    }
};
