<?php

namespace App\Filament\Resources\Teachers\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TeacherInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('photo')
                    ->label('Foto Resmi')
                    ->circular(),
                TextEntry::make('name')
                    ->label('Nama & Gelar')
                    ->weight('bold'),
                TextEntry::make('nip_or_niy')
                    ->label('NIP / NIY'),
                TextEntry::make('role')
                    ->label('Jabatan / Tugas Utama'),
                TextEntry::make('category')
                    ->label('Kategori')
                    ->formatStateUsing(fn ($record) => $record->category_label),
                TextEntry::make('education')
                    ->label('Pendidikan / Almamater Pesantren')
                    ->columnSpanFull(),
                TextEntry::make('bio')
                    ->label('Biografi / Riwayat Pengabdian')
                    ->columnSpanFull(),
                IconEntry::make('is_featured')
                    ->label('Unggulan Beranda')
                    ->boolean(),
                IconEntry::make('is_active')
                    ->label('Aktif Mengajar')
                    ->boolean(),
            ]);
    }
}
