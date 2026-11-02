<?php

namespace App\Filament\Resources\HeroSlides\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class HeroSlideForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('subtitle')
                    ->label('Teks Pembuka / Subjudul Atas')
                    ->placeholder('Contoh: Selamat Datang di Portal Resmi')
                    ->columnSpanFull(),

                TextInput::make('title')
                    ->label('Judul Utama Slide (Headline)')
                    ->placeholder('Contoh: Madrasah Aliyah Darun Najah Sambikarto')
                    ->required()
                    ->columnSpan(1),

                TextInput::make('title_highlight')
                    ->label('Kata Sorotan Emas (Gold Highlight)')
                    ->placeholder('Contoh: Darun Najah atau Berbasis Pesantren')
                    ->helperText('Kata yang akan diberi warna aksen emas berkilau')
                    ->columnSpan(1),

                Textarea::make('description')
                    ->label('Uraian / Penjelasan Singkat')
                    ->placeholder('Contoh: Perpaduan harmonis kurikulum Kementerian Agama RI dan pengkajian kitab kuning salafiyah...')
                    ->rows(3)
                    ->columnSpanFull(),

                FileUpload::make('image')
                    ->label('Foto Latar Belakang Banner')
                    ->directory('hero-slides')
                    ->image()
                    ->imageEditor()
                    ->columnSpanFull(),

                TextInput::make('button_text')
                    ->label('Teks Tombol Utama (CTA 1)')
                    ->default('Daftar PPDB Online 2026')
                    ->columnSpan(1),

                TextInput::make('button_url')
                    ->label('Tautan Tombol Utama (URL 1)')
                    ->default('/ppdb')
                    ->columnSpan(1),

                TextInput::make('button_secondary_text')
                    ->label('Teks Tombol Sekunder (CTA 2)')
                    ->default('Hubungi Panitia (WA)')
                    ->columnSpan(1),

                TextInput::make('button_secondary_url')
                    ->label('Tautan Tombol Sekunder (URL 2)')
                    ->placeholder('https://wa.me/6285658973426')
                    ->columnSpan(1),

                TextInput::make('badge_1')
                    ->label('Badge Informasi 1')
                    ->default("LP Ma'arif NU Lampung Timur")
                    ->columnSpan(1),

                TextInput::make('badge_2')
                    ->label('Badge Informasi 2')
                    ->default('Terakreditasi BAN-SM')
                    ->columnSpan(1),

                TextInput::make('order')
                    ->label('Urutan Slide')
                    ->numeric()
                    ->default(0)
                    ->helperText('Urutan pemutaran slide carousel (angka terkecil berputar pertama)')
                    ->required()
                    ->columnSpan(1),

                Toggle::make('is_active')
                    ->label('Tampilkan Slide di Beranda')
                    ->default(true)
                    ->required()
                    ->columnSpan(1),
            ]);
    }
}
