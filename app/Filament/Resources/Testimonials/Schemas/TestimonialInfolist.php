<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TestimonialInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('avatar')
                    ->label('Foto Profil')
                    ->circular(),
                TextEntry::make('name')
                    ->label('Nama')
                    ->weight('bold'),
                TextEntry::make('role')
                    ->label('Profesi / Status'),
                TextEntry::make('category')
                    ->label('Kategori')
                    ->formatStateUsing(fn ($record) => $record->category_label),
                TextEntry::make('rating')
                    ->label('Rating')
                    ->formatStateUsing(fn ($state) => str_repeat('⭐', (int) $state)),
                TextEntry::make('content')
                    ->label('Isi Testimoni')
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
