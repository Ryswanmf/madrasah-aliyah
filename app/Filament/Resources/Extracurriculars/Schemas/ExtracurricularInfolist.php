<?php

namespace App\Filament\Resources\Extracurriculars\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ExtracurricularInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Nama Ekstrakurikuler')
                    ->weight('bold')
                    ->columnSpanFull(),

                TextEntry::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->formatStateUsing(fn ($record) => $record->category_label),

                TextEntry::make('badge')
                    ->label('Badge / Subjudul')
                    ->placeholder('-'),

                TextEntry::make('icon')
                    ->label('Icon FontAwesome')
                    ->placeholder('-'),

                TextEntry::make('schedule')
                    ->label('Jadwal Latihan')
                    ->placeholder('-'),

                TextEntry::make('coach')
                    ->label('Pembina / Pelatih')
                    ->placeholder('-'),

                TextEntry::make('order')
                    ->label('Urutan')
                    ->numeric(),

                IconEntry::make('is_featured')
                    ->label('Tampil di Beranda')
                    ->boolean(),

                IconEntry::make('is_active')
                    ->label('Status Aktif')
                    ->boolean(),

                ImageEntry::make('image')
                    ->label('Foto Kegiatan')
                    ->placeholder('Tidak ada foto terlampir')
                    ->columnSpanFull(),

                TextEntry::make('description')
                    ->label('Deskripsi Kegiatan')
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
