<?php

namespace App\Filament\Resources\HomeSettings\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class HomeSettingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                IconEntry::make('is_ticker_active')
                    ->label('Ticker Pengumuman Aktif')
                    ->boolean(),
                TextEntry::make('ticker_text')
                    ->label('Isi Teks Pengumuman')
                    ->placeholder('-')
                    ->columnSpanFull(),
                ImageEntry::make('leader_image')
                    ->label('Foto Pengasuh / Pimpinan')
                    ->circular()
                    ->placeholder('-'),
                TextEntry::make('leader_name')
                    ->label('Nama Pengasuh / Pimpinan')
                    ->weight('bold')
                    ->placeholder('-'),
                TextEntry::make('leader_role')
                    ->label('Jabatan')
                    ->placeholder('-'),
                TextEntry::make('welcome_badge')
                    ->label('Badge Sambutan')
                    ->placeholder('-'),
                TextEntry::make('welcome_title')
                    ->label('Judul Sambutan')
                    ->placeholder('-'),
                TextEntry::make('welcome_subtitle')
                    ->label('Subjudul / Lokasi')
                    ->placeholder('-'),
                TextEntry::make('welcome_quote')
                    ->label('Isi Pesan Sambutan')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('school_level')
                    ->label('Jenjang Sekolah')
                    ->placeholder('-'),
                TextEntry::make('accreditation_status')
                    ->label('Akreditasi')
                    ->placeholder('-'),
                TextEntry::make('badge_stat_1')
                    ->label('Poin Karakteristik 1')
                    ->placeholder('-'),
                TextEntry::make('badge_stat_2')
                    ->label('Poin Karakteristik 2')
                    ->placeholder('-'),
                TextEntry::make('badge_stat_3')
                    ->label('Poin Karakteristik 3')
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Terakhir Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->placeholder('-'),
            ]);
    }
}
