<?php

namespace App\Filament\Resources\Contacts\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ContactsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('is_primary', 'desc')
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Layanan / Kontak')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn ($record) => $record->pic_name ? 'PIC: ' . $record->pic_name : null),

                IconColumn::make('is_primary')
                    ->label('Utama (Website)')
                    ->boolean()
                    ->trueIcon(Heroicon::OutlinedStar)
                    ->falseIcon(Heroicon::OutlinedMinus)
                    ->trueColor('warning')
                    ->falseColor('gray'),

                TextColumn::make('whatsapp')
                    ->label('No. WhatsApp')
                    ->searchable()
                    ->fontFamily('mono')
                    ->copyable()
                    ->icon(Heroicon::OutlinedChatBubbleLeft),

                TextColumn::make('phone')
                    ->label('No. Telepon / HP')
                    ->searchable()
                    ->fontFamily('mono'),

                TextColumn::make('email')
                    ->label('Email Resmi')
                    ->searchable()
                    ->icon(Heroicon::OutlinedEnvelope),

                TextColumn::make('office_hours')
                    ->label('Jam Pelayanan')
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: false),

                IconColumn::make('is_active')
                    ->label('Status Aktif')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger'),

                TextColumn::make('updated_at')
                    ->label('Terakhir Diubah')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        1 => 'Aktif Ditampilkan',
                        0 => 'Non-Aktif',
                    ]),
            ])
            ->recordActions([
                Action::make('test_wa')
                    ->label('Tes Chat WA')
                    ->icon(Heroicon::OutlinedArrowTopRightOnSquare)
                    ->color('success')
                    ->url(fn ($record) => $record->getWaLink(), shouldOpenInNewTab: true),

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
