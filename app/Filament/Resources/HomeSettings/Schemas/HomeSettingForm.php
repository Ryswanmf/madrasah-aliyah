<?php

namespace App\Filament\Resources\HomeSettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class HomeSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Pengaturan Beranda & Profil')
                    ->columnSpanFull()
                    ->tabs([
                        // TAB 1: IDENTITAS & LOGO SEKOLAH
                        Tab::make('Identitas & Logo')
                            ->icon('heroicon-o-building-library')
                            ->schema([
                                TextInput::make('site_name')
                                    ->label('Nama Lembaga / Brand')
                                    ->default('PPDN Darun Najah')
                                    ->required()
                                    ->columnSpan(1),

                                TextInput::make('site_tagline')
                                    ->label('Tagline Lembaga')
                                    ->default('Madrasah Aliyah • Sambikarto, Sekampung')
                                    ->columnSpan(1),

                                TextInput::make('foundation_head')
                                    ->label('Nama Ketua Yayasan')
                                    ->default('Suparno, S.Pd.I')
                                    ->columnSpan(1),

                                FileUpload::make('site_logo')
                                    ->label('Logo Madrasah (Navbar & Footer)')
                                    ->directory('settings')
                                    ->image()
                                    ->helperText('Format PNG transparan disarankan (rasio 1:1)')
                                    ->columnSpan(1),

                                FileUpload::make('site_favicon')
                                    ->label('Favicon Tab Browser')
                                    ->directory('settings')
                                    ->image()
                                    ->helperText('Ikon kecil tab browser (format PNG/ICO)')
                                    ->columnSpan(1),
                            ]),

                        // TAB 2: TICKER & SAMBUTAN PENGASUH
                        Tab::make('Ticker & Sambutan')
                            ->icon('heroicon-o-megaphone')
                            ->schema([
                                Toggle::make('is_ticker_active')
                                    ->label('Aktifkan Pita Pengumuman Berjalan (Ticker)')
                                    ->default(true)
                                    ->columnSpanFull(),

                                Textarea::make('ticker_text')
                                    ->label('Isi Teks Pengumuman Berjalan')
                                    ->placeholder('Tulis teks pengumuman berjalan. Baris baru akan otomatis diberi tanda pemisah...')
                                    ->rows(3)
                                    ->columnSpanFull(),

                                TextInput::make('welcome_badge')
                                    ->label('Badge Sambutan')
                                    ->default('Sambutan Pengasuh')
                                    ->columnSpan(1),

                                TextInput::make('welcome_title')
                                    ->label('Judul Sambutan')
                                    ->default('Pondok Pesantren Darun Najah')
                                    ->required()
                                    ->columnSpan(1),

                                TextInput::make('welcome_subtitle')
                                    ->label('Subjudul Sambutan')
                                    ->default('Sambikarto, Sekampung, Lampung Timur')
                                    ->columnSpanFull(),

                                Textarea::make('welcome_quote')
                                    ->label('Kutipan Wejangan / Sambutan')
                                    ->rows(4)
                                    ->columnSpanFull(),

                                TextInput::make('leader_name')
                                    ->label('Nama Pengasuh / Pimpinan')
                                    ->default('KH. Sahlan Abdulloh & KH. Abdul Ghofar, S.Pd.I')
                                    ->columnSpan(1),

                                TextInput::make('leader_role')
                                    ->label('Jabatan Pimpinan')
                                    ->default('Pengasuh Pondok Pesantren')
                                    ->columnSpan(1),

                                FileUpload::make('leader_image')
                                    ->label('Foto Pengasuh / Pimpinan')
                                    ->directory('home-settings')
                                    ->image()
                                    ->imageEditor()
                                    ->columnSpan(1),

                                TextInput::make('school_level')
                                    ->label('Jenjang Sekolah')
                                    ->default('Madrasah Aliyah')
                                    ->columnSpan(1),

                                TextInput::make('accreditation_status')
                                    ->label('Status Akreditasi')
                                    ->default('Terakreditasi BAN-SM')
                                    ->columnSpan(1),

                                TextInput::make('badge_stat_1')
                                    ->label('Badge Karakteristik 1')
                                    ->default('Kurikulum Kemenag & Salaf')
                                    ->columnSpan(1),

                                TextInput::make('badge_stat_2')
                                    ->label('Badge Karakteristik 2')
                                    ->default('Santri Mukim & Non-Mukim')
                                    ->columnSpan(1),

                                TextInput::make('badge_stat_3')
                                    ->label('Badge Karakteristik 3')
                                    ->default('Beasiswa Tahfidz Qur\'an')
                                    ->columnSpan(1),
                            ]),

                        // TAB 3: PROFIL & VISI MISI
                        Tab::make('Profil & Visi Misi')
                            ->icon('heroicon-o-academic-cap')
                            ->schema([
                                TextInput::make('profile_title')
                                    ->label('Judul Bagian Profil')
                                    ->default('Mengenal Lebih Dekat MA Darun Najah Sambikarto')
                                    ->columnSpanFull(),

                                Textarea::make('profile_highlight')
                                    ->label('Paragraf Sorotan (Highlight)')
                                    ->placeholder('Paragraf pengantar dengan aksen garis emas...')
                                    ->rows(3)
                                    ->columnSpanFull(),

                                Textarea::make('profile_description')
                                    ->label('Uraian Lengkap Profil Lembaga')
                                    ->placeholder('Uraian mendalam mengenai kiprah madrasah...')
                                    ->rows(4)
                                    ->columnSpanFull(),

                                FileUpload::make('profile_image')
                                    ->label('Foto Gedung / Aktivitas Lembaga')
                                    ->directory('profile')
                                    ->image()
                                    ->imageEditor()
                                    ->columnSpanFull(),

                                Textarea::make('vision')
                                    ->label('Visi Madrasah')
                                    ->placeholder('Tulis visi madrasah...')
                                    ->rows(3)
                                    ->columnSpanFull(),

                                Textarea::make('mission')
                                    ->label('Misi Madrasah (Satu Misi per Baris)')
                                    ->placeholder("Menyelenggarakan kurikulum Kemenag dan pesantren secara integral.\nMembudayakan akhlakul karimah dan ibadah yaumiyyah santri.\nMembekali santri keterampilan vokasi dan kemandirian praktis.")
                                    ->rows(4)
                                    ->columnSpanFull(),
                            ]),

                        // TAB 4: EMPAT PILAR KEUNGGULAN
                        Tab::make('4 Pilar Keunggulan')
                            ->icon('heroicon-o-star')
                            ->schema([
                                TextInput::make('pillar_1_title')->label('Pilar 1: Judul')->default('Aswaja NU')->columnSpan(1),
                                TextInput::make('pillar_1_desc')->label('Pilar 1: Uraian')->default('Akidah & Amaliah')->columnSpan(1),
                                TextInput::make('pillar_1_icon')->label('Pilar 1: Icon FontAwesome')->default('fa-solid fa-star-and-crescent')->columnSpan(1),

                                TextInput::make('pillar_2_title')->label('Pilar 2: Judul')->default('Tafaqquh Fiddin')->columnSpan(1),
                                TextInput::make('pillar_2_desc')->label('Pilar 2: Uraian')->default('Kitab Turats Salaf')->columnSpan(1),
                                TextInput::make('pillar_2_icon')->label('Pilar 2: Icon FontAwesome')->default('fa-solid fa-book-quran')->columnSpan(1),

                                TextInput::make('pillar_3_title')->label('Pilar 3: Judul')->default('Sains Modern')->columnSpan(1),
                                TextInput::make('pillar_3_desc')->label('Pilar 3: Uraian')->default('Wawasan Akademis')->columnSpan(1),
                                TextInput::make('pillar_3_icon')->label('Pilar 3: Icon FontAwesome')->default('fa-solid fa-microscope')->columnSpan(1),

                                TextInput::make('pillar_4_title')->label('Pilar 4: Judul')->default('Kemandirian')->columnSpan(1),
                                TextInput::make('pillar_4_desc')->label('Pilar 4: Uraian')->default('Life Skills Santri')->columnSpan(1),
                                TextInput::make('pillar_4_icon')->label('Pilar 4: Icon FontAwesome')->default('fa-solid fa-hand-holding-hand')->columnSpan(1),
                            ]),

                        // TAB 5: STATISTIK COUNTER
                        Tab::make('Statistik Angka')
                            ->icon('heroicon-o-chart-bar')
                            ->schema([
                                Toggle::make('is_stats_active')
                                    ->label('Tampilkan Kotak Statistik Angka di Beranda')
                                    ->default(true)
                                    ->columnSpanFull(),

                                TextInput::make('stat_students_count')->label('Jumlah Santri')->default('350+')->columnSpan(1),
                                TextInput::make('stat_students_label')->label('Label Santri')->default('Santri Mukim & Reguler')->columnSpan(1),

                                TextInput::make('stat_teachers_count')->label('Jumlah Asatidz/Guru')->default('28')->columnSpan(1),
                                TextInput::make('stat_teachers_label')->label('Label Guru')->default('Dewan Asatidz & Guru')->columnSpan(1),

                                TextInput::make('stat_classes_count')->label('Jumlah Ruang/Lab')->default('12')->columnSpan(1),
                                TextInput::make('stat_classes_label')->label('Label Ruang')->default('Ruang Kelas & Lab')->columnSpan(1),

                                TextInput::make('stat_alumni_count')->label('Jumlah Alumni')->default('1.200+')->columnSpan(1),
                                TextInput::make('stat_alumni_label')->label('Label Alumni')->default('Alumni Tersebar')->columnSpan(1),
                            ]),

                        // TAB 6: 4 KARTU PINTASAN CEPAT
                        Tab::make('Kartu Pintasan Cepat')
                            ->icon('heroicon-o-squares-2x2')
                            ->schema([
                                TextInput::make('quick_card_1_title')->label('Kartu 1: Judul')->default('PPDB Online 2026')->columnSpan(1),
                                TextInput::make('quick_card_1_desc')->label('Kartu 1: Subjudul')->default('Pendaftaran & Cek Status')->columnSpan(1),
                                TextInput::make('quick_card_1_url')->label('Kartu 1: Tautan URL')->default('/ppdb')->columnSpan(1),
                                TextInput::make('quick_card_1_icon')->label('Kartu 1: Icon FA')->default('fa-solid fa-graduation-cap')->columnSpan(1),

                                TextInput::make('quick_card_2_title')->label('Kartu 2: Judul')->default('Kurikulum Terpadu')->columnSpan(1),
                                TextInput::make('quick_card_2_desc')->label('Kartu 2: Subjudul')->default('Kemenag RI & Kitab Kuning')->columnSpan(1),
                                TextInput::make('quick_card_2_url')->label('Kartu 2: Tautan URL')->default('/kurikulum')->columnSpan(1),
                                TextInput::make('quick_card_2_icon')->label('Kartu 2: Icon FA')->default('fa-solid fa-book-open')->columnSpan(1),

                                TextInput::make('quick_card_3_title')->label('Kartu 3: Judul')->default('Sarana & Asrama')->columnSpan(1),
                                TextInput::make('quick_card_3_desc')->label('Kartu 3: Subjudul')->default('Gedung & Komplek Mukim')->columnSpan(1),
                                TextInput::make('quick_card_3_url')->label('Kartu 3: Tautan URL')->default('/fasilitas')->columnSpan(1),
                                TextInput::make('quick_card_3_icon')->label('Kartu 3: Icon FA')->default('fa-solid fa-building-columns')->columnSpan(1),

                                TextInput::make('quick_card_4_title')->label('Kartu 4: Judul')->default('Warta & Berita')->columnSpan(1),
                                TextInput::make('quick_card_4_desc')->label('Kartu 4: Subjudul')->default('Prestasi & Agenda Madrasah')->columnSpan(1),
                                TextInput::make('quick_card_4_url')->label('Kartu 4: Tautan URL')->default('/berita')->columnSpan(1),
                                TextInput::make('quick_card_4_icon')->label('Kartu 4: Icon FA')->default('fa-solid fa-newspaper')->columnSpan(1),
                            ]),

                        // TAB 7: SEO GLOBAL
                        Tab::make('SEO Global')
                            ->icon('heroicon-o-globe-alt')
                            ->schema([
                                TextInput::make('seo_meta_title')
                                    ->label('Meta Title Website')
                                    ->default('Madrasah Aliyah Darun Najah Sambikarto • Pendidikan Islam Berkarakter & Mandiri')
                                    ->columnSpanFull(),

                                Textarea::make('seo_meta_description')
                                    ->label('Meta Description')
                                    ->placeholder('Deskripsi ringkas website yang muncul di hasil pencarian Google...')
                                    ->rows(3)
                                    ->columnSpanFull(),

                                TextInput::make('seo_meta_keywords')
                                    ->label('Meta Keywords')
                                    ->placeholder('MA Darun Najah, Pondok Pesantren Sambikarto, PPDB Lampung Timur, Madrasah Aliyah Sekampung')
                                    ->columnSpanFull(),

                                FileUpload::make('seo_og_image')
                                    ->label('OpenGraph Banner Image (Thumbnail Share WA/FB)')
                                    ->directory('seo')
                                    ->image()
                                    ->helperText('Gambar rasio 1200x630px yang tampil saat link website dibagikan ke media sosial')
                                    ->columnSpanFull(),
                            ]),
                    ]),
            ]);
    }
}
