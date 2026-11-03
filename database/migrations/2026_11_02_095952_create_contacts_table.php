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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Sekretariat & Panitia PPDB');
            $table->string('pic_name')->nullable()->comment('Nama Penanggung Jawab / Petugas');
            $table->string('phone', 30)->default('0856-5897-3426');
            $table->string('whatsapp', 30)->default('085658973426');
            $table->string('email', 100)->default('mudarunnajah60@gmail.com');
            $table->text('address')->nullable();
            $table->string('office_hours')->default('Senin - Sabtu: 07.30 - 14.00 WIB');
            $table->text('maps_embed_url')->nullable();
            $table->string('maps_link')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('tiktok_url')->nullable();
            $table->text('default_wa_message')->nullable();
            $table->boolean('is_primary')->default(true);
            $table->boolean('is_active')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
