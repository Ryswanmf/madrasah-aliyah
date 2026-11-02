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
        Schema::table('home_settings', function (Blueprint $table) {
            // 1. Identitas & Logo
            $table->string('site_name')->nullable()->default('PPDN Darun Najah');
            $table->string('site_tagline')->nullable()->default('Madrasah Aliyah • Sambikarto, Sekampung');
            $table->string('site_logo')->nullable();
            $table->string('site_favicon')->nullable();
            $table->string('foundation_head')->nullable()->default('Suparno, S.Pd.I');

            // 2. Profil Lembaga & Visi Misi
            $table->string('profile_title')->nullable()->default('Mengenal Lebih Dekat MA Darun Najah Sambikarto');
            $table->text('profile_highlight')->nullable();
            $table->text('profile_description')->nullable();
            $table->string('profile_image')->nullable();
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();

            // 3. Empat Pilar Nilai Keunggulan
            $table->string('pillar_1_title')->nullable()->default('Aswaja NU');
            $table->string('pillar_1_desc')->nullable()->default('Akidah & Amaliah');
            $table->string('pillar_1_icon')->nullable()->default('fa-solid fa-star-and-crescent');

            $table->string('pillar_2_title')->nullable()->default('Tafaqquh Fiddin');
            $table->string('pillar_2_desc')->nullable()->default('Kitab Turats Salaf');
            $table->string('pillar_2_icon')->nullable()->default('fa-solid fa-book-quran');

            $table->string('pillar_3_title')->nullable()->default('Sains Modern');
            $table->string('pillar_3_desc')->nullable()->default('Wawasan Akademis');
            $table->string('pillar_3_icon')->nullable()->default('fa-solid fa-microscope');

            $table->string('pillar_4_title')->nullable()->default('Kemandirian');
            $table->string('pillar_4_desc')->nullable()->default('Life Skills Santri');
            $table->string('pillar_4_icon')->nullable()->default('fa-solid fa-hand-holding-hand');

            // 4. Counter Statistik Madrasah
            $table->boolean('is_stats_active')->default(true);
            $table->string('stat_students_count')->nullable()->default('350+');
            $table->string('stat_students_label')->nullable()->default('Santri Mukim & Reguler');
            $table->string('stat_teachers_count')->nullable()->default('28');
            $table->string('stat_teachers_label')->nullable()->default('Dewan Asatidz & Guru');
            $table->string('stat_classes_count')->nullable()->default('12');
            $table->string('stat_classes_label')->nullable()->default('Ruang Kelas & Lab');
            $table->string('stat_alumni_count')->nullable()->default('1.200+');
            $table->string('stat_alumni_label')->nullable()->default('Alumni Tersebar');

            // 5. Empat Kartu Akses Cepat di Bawah Hero
            $table->string('quick_card_1_title')->nullable()->default('PPDB Online 2026');
            $table->string('quick_card_1_desc')->nullable()->default('Pendaftaran & Cek Status');
            $table->string('quick_card_1_url')->nullable()->default('/ppdb');
            $table->string('quick_card_1_icon')->nullable()->default('fa-solid fa-graduation-cap');

            $table->string('quick_card_2_title')->nullable()->default('Kurikulum Terpadu');
            $table->string('quick_card_2_desc')->nullable()->default('Kemenag RI & Kitab Kuning');
            $table->string('quick_card_2_url')->nullable()->default('/kurikulum');
            $table->string('quick_card_2_icon')->nullable()->default('fa-solid fa-book-open');

            $table->string('quick_card_3_title')->nullable()->default('Sarana & Asrama');
            $table->string('quick_card_3_desc')->nullable()->default('Gedung & Komplek Mukim');
            $table->string('quick_card_3_url')->nullable()->default('/fasilitas');
            $table->string('quick_card_3_icon')->nullable()->default('fa-solid fa-building-columns');

            $table->string('quick_card_4_title')->nullable()->default('Warta & Berita');
            $table->string('quick_card_4_desc')->nullable()->default('Prestasi & Agenda Madrasah');
            $table->string('quick_card_4_url')->nullable()->default('/berita');
            $table->string('quick_card_4_icon')->nullable()->default('fa-solid fa-newspaper');

            // 6. SEO Meta Tag Global
            $table->string('seo_meta_title')->nullable()->default('Madrasah Aliyah Darun Najah Sambikarto • Pendidikan Islam Berkarakter & Mandiri');
            $table->text('seo_meta_description')->nullable();
            $table->text('seo_meta_keywords')->nullable();
            $table->string('seo_og_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_settings', function (Blueprint $table) {
            $table->dropColumn([
                'site_name', 'site_tagline', 'site_logo', 'site_favicon', 'foundation_head',
                'profile_title', 'profile_highlight', 'profile_description', 'profile_image', 'vision', 'mission',
                'pillar_1_title', 'pillar_1_desc', 'pillar_1_icon',
                'pillar_2_title', 'pillar_2_desc', 'pillar_2_icon',
                'pillar_3_title', 'pillar_3_desc', 'pillar_3_icon',
                'pillar_4_title', 'pillar_4_desc', 'pillar_4_icon',
                'is_stats_active', 'stat_students_count', 'stat_students_label',
                'stat_teachers_count', 'stat_teachers_label', 'stat_classes_count',
                'stat_classes_label', 'stat_alumni_count', 'stat_alumni_label',
                'quick_card_1_title', 'quick_card_1_desc', 'quick_card_1_url', 'quick_card_1_icon',
                'quick_card_2_title', 'quick_card_2_desc', 'quick_card_2_url', 'quick_card_2_icon',
                'quick_card_3_title', 'quick_card_3_desc', 'quick_card_3_url', 'quick_card_3_icon',
                'quick_card_4_title', 'quick_card_4_desc', 'quick_card_4_url', 'quick_card_4_icon',
                'seo_meta_title', 'seo_meta_description', 'seo_meta_keywords', 'seo_og_image',
            ]);
        });
    }
};
