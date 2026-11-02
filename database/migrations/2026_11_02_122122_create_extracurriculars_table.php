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
        Schema::create('extracurriculars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->default('seni')->index(); // seni, olahraga, organisasi, vokasi
            $table->string('badge')->nullable(); // e.g. Seni Islami, Bela Diri NU
            $table->string('icon')->nullable(); // FontAwesome icon e.g. fa-solid fa-drum
            $table->string('color')->default('emerald'); // emerald, red, purple, blue, amber
            $table->string('schedule')->nullable(); // e.g. Selasa & Sabtu Sore (16.00 WIB)
            $table->string('coach')->nullable(); // e.g. Ustadz Ahmad & Tim Ash-Shofwah
            $table->text('description');
            $table->string('image')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extracurriculars');
    }
};
