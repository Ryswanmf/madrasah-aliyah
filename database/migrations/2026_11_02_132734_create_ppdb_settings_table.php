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
        Schema::create('ppdb_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_open')->default(true);
            $table->string('academic_year')->default('2026/2027');
            $table->string('wave_name')->default('Gelombang 1 (Reguler & Beasiswa)');
            $table->string('wave_period')->nullable()->default('1 Januari – 31 Maret 2026');
            $table->string('quota_info')->nullable()->default('Kuota Terbatas: 120 Santri Baru');
            $table->text('closed_message')->nullable();
            
            // Alur Pendaftaran (Langkah 1 - 4)
            $table->string('step_1_title')->default('Pengisian Formulir Online');
            $table->text('step_1_desc')->nullable();
            $table->string('step_2_title')->default('Konfirmasi WhatsApp Panitia');
            $table->text('step_2_desc')->nullable();
            $table->string('step_3_title')->default('Verifikasi Berkas Fisik');
            $table->text('step_3_desc')->nullable();
            $table->string('step_4_title')->default('Pengumuman & Daftar Ulang');
            $table->text('step_4_desc')->nullable();

            // Dokumen Persyaratan (Text baris demi baris atau list)
            $table->text('requirements')->nullable();

            // Kontak Khusus Panitia PPDB (Opsional jika beda dari kontak utama)
            $table->string('contact_phone')->nullable();
            $table->string('contact_name')->nullable()->default('Panitia Sekretariat PPDB');
            $table->text('contact_wa_template')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_settings');
    }
};
