<?php

namespace App\Filament\Resources\HomeSettings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class HomeSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ToggleColumn::make('is_ticker_active')
                    ->label('Ticker Aktif'),
                ImageColumn::make('leader_image')
                    ->label('Foto Pimpinan')
                    ->circular()
                    ->defaultImageUrl(asset('assets/images/placeholder.jpg')),
                TextColumn::make('leader_name')
                    ->label('Kepala Madrasah / Guru Pembina')
                    ->searchable()
                    ->weight('bold')
                    ->description(fn ($record) => $record->leader_role),
                TextColumn::make('ticker_text')
                    ->label('Cuplikan Pengumuman')
                    ->limit(45)
                    ->tooltip(fn ($record) => $record->ticker_text),
                TextColumn::make('school_level')
                    ->label('Jenjang & Akreditasi')
                    ->formatStateUsing(fn ($record) => "{$record->school_level} ({$record->accreditation_status})"),
                TextColumn::make('updated_at')
                    ->label('Terakhir Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
