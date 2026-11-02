<?php

namespace App\Filament\Resources\HeroSlides\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class HeroSlideInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title')
                    ->label('Judul Headline')
                    ->weight('bold')
                    ->columnSpanFull(),

                TextEntry::make('subtitle')
                    ->label('Subjudul Atas')
                    ->placeholder('-'),

                TextEntry::make('title_highlight')
                    ->label('Kata Sorotan Emas')
                    ->placeholder('-'),

                TextEntry::make('order')
                    ->label('Urutan')
                    ->numeric(),

                IconEntry::make('is_active')
                    ->label('Status Aktif')
                    ->boolean(),

                ImageEntry::make('image')
                    ->label('Foto Banner Latar')
                    ->placeholder('Menggunakan foto default')
                    ->columnSpanFull(),

                TextEntry::make('description')
                    ->label('Uraian Teks')
                    ->columnSpanFull(),

                TextEntry::make('button_text')
                    ->label('Tombol Utama')
                    ->placeholder('-'),

                TextEntry::make('button_url')
                    ->label('URL Tombol Utama')
                    ->placeholder('-'),

                TextEntry::make('button_secondary_text')
                    ->label('Tombol Sekunder')
                    ->placeholder('-'),

                TextEntry::make('button_secondary_url')
                    ->label('URL Tombol Sekunder')
                    ->placeholder('-'),

                TextEntry::make('badge_1')
                    ->label('Badge 1')
                    ->placeholder('-'),

                TextEntry::make('badge_2')
                    ->label('Badge 2')
                    ->placeholder('-'),
            ]);
    }
}
