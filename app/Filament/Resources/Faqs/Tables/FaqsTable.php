<?php

namespace App\Filament\Resources\Faqs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class FaqsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('order', 'asc')
            ->columns([
                TextColumn::make('order')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('question')
                    ->label('Pertanyaan (FAQ)')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(55)
                    ->tooltip(fn ($record) => $record->question),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'ppdb' => 'success',
                        'pesantren' => 'warning',
                        'akademik' => 'info',
                        'biaya' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($record) => $record->category_label)
                    ->sortable(),

                TextColumn::make('answer')
                    ->label('Kutipan Jawaban')
                    ->limit(40)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('keywords')
                    ->label('Keywords')
                    ->searchable()
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('is_featured')
                    ->label('Unggulan')
                    ->boolean()
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Aktif')
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
                        'ppdb' => 'PPDB & Pendaftaran',
                        'pesantren' => 'Asrama & Pesantren',
                        'akademik' => 'Kurikulum & Legalitas',
                        'biaya' => 'Biaya & Beasiswa',
                        'umum' => 'Informasi Umum',
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
