<?php

namespace App\Filament\Resources\Histories\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class HistoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title')
                    ->label('Judul Peristiwa / Nama Tokoh')
                    ->weight('bold')
                    ->columnSpanFull(),

                TextEntry::make('type')
                    ->label('Tipe Konten')
                    ->badge()
                    ->formatStateUsing(fn ($record) => $record->type_label),

                TextEntry::make('period')
                    ->label('Fase / Periode')
                    ->placeholder('-'),

                TextEntry::make('badge')
                    ->label('Badge Subjudul')
                    ->placeholder('-'),

                TextEntry::make('order')
                    ->label('Urutan')
                    ->numeric(),

                IconEntry::make('is_active')
                    ->label('Status Aktif')
                    ->boolean(),

                ImageEntry::make('image')
                    ->label('Foto / Gambar')
                    ->placeholder('Tidak ada gambar terlampir')
                    ->columnSpanFull(),

                TextEntry::make('description')
                    ->label('Uraian Peristiwa / Biografi')
                    ->columnSpanFull(),

                TextEntry::make('quote')
                    ->label('Kutipan / Motto Lembaga')
                    ->placeholder('-')
                    ->columnSpanFull(),

                TextEntry::make('created_at')
                    ->label('Waktu Dibuat')
                    ->dateTime('d M Y, H:i')
                    ->placeholder('-'),

                TextEntry::make('updated_at')
                    ->label('Pembaruan Terakhir')
                    ->dateTime('d M Y, H:i')
                    ->placeholder('-'),
            ]);
    }
}
