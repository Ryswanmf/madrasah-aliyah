<?php

namespace App\Filament\Resources\PpdbSettings\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class PpdbSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Pengaturan PPDB Online')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Status & Gelombang')
                            ->icon('heroicon-o-academic-cap')
                            ->schema([
                                Toggle::make('is_open')
                                    ->label('Buka Pendaftaran Online (PPDB Open)')
                                    ->helperText('Jika dinonaktifkan, pengunjung tidak dapat mengisi formulir dan akan muncul pesan penutupan PPDB.')
                                    ->default(true)
                                    ->columnSpanFull(),

                                TextInput::make('academic_year')
                                    ->label('Tahun Ajaran')
                                    ->default('2026/2027')
                                    ->required()
                                    ->columnSpan(1),

                                TextInput::make('wave_name')
                                    ->label('Nama Gelombang Aktif')
                                    ->default('Gelombang 1 (Reguler & Beasiswa)')
                                    ->required()
                                    ->columnSpan(1),

                                TextInput::make('wave_period')
                                    ->label('Periode / Batas Pendaftaran')
                                    ->default('1 Januari – 31 Maret 2026')
                                    ->columnSpan(1),

                                TextInput::make('quota_info')
                                    ->label('Informasi Kuota')
                                    ->default('Kuota Terbatas: 120 Santri Baru')
                                    ->columnSpan(1),

                                Textarea::make('closed_message')
                                    ->label('Pesan Jika PPDB Ditutup')
                                    ->default('Mohon maaf, pendaftaran santri baru saat ini sedang ditutup atau kuota pendaftaran telah terpenuhi. Silakan hubungi sekretariat madrasah untuk informasi gelombang berikutnya.')
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('Alur 4 Langkah')
                            ->icon('heroicon-o-arrow-path')
                            ->schema([
                                TextInput::make('step_1_title')->label('Langkah 1: Judul')->default('Pengisian Formulir Online')->columnSpan(1),
                                TextInput::make('step_1_desc')->label('Langkah 1: Deskripsi')->default('Isi formulir online di website ini dengan data diri lengkap calon santri.')->columnSpan(1),

                                TextInput::make('step_2_title')->label('Langkah 2: Judul')->default('Konfirmasi WhatsApp Panitia')->columnSpan(1),
                                TextInput::make('step_2_desc')->label('Langkah 2: Deskripsi')->default('Dapatkan nomor registrasi dan konfirmasi pendaftaran melalui WhatsApp panitia.')->columnSpan(1),

                                TextInput::make('step_3_title')->label('Langkah 3: Judul')->default('Verifikasi Berkas Fisik')->columnSpan(1),
                                TextInput::make('step_3_desc')->label('Langkah 3: Deskripsi')->default('Verifikasi berkas fisik (Fotokopi KK, Akta, SKL/Ijazah) ke sekretariat madrasah.')->columnSpan(1),

                                TextInput::make('step_4_title')->label('Langkah 4: Judul')->default('Pengumuman & Daftar Ulang')->columnSpan(1),
                                TextInput::make('step_4_desc')->label('Langkah 4: Deskripsi')->default('Pengumuman hasil seleksi dan daftar ulang santri baru.')->columnSpan(1),
                            ]),

                        Tab::make('Berkas Persyaratan')
                            ->icon('heroicon-o-document-check')
                            ->schema([
                                Textarea::make('requirements')
                                    ->label('Daftar Berkas Persyaratan (Satu Berkas per Baris)')
                                    ->default("Fotokopi Ijazah / SKL SMP/MTs (legalisir 2 lembar)\nFotokopi Kartu Keluarga (KK) & KTP Orang Tua\nFotokopi Akta Kelahiran calon santri\nPas foto ukuran 3x4 (4 lembar, latar biru/merah)\nFotokopi KIP / PKH / Piagam Prestasi (jika memiliki)")
                                    ->rows(6)
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('Kontak Panitia PPDB')
                            ->icon('heroicon-o-chat-bubble-left-right')
                            ->schema([
                                TextInput::make('contact_name')
                                    ->label('Nama Unit Panitia')
                                    ->default('Sekretariat PPDB MA Darun Najah')
                                    ->columnSpan(1),

                                TextInput::make('contact_phone')
                                    ->label('Nomor WhatsApp Panitia')
                                    ->placeholder('085658973426')
                                    ->helperText('Nomor WhatsApp tujuan untuk konfirmasi setelah santri mendaftar online')
                                    ->columnSpan(1),

                                Textarea::make('contact_wa_template')
                                    ->label('Template Pesan Konfirmasi WA')
                                    ->default('Assalamu’alaikum Panitia PPDB MA Darun Najah Sambikarto, saya telah mengisi formulir online dan ingin konfirmasi pendaftaran santri baru.')
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ]),
                    ]),
            ]);
    }
}
