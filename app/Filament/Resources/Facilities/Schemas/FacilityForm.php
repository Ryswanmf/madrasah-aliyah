<?php

namespace App\Filament\Resources\Facilities\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FacilityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Fasilitas / Sarana')
                    ->placeholder('Contoh: Gedung Utama & Ruang Kelas Teori')
                    ->required()
                    ->columnSpanFull(),

                Select::make('category')
                    ->label('Kategori Fasilitas')
                    ->options([
                        'akademik' => 'Gedung & Ruang Kelas (Akademik)',
                        'asrama' => 'Asrama Siswa/i',
                        'ibadah' => 'Masjid & Sarana Religi',
                        'olahraga' => 'Sarana Olahraga & Halaman',
                        'penunjang' => 'Laboratorium & TIK',
                    ])
                    ->default('akademik')
                    ->required()
                    ->columnSpan(1),

                TextInput::make('icon')
                    ->label('Icon FontAwesome')
                    ->placeholder('Contoh: fa-solid fa-school, fa-solid fa-mosque, fa-solid fa-hotel')
                    ->helperText('Dibiarkan kosong jika ingin memakai ikon default kategori')
                    ->columnSpan(1),

                TextInput::make('order')
                    ->label('Urutan Tampil')
                    ->numeric()
                    ->default(0)
                    ->helperText('Angka lebih kecil akan tampil lebih dulu')
                    ->required()
                    ->columnSpan(1),

                Toggle::make('is_active')
                    ->label('Tampilkan di Halaman Website')
                    ->default(true)
                    ->required()
                    ->columnSpan(1),

                FileUpload::make('image')
                    ->label('Foto Dokumentasi Fasilitas')
                    ->directory('facility-images')
                    ->image()
                    ->imageEditor()
                    ->columnSpanFull(),

                Textarea::make('description')
                    ->label('Deskripsi Singkat (Tampil di Kartu Fasilitas)')
                    ->placeholder('Ringkasan fungsi dan keunggulan sarana prasarana...')
                    ->rows(3)
                    ->required()
                    ->columnSpanFull(),

                Textarea::make('details')
                    ->label('Keterangan Lengkap (Tampil di Popup / Lightbox Foto)')
                    ->placeholder('Penjelasan mendalam mengenai kapasitas, spesifikasi, dan jadwal pemakaian sarana...')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }
}
