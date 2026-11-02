<?php

namespace App\Filament\Resources\Achievements\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AchievementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Nama Kejuaraan / Prestasi')
                    ->placeholder('Contoh: Juara 1 Festival Seni Hadroh Klasik')
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('student_name')
                    ->label('Nama Santri / Tim Peraih')
                    ->placeholder('Contoh: Grup Hadroh Ash-Shofwah / Ahmad Fauzi')
                    ->required()
                    ->columnSpan(1),

                Select::make('category')
                    ->label('Kategori Prestasi')
                    ->options([
                        'seni' => 'Seni Islami & Budaya',
                        'keagamaan' => 'Keagamaan & MQK (Kitab Kuning)',
                        'tahfidz' => 'Tahfidzul Qur\'an',
                        'akademik' => 'Akademik & Sains (KSM/OSN)',
                        'olahraga' => 'Olahraga & Beladiri (Pagar Nusa)',
                    ])
                    ->default('seni')
                    ->required()
                    ->columnSpan(1),

                Select::make('level')
                    ->label('Tingkat Kejuaraan')
                    ->options([
                        'kecamatan' => 'Tingkat Kecamatan',
                        'kabupaten' => 'Tingkat Kabupaten',
                        'provinsi' => 'Tingkat Provinsi',
                        'nasional' => 'Tingkat Nasional',
                        'internasional' => 'Tingkat Internasional',
                    ])
                    ->default('kabupaten')
                    ->required()
                    ->columnSpan(1),

                TextInput::make('year')
                    ->label('Tahun Perolehan')
                    ->default(date('Y'))
                    ->required()
                    ->columnSpan(1),

                TextInput::make('organizer')
                    ->label('Lembaga Penyelenggara')
                    ->placeholder('Contoh: Kemenag Lampung Timur / LP Ma\'arif NU')
                    ->columnSpanFull(),

                FileUpload::make('image')
                    ->label('Foto Dokumentasi / Sertifikat / Piala')
                    ->directory('achievements')
                    ->image()
                    ->imageEditor()
                    ->columnSpanFull(),

                Textarea::make('description')
                    ->label('Keterangan / Uraian Prestasi')
                    ->placeholder('Uraian singkat mengenai lomba, prestasi yang diraih, dan kesan pembina...')
                    ->rows(3)
                    ->columnSpanFull(),

                TextInput::make('order')
                    ->label('Urutan Tampil')
                    ->numeric()
                    ->default(0)
                    ->columnSpan(1),

                Toggle::make('is_featured')
                    ->label('Tampilkan sebagai Prestasi Unggulan di Beranda')
                    ->default(true)
                    ->columnSpan(1),

                Toggle::make('is_active')
                    ->label('Status Aktif / Diterbitkan')
                    ->default(true)
                    ->columnSpan(1),
            ]);
    }
}
