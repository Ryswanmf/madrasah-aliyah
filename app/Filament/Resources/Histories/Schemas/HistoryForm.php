<?php

namespace App\Filament\Resources\Histories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class HistoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Peristiwa / Nama Tokoh')
                    ->placeholder('Contoh: Majelis & Pengajian Salaf atau KH. Sahlan Abdulloh')
                    ->required()
                    ->columnSpanFull(),

                Select::make('type')
                    ->label('Kategori / Tipe Data')
                    ->options([
                        'milestone' => 'Fase / Tonggak Sejarah (Timeline)',
                        'tokoh' => 'Tokoh & Dewan Guru (Profil Tokoh Madrasah)',
                        'narasi' => 'Kilas Narasi Utama (Latar Belakang)',
                    ])
                    ->default('milestone')
                    ->required()
                    ->columnSpan(1),

                TextInput::make('period')
                    ->label('Periode / Nomor Fase')
                    ->placeholder('Contoh: 01, Fase Perintisan, atau Tahun 1998')
                    ->helperText('Tampil sebagai nomor urut fase atau periode waktu')
                    ->columnSpan(1),

                TextInput::make('badge')
                    ->label('Badge Subjudul / Jabatan')
                    ->placeholder('Contoh: Fondasi Dakwah, Masyayikh, atau Legalitas Formal')
                    ->helperText('Teks sorotan kecil di bawah judul')
                    ->columnSpan(1),

                TextInput::make('order')
                    ->label('Urutan Tampil')
                    ->numeric()
                    ->default(0)
                    ->helperText('Angka lebih kecil akan tampil lebih awal')
                    ->required()
                    ->columnSpan(1),

                FileUpload::make('image')
                    ->label('Foto Dokumentasi / Foto Tokoh (Opsional)')
                    ->directory('history-images')
                    ->image()
                    ->imageEditor()
                    ->columnSpanFull(),

                Textarea::make('description')
                    ->label('Uraian Peristiwa / Biografi / Deskripsi')
                    ->placeholder('Tuliskan rincian sejarah, latar belakang, atau profil tokoh...')
                    ->rows(4)
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('quote')
                    ->label('Kutipan / Motto / Catatan Kaki (Opsional)')
                    ->placeholder('Contoh: Memelihara tradisi lama yang baik dan mengadopsi tradisi baru yang maslahat')
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('Tampilkan di Halaman Website')
                    ->default(true)
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
