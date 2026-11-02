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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nip_or_niy')->nullable();
            $table->string('role'); // Kepala Madrasah, Waka Kurikulum, Guru Fiqih, etc.
            $table->string('category')->default('guru_mapel'); // pimpinan, asatidz_kitab, guru_mapel, staf
            $table->string('photo')->nullable();
            $table->string('education')->nullable(); // Almamater pesantren / universitas
            $table->text('bio')->nullable();
            $table->string('phone')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_featured')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
