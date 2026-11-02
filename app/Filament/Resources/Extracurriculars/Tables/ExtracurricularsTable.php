<?php

namespace App\Filament\Resources\Extracurriculars\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ExtracurricularsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('order', 'asc')
            ->columns([
                ImageColumn::make('image')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl(asset('assets/images/gallery-2.jpg'))
                    ->toggleable(),

                TextColumn::make('name')
                    ->label('Nama Ekstrakurikuler')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(35)
                    ->tooltip(fn ($record) => $record->name),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'seni' => 'success',
                        'olahraga' => 'danger',
                        'organisasi' => 'primary',
                        'vokasi' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($record) => $record->category_label)
                    ->sortable(),

                TextColumn::make('badge')
                    ->label('Badge / Subjudul')
                    ->searchable()
                    ->placeholder('-')
                    ->toggleable(),

                TextColumn::make('schedule')
                    ->label('Jadwal Rutin')
                    ->searchable()
                    ->placeholder('-')
                    ->limit(25),

                TextColumn::make('coach')
                    ->label('Pembina / Pelatih')
                    ->searchable()
                    ->placeholder('-')
                    ->toggleable(),

                TextColumn::make('order')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable(),

                IconColumn::make('is_featured')
                    ->label('Featured Beranda')
                    ->boolean()
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
                SelectFilter::make('category')
                    ->label('Filter Kategori')
                    ->options([
                        'seni' => 'Seni Islami & Bahasa',
                        'olahraga' => 'Olahraga & Bela Diri',
                        'organisasi' => 'Kepanduan & Organisasi',
                        'vokasi' => 'TIK & Keterampilan',
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
