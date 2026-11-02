<?php

namespace App\Filament\Resources\Achievements\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class AchievementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Dokumentasi')
                    ->circular()
                    ->defaultImageUrl(asset('assets/images/gallery-2.jpg')),
                TextColumn::make('title')
                    ->label('Nama Prestasi')
                    ->searchable()
                    ->weight('bold')
                    ->description(fn ($record) => $record->student_name),
                TextColumn::make('level')
                    ->label('Tingkat')
                    ->badge()
                    ->formatStateUsing(fn ($record) => $record->level_label)
                    ->color(fn (string $state): string => match ($state) {
                        'nasional', 'internasional' => 'success',
                        'provinsi' => 'warning',
                        'kabupaten' => 'info',
                        default => 'gray',
                    }),
                TextColumn::make('year')
                    ->label('Tahun')
                    ->sortable(),
                ToggleColumn::make('is_featured')
                    ->label('Unggulan Beranda'),
                ToggleColumn::make('is_active')
                    ->label('Aktif'),
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
