<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FaqInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('question')
                    ->label('Pertanyaan (Question)')
                    ->weight('bold')
                    ->columnSpanFull(),

                TextEntry::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->formatStateUsing(fn ($record) => $record->category_label),

                TextEntry::make('keywords')
                    ->label('Keywords Pencarian')
                    ->placeholder('-'),

                TextEntry::make('order')
                    ->label('Urutan')
                    ->numeric(),

                IconEntry::make('is_featured')
                    ->label('Pertanyaan Unggulan')
                    ->boolean(),

                IconEntry::make('is_active')
                    ->label('Status Aktif')
                    ->boolean(),

                TextEntry::make('answer')
                    ->label('Jawaban Lengkap (Answer)')
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
