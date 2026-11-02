<?php

namespace App\Filament\Resources\PpdbSettings\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PpdbSettingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                IconEntry::make('is_open')
                    ->label('Status Pendaftaran Buka')
                    ->boolean(),
                TextEntry::make('academic_year')
                    ->label('Tahun Ajaran'),
                TextEntry::make('wave_name')
                    ->label('Gelombang'),
                TextEntry::make('wave_period')
                    ->label('Periode Pendaftaran'),
                TextEntry::make('quota_info')
                    ->label('Keterangan Kuota'),
                TextEntry::make('closed_message')
                    ->label('Pesan Jika PPDB Ditutup')
                    ->columnSpanFull(),
                TextEntry::make('requirements')
                    ->label('Berkas Persyaratan')
                    ->columnSpanFull(),
                TextEntry::make('contact_phone')
                    ->label('Nomor WA Panitia'),
                TextEntry::make('updated_at')
                    ->label('Terakhir Diperbarui')
                    ->dateTime('d M Y H:i'),
            ]);
    }
}
