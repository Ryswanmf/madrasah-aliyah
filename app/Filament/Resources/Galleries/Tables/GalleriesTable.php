<?php

namespace App\Filament\Resources\Galleries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class GalleriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('order', 'asc')
            ->columns([
                ImageColumn::make('image')
                    ->label('Foto')
                    ->circular(false)
                    ->extraImgAttributes(['class' => 'rounded-lg object-cover'])
                    ->state(fn ($record) => $record->image_url),

                TextColumn::make('title')
                    ->label('Judul Dokumentasi Foto')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(45)
                    ->tooltip(fn ($record) => $record->title),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color('primary')
                    ->formatStateUsing(fn ($record) => $record->category_label ?: $record->category),

                TextColumn::make('order')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable(),

                IconColumn::make('is_published')
                    ->label('Tayang')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger'),

                TextColumn::make('created_at')
                    ->label('Tgl Upload')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'kegiatan' => 'Aktivitas & Belajar',
                        'ibadah' => 'Kajian & Ibadah',
                        'sarana' => 'Gedung & Sarana',
                        'ekskul' => 'Ekskul & Olahraga',
                        'prestasi' => 'Prestasi Siswa/i',
                    ]),

                SelectFilter::make('is_published')
                    ->label('Status')
                    ->options([
                        1 => 'Tayang di Website',
                        0 => 'Draf (Disembunyikan)',
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
