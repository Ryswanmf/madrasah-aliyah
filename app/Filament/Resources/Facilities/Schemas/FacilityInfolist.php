<?php

namespace App\Filament\Resources\Facilities\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FacilityInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Nama Fasilitas')
                    ->weight('bold')
                    ->columnSpanFull(),

                TextEntry::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->formatStateUsing(fn ($record) => $record->category_label),

                TextEntry::make('icon')
                    ->label('Icon FontAwesome')
                    ->placeholder('-'),

                TextEntry::make('order')
                    ->label('Urutan')
                    ->numeric(),

                IconEntry::make('is_active')
                    ->label('Status Aktif')
                    ->boolean(),

                ImageEntry::make('image')
                    ->label('Foto Sarana & Prasarana')
                    ->placeholder('Tidak ada foto terlampir')
                    ->columnSpanFull(),

                TextEntry::make('description')
                    ->label('Deskripsi Singkat')
                    ->columnSpanFull(),

                TextEntry::make('details')
                    ->label('Keterangan Tambahan (Lightbox)')
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
