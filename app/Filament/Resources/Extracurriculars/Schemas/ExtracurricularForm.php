<?php

namespace App\Filament\Resources\Extracurriculars\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ExtracurricularForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Ekstrakurikuler')
                    ->placeholder('Contoh: Hadroh & Sholawat Banjari')
                    ->required()
                    ->columnSpanFull(),

                Select::make('category')
                    ->label('Kategori Bidang')
                    ->options([
                        'seni' => 'Seni Islami & Bahasa',
                        'olahraga' => 'Olahraga & Bela Diri',
                        'organisasi' => 'Kepanduan & Organisasi',
                        'vokasi' => 'TIK & Keterampilan',
                    ])
                    ->default('seni')
                    ->required()
                    ->columnSpan(1),

                TextInput::make('badge')
                    ->label('Badge / Label Subjudul')
                    ->placeholder('Contoh: Seni Islami, Bela Diri NU, Kepanduan')
                    ->columnSpan(1),

                Select::make('color')
                    ->label('Tema Warna Kartu')
                    ->options([
                        'emerald' => 'Hijau Emerald (Nuansa Islami)',
                        'red' => 'Merah Crimson (Bela Diri & Fisik)',
                        'purple' => 'Ungu Violet (Organisasi & Kepanduan)',
                        'blue' => 'Biru Cyan (TIK & Digital)',
                        'amber' => 'Kuning Emas (Kewirausahaan)',
                    ])
                    ->default('emerald')
                    ->required()
                    ->columnSpan(1),

                TextInput::make('icon')
                    ->label('Icon FontAwesome')
                    ->placeholder('Contoh: fa-solid fa-drum, fa-solid fa-shield-halved')
                    ->helperText('Dibiarkan kosong untuk memakai icon bawaan kategori')
                    ->columnSpan(1),

                TextInput::make('schedule')
                    ->label('Jadwal Rutin Latihan')
                    ->placeholder('Contoh: Selasa & Sabtu Sore (16.00 WIB)')
                    ->columnSpan(1),

                TextInput::make('coach')
                    ->label('Pembina / Pelatih')
                    ->placeholder('Contoh: Ustadz Ahmad & Tim Ash-Shofwah')
                    ->columnSpan(1),

                TextInput::make('order')
                    ->label('Urutan Tampil')
                    ->numeric()
                    ->default(0)
                    ->helperText('Angka lebih kecil akan tampil lebih dulu')
                    ->required()
                    ->columnSpan(1),

                Toggle::make('is_featured')
                    ->label('Tampilkan di Beranda (Featured Home)')
                    ->helperText('Jika aktif, kartu ekskul akan muncul di ringkasan beranda web')
                    ->default(false)
                    ->columnSpan(1),

                Toggle::make('is_active')
                    ->label('Status Aktif / Ditampilkan')
                    ->default(true)
                    ->required()
                    ->columnSpanFull(),

                FileUpload::make('image')
                    ->label('Foto Dokumentasi Kegiatan (Opsional)')
                    ->directory('extracurricular-images')
                    ->image()
                    ->imageEditor()
                    ->columnSpanFull(),

                Textarea::make('description')
                    ->label('Deskripsi Kegiatan & Manfaat')
                    ->placeholder('Tuliskan ringkasan kegiatan, tujuan pembinaan, dan target prestasi...')
                    ->rows(3)
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
