<?php

namespace App\Filament\Resources\Teachers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TeachersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('order', 'asc')
            ->columns([
                ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl(fn ($record) => $record->photo_url),
                TextColumn::make('name')
                    ->label('Nama & Gelar')
                    ->searchable()
                    ->weight('bold')
                    ->description(fn ($record) => $record->role),
                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->formatStateUsing(fn ($record) => $record->category_label)
                    ->color(fn (string $state): string => match ($state) {
                        'pimpinan' => 'success',
                        'asatidz_kitab' => 'warning',
                        'guru_mapel' => 'info',
                        default => 'gray',
                    }),
                TextColumn::make('education')
                    ->label('Pendidikan / Almamater')
                    ->limit(30)
                    ->tooltip(fn ($record) => $record->education),
                ToggleColumn::make('is_featured')
                    ->label('Unggulan Beranda'),
                ToggleColumn::make('is_active')
                    ->label('Aktif'),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'pimpinan' => 'Pimpinan & Guru Pembina',
                        'asatidz_kitab' => 'Dewan Guru Keagamaan & Kitab',
                        'guru_mapel' => 'Guru Mata Pelajaran Umum',
                        'staf' => 'Tenaga Kependidikan & TU',
                    ]),
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
