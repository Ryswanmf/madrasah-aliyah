<?php

namespace App\Filament\Resources\Curricula\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CurriculumForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Nama Mata Pelajaran / Kitab / Pilar')
                    ->placeholder('Contoh: Matan Al-Jurumiyyah atau Kurikulum Kemenag')
                    ->required()
                    ->columnSpanFull(),

                Select::make('type')
                    ->label('Tipe / Jenis Kurikulum')
                    ->options([
                        'pilar' => '4 Pilar Utama Kurikulum (Kemenag, Madrasah, Tahfidz, Vokasi)',
                        'kitab' => 'Kitab Turats Salafiyah (Kajian Kitab Kuning)',
                        'vokasi' => 'Vokasi & Keterampilan Siswa/i',
                        'program_unggulan' => 'Program Unggulan Lainnya',
                    ])
                    ->default('kitab')
                    ->required()
                    ->columnSpan(1),

                Select::make('grade')
                    ->label('Tingkat / Jenjang Kelas')
                    ->options([
                        'all' => 'Semua Tingkat / Umum',
                        '10' => 'Kelas X (Ula)',
                        '11' => 'Kelas XI (Wustha)',
                        '12' => 'Kelas XII (Ulya)',
                    ])
                    ->default('all')
                    ->columnSpan(1),

                TextInput::make('category_label')
                    ->label('Label Rumpun / Kategori')
                    ->placeholder('Contoh: Nahwu & Kaidah Arab, Fiqih Dasar, Sains MIPA')
                    ->helperText('Teks badge kategori yang tampil di atas kartu')
                    ->columnSpan(1),

                TextInput::make('author')
                    ->label('Muallif / Pengarang (Khusus Kitab)')
                    ->placeholder('Contoh: Karya Syaikh Ash-Shanhaji')
                    ->columnSpan(1),

                TextInput::make('icon')
                    ->label('Icon FontAwesome')
                    ->default('fa-solid fa-book-quran')
                    ->placeholder('fa-solid fa-graduation-cap, fa-solid fa-book-quran, fa-solid fa-kaaba')
                    ->columnSpan(1),

                TextInput::make('order')
                    ->label('Urutan Tampil (Order)')
                    ->numeric()
                    ->default(0)
                    ->helperText('Angka lebih kecil tampil lebih dulu')
                    ->columnSpan(1),

                Textarea::make('description')
                    ->label('Deskripsi / Silabus Ringkas')
                    ->placeholder('Uraian singkat materi, fokus kajian, dan target pemahaman siswa/i...')
                    ->rows(3)
                    ->columnSpanFull(),

                TagsInput::make('points')
                    ->label('Poin Pokok Bahasan / Sub-Materi')
                    ->placeholder('Ketik poin lalu tekan Enter')
                    ->helperText('Daftar keunggulan, bab penting, atau rincian materi')
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('Aktif / Tampilkan di Website Publik')
                    ->default(true)
                    ->columnSpanFull(),
            ]);
    }
}
