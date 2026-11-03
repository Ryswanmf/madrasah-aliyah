<?php

namespace App\Filament\Resources\PpdbRegistrations\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PpdbRegistrationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('registration_number')
                    ->label('No. Registrasi')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->fontFamily('mono')
                    ->weight('bold')
                    ->color('primary'),

                TextColumn::make('full_name')
                    ->label('Nama Calon Siswa/i')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('gender')
                    ->label('L/P')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state === 'L' ? 'Laki-laki' : 'Perempuan')
                    ->color(fn ($state) => $state === 'L' ? 'info' : 'danger'),

                TextColumn::make('school_origin')
                    ->label('Asal Sekolah')
                    ->searchable()
                    ->limit(24)
                    ->tooltip(fn ($record) => $record->school_origin),

                TextColumn::make('program_choice')
                    ->label('Pilihan Peminatan')
                    ->searchable()
                    ->badge()
                    ->color('gray'),

                IconColumn::make('dormitory_choice')
                    ->label('Asrama (Mondok)')
                    ->boolean()
                    ->trueIcon(Heroicon::OutlinedHomeModern)
                    ->falseIcon(Heroicon::OutlinedBuildingOffice)
                    ->trueColor('success')
                    ->falseColor('gray'),

                TextColumn::make('phone_number')
                    ->label('No. WhatsApp')
                    ->searchable()
                    ->fontFamily('mono')
                    ->icon(Heroicon::OutlinedPhone),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'verified',
                        'success' => 'accepted',
                        'danger' => 'rejected',
                    ])
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'pending' => 'Menunggu Verifikasi',
                        'verified' => 'Berkas Terverifikasi',
                        'accepted' => 'DITERIMA',
                        'rejected' => 'Tidak Lolos',
                        default => $state,
                    }),

                TextColumn::make('created_at')
                    ->label('Tgl Daftar')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('parent_name')
                    ->label('Nama Orang Tua')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('birth_place')
                    ->label('Tempat Lahir')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('birth_date')
                    ->label('Tanggal Lahir')
                    ->date('d M Y')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status Pendaftaran')
                    ->options([
                        'pending' => 'Menunggu Verifikasi',
                        'verified' => 'Berkas Terverifikasi',
                        'accepted' => 'DITERIMA',
                        'rejected' => 'Tidak Lolos',
                    ]),

                SelectFilter::make('program_choice')
                    ->label('Pilihan Peminatan')
                    ->options([
                        'Peminatan IPA Terpadu' => 'Peminatan IPA Terpadu',
                        'Peminatan Keagamaan (Agama Islam)' => 'Peminatan Keagamaan',
                    ]),

                TernaryFilter::make('dormitory_choice')
                    ->label('Status Asrama')
                    ->trueLabel('Siswa/i Asrama (Bermukim)')
                    ->falseLabel('Siswa/i Reguler (Non-Asrama)'),
            ])
            ->headerActions([
                Action::make('export_csv')
                    ->label('Ekspor ke Excel / CSV')
                    ->icon(Heroicon::OutlinedArrowDownTray)
                    ->color('success')
                    ->url(route('admin.ppdb.export')),
            ])
            ->recordActions([
                Action::make('print')
                    ->label('Cetak Bukti')
                    ->icon(Heroicon::OutlinedPrinter)
                    ->color('warning')
                    ->url(fn ($record) => route('ppdb.print', $record->registration_number), shouldOpenInNewTab: true),

                Action::make('whatsapp')
                    ->label('Chat WA')
                    ->icon(Heroicon::OutlinedChatBubbleLeftEllipsis)
                    ->color('success')
                    ->url(function ($record) {
                        $clean = preg_replace('/[^0-9]/', '', $record->phone_number);
                        if (str_starts_with($clean, '0')) {
                            $clean = '62' . substr($clean, 1);
                        }
                        $text = "Assalamu'alaikum Wr. Wb. Bapak/Ibu Wali dari {$record->full_name},\n\nKami dari Panitia PPDB MA Darun Najah Sambikarto mengonfirmasi pendaftaran No. {$record->registration_number} status saat ini: " . strtoupper($record->status) . ".";
                        return "https://wa.me/{$clean}?text=" . rawurlencode($text);
                    }, shouldOpenInNewTab: true),

                Action::make('verify')
                    ->label('Verifikasi')
                    ->icon(Heroicon::OutlinedCheckBadge)
                    ->color('info')
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update(['status' => 'verified']);
                        Notification::make()
                            ->title('Status Diperbarui')
                            ->body("Pendaftar {$record->full_name} telah diverifikasi.")
                            ->success()
                            ->send();
                    }),

                Action::make('accept')
                    ->label('Terima Siswa/i')
                    ->icon(Heroicon::OutlinedCheckCircle)
                    ->color('success')
                    ->visible(fn ($record) => in_array($record->status, ['pending', 'verified']))
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update(['status' => 'accepted']);
                        Notification::make()
                            ->title('Siswa/i Diterima!')
                            ->body("{$record->full_name} dinyatakan Diterima sebagai siswa/i baru.")
                            ->success()
                            ->send();
                    }),

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
