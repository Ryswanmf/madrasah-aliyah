<?php

namespace App\Filament\Resources\Curricula\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CurriculumInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title')
                    ->label('Nama Mata Pelajaran / Kitab / Pilar'),
                TextEntry::make('type')
                    ->label('Tipe')
                    ->badge(),
                TextEntry::make('category_label')
                    ->label('Kategori / Rumpun')
                    ->placeholder('-'),
                TextEntry::make('grade')
                    ->label('Jenjang / Kelas')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('author')
                    ->label('Muallif / Pengarang')
                    ->placeholder('-'),
                TextEntry::make('icon')
                    ->label('Icon FontAwesome')
                    ->placeholder('-'),
                TextEntry::make('description')
                    ->label('Deskripsi / Silabus')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('points')
                    ->label('Poin Pokok / Cakupan Bahasan')
                    ->badge()
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('order')
                    ->label('Urutan Tampil')
                    ->numeric(),
                IconEntry::make('is_active')
                    ->label('Status Aktif')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->label('Waktu Dibuat')
                    ->dateTime('d M Y H:i'),
                TextEntry::make('updated_at')
                    ->label('Terakhir Diperbarui')
                    ->dateTime('d M Y H:i'),
            ]);
    }
}
