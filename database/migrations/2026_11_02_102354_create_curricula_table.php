<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('curricula', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type')->default('pilar'); // pilar, kitab, vokasi, program_unggulan
            $table->string('category')->nullable(); // kemenag, pesantren, tahfidz, vokasi, nahwu, fiqih, tauhid, etc.
            $table->string('category_label')->nullable(); // e.g., 'Nahwu & Kaidah Arab', 'Kurikulum Kemenag'
            $table->string('grade')->nullable(); // all, 10, 11, 12
            $table->string('author')->nullable(); // Muallif / Pengarang (untuk kitab turats)
            $table->string('icon')->nullable()->default('fa-solid fa-graduation-cap');
            $table->text('description')->nullable();
            $table->json('points')->nullable(); // Array of highlight points/features
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curricula');
    }
};
