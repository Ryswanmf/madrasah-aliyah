<?php

namespace App\Filament\Resources\Histories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class HistoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('order', 'asc')
            ->columns([
                ImageColumn::make('image')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl(asset('assets/images/gedung-2.jpg'))
                    ->toggleable(),

                TextColumn::make('period')
                    ->label('Fase / Periode')
                    ->badge()
                    ->color('info')
                    ->placeholder('-')
                    ->sortable(),

                TextColumn::make('title')
                    ->label('Judul Peristiwa / Tokoh')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(40)
                    ->tooltip(fn ($record) => $record->title),

                TextColumn::make('type')
                    ->label('Tipe Konten')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'milestone' => 'warning',
                        'tokoh' => 'success',
                        'narasi' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($record) => $record->type_label)
                    ->sortable(),

                TextColumn::make('badge')
                    ->label('Badge / Subjudul')
                    ->searchable()
                    ->placeholder('-')
                    ->toggleable(),

                TextColumn::make('order')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Status Aktif')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Filter Tipe Konten')
                    ->options([
                        'milestone' => 'Fase Tonggak Sejarah',
                        'tokoh' => 'Tokoh & Pengasuh',
                        'narasi' => 'Kilas Narasi Utama',
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
