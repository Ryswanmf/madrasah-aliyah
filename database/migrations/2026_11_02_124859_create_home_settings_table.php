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
        Schema::create('home_settings', function (Blueprint $table) {
            $table->id();
            $table->text('ticker_text')->nullable();
            $table->boolean('is_ticker_active')->default(true);
            $table->string('welcome_badge')->nullable()->default('Sambutan Pengasuh');
            $table->string('welcome_title')->nullable()->default('Pondok Pesantren Darun Najah');
            $table->string('welcome_subtitle')->nullable()->default('Sambikarto, Sekampung, Lampung Timur');
            $table->text('welcome_quote')->nullable();
            $table->string('leader_name')->nullable()->default('KH. Sahlan Abdulloh & KH. Abdul Ghofar, S.Pd.I');
            $table->string('leader_role')->nullable()->default('Pengasuh Pondok Pesantren');
            $table->string('leader_image')->nullable();
            $table->string('school_level')->nullable()->default('Madrasah Aliyah');
            $table->string('accreditation_status')->nullable()->default('Terakreditasi');
            $table->string('badge_stat_1')->nullable()->default('Kurikulum Kemenag & Salaf');
            $table->string('badge_stat_2')->nullable()->default('Santri Mukim & Non-Mukim');
            $table->string('badge_stat_3')->nullable()->default('Beasiswa Tahfidz Qur\'an');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_settings');
    }
};
