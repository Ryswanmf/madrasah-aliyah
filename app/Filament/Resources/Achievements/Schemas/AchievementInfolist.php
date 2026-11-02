<?php

namespace App\Filament\Resources\Achievements\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AchievementInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('image')
                    ->label('Foto Dokumentasi')
                    ->columnSpanFull(),
                TextEntry::make('title')
                    ->label('Nama Kejuaraan / Prestasi')
                    ->weight('bold'),
                TextEntry::make('student_name')
                    ->label('Nama Peraih'),
                TextEntry::make('category')
                    ->label('Kategori'),
                TextEntry::make('level')
                    ->label('Tingkat'),
                TextEntry::make('year')
                    ->label('Tahun'),
                TextEntry::make('organizer')
                    ->label('Penyelenggara'),
                TextEntry::make('description')
                    ->label('Keterangan')
                    ->columnSpanFull(),
                IconEntry::make('is_featured')
                    ->label('Unggulan Beranda')
                    ->boolean(),
                IconEntry::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
            ]);
    }
}
