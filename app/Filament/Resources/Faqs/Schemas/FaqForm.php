<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('question')
                    ->label('Pertanyaan (Question)')
                    ->placeholder('Contoh: Kapan pendaftaran siswa/i baru (PPDB) dibuka dan bagaimana cara daftarnya?')
                    ->required()
                    ->columnSpanFull(),

                Select::make('category')
                    ->label('Kategori Tanya Jawab')
                    ->options([
                        'ppdb' => 'PPDB & Pendaftaran Siswa/i Baru',
                        'pesantren' => 'Asrama & Kehidupan Madrasah',
                        'akademik' => 'Kurikulum, Kitab & Legalitas Ijazah',
                        'biaya' => 'Biaya Pendidikan & Beasiswa',
                        'umum' => 'Informasi Umum Madrasah',
                    ])
                    ->default('umum')
                    ->required()
                    ->columnSpan(1),

                TextInput::make('keywords')
                    ->label('Kata Kunci Pencarian (Keywords)')
                    ->placeholder('Contoh: syarat, berkas, ijazah, skl, kk, akta, nisn')
                    ->helperText('Kata kunci tambahan agar pertanyaan mudah dicari pengunjung')
                    ->columnSpan(1),

                TextInput::make('order')
                    ->label('Urutan Tampil')
                    ->numeric()
                    ->default(0)
                    ->helperText('Angka lebih kecil akan tampil di urutan atas')
                    ->required()
                    ->columnSpan(1),

                Toggle::make('is_featured')
                    ->label('Pertanyaan Unggulan')
                    ->helperText('Tandai sebagai pertanyaan yang sering ditanyakan')
                    ->default(false)
                    ->columnSpan(1),

                Toggle::make('is_active')
                    ->label('Status Aktif / Tampilkan di Web')
                    ->default(true)
                    ->required()
                    ->columnSpanFull(),

                Textarea::make('answer')
                    ->label('Jawaban Lengkap (Answer)')
                    ->placeholder('Tuliskan jawaban komprehensif atas pertanyaan di atas...')
                    ->rows(5)
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
