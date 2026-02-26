<?php
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {

        public function up(): void
        {
            Schema::create('genset_inquiries', function (Blueprint $table) {

                $table->id();

                // CUSTOMER INFO
                $table->string('name');
                $table->string('email');
                $table->string('phone');
                $table->text('address')->nullable();
                $table->text('note')->nullable();

                // PRODUCT INFO
                $table->foreignId('brand_id')
                    ->constrained('brands')
                    ->cascadeOnDelete();

                $table->foreignId('genset_spec_id')
                    ->constrained('genset_specs')
                    ->cascadeOnDelete();

                $table->timestamps();
            });
        }

        public function down(): void
        {
            Schema::dropIfExists('genset_inquiry');
        }
    };