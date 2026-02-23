<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            // basic info
            $table->string('name'); 
            $table->string('slug')->unique();

            // installation | maintenance | rental
            $table->string('type');

            // konten
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            // image / banner
            $table->string('image')->nullable();

            // status
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};

