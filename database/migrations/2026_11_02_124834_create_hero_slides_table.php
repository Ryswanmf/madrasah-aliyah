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
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_highlight')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('button_text')->nullable()->default('Daftar PPDB Online 2026');
            $table->string('button_url')->nullable()->default('/ppdb');
            $table->string('button_secondary_text')->nullable()->default('Hubungi Panitia (WA)');
            $table->string('button_secondary_url')->nullable();
            $table->string('badge_1')->nullable()->default('Kementerian Agama RI');
            $table->string('badge_2')->nullable()->default('Terakreditasi BAN-SM');
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
        Schema::dropIfExists('hero_slides');
    }
};
