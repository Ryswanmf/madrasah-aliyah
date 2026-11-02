<?php

namespace App\Filament\Resources\PpdbSettings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class PpdbSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ToggleColumn::make('is_open')
                    ->label('Status Pendaftaran Buka'),
                TextColumn::make('academic_year')
                    ->label('Tahun Ajaran')
                    ->weight('bold')
                    ->searchable(),
                TextColumn::make('wave_name')
                    ->label('Gelombang Aktif')
                    ->searchable(),
                TextColumn::make('wave_period')
                    ->label('Periode'),
                TextColumn::make('quota_info')
                    ->label('Kuota'),
                TextColumn::make('updated_at')
                    ->label('Terakhir Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
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
