<?php

namespace App\Filament\Resources\Curricula\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CurriculaTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('order', 'asc')
            ->columns([
                TextColumn::make('title')
                    ->label('Nama Mata Pelajaran / Kitab / Pilar')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(40)
                    ->tooltip(fn ($record) => $record->title),

                TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pilar' => 'success',
                        'kitab' => 'warning',
                        'vokasi' => 'info',
                        'program_unggulan' => 'primary',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($record) => $record->type_label),

                TextColumn::make('grade')
                    ->label('Jenjang / Kelas')
                    ->badge()
                    ->color('gray')
                    ->formatStateUsing(fn ($record) => $record->grade_label),

                TextColumn::make('category_label')
                    ->label('Rumpun / Kategori')
                    ->searchable()
                    ->placeholder('-'),

                TextColumn::make('author')
                    ->label('Muallif / Pengarang')
                    ->searchable()
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('order')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger'),

                TextColumn::make('created_at')
                    ->label('Tgl Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Filter Tipe')
                    ->options([
                        'pilar' => 'Pilar Utama',
                        'kitab' => 'Kitab Turats Salaf',
                        'vokasi' => 'Vokasi & Keterampilan',
                        'program_unggulan' => 'Program Unggulan',
                    ]),

                SelectFilter::make('grade')
                    ->label('Filter Tingkat Kelas')
                    ->options([
                        '10' => 'Kelas X (Ula)',
                        '11' => 'Kelas XI (Wustha)',
                        '12' => 'Kelas XII (Ulya)',
                        'all' => 'Semua Tingkat / Umum',
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
