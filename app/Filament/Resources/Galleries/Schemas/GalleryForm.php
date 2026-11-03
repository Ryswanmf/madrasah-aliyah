<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul / Keterangan Foto')
                    ->placeholder('Contoh: Aktivitas Siswa/i dan Pembelajaran Kelas')
                    ->required()
                    ->columnSpanFull(),

                Select::make('category')
                    ->label('Kategori Dokumentasi')
                    ->options([
                        'kegiatan' => 'Aktivitas & Belajar',
                        'ibadah' => 'Kajian & Ibadah',
                        'sarana' => 'Gedung & Sarana',
                        'ekskul' => 'Ekskul & Olahraga',
                        'prestasi' => 'Prestasi Siswa/i',
                    ])
                    ->default('kegiatan')
                    ->required()
                    ->live()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $labels = [
                            'kegiatan' => 'Aktivitas & Belajar',
                            'ibadah' => 'Kajian & Ibadah',
                            'sarana' => 'Gedung & Sarana',
                            'ekskul' => 'Ekskul & Olahraga',
                            'prestasi' => 'Prestasi Siswa/i',
                        ];
                        $set('category_label', $labels[$state] ?? 'Dokumentasi');
                    })
                    ->columnSpan(1),

                TextInput::make('category_label')
                    ->label('Label Kategori (Teks Tampilan)')
                    ->default('Aktivitas & Belajar')
                    ->required()
                    ->columnSpan(1),

                FileUpload::make('image')
                    ->label('File Foto / Gambar')
                    ->directory('gallery-photos')
                    ->image()
                    ->imageEditor()
                    ->required()
                    ->columnSpanFull(),

                Textarea::make('description')
                    ->label('Deskripsi Lengkap Foto (Opsional)')
                    ->rows(3)
                    ->placeholder('Keterangan lebih detail tentang momentum atau kegiatan ini...')
                    ->columnSpanFull(),

                TextInput::make('order')
                    ->label('Urutan Tampil (Order)')
                    ->numeric()
                    ->default(0)
                    ->helperText('Semakin kecil angka, semakin awal muncul di galeri.')
                    ->columnSpan(1),

                Toggle::make('is_published')
                    ->label('Tayangkan di Website Publik')
                    ->default(true)
                    ->columnSpan(1),
            ]);
    }
}
