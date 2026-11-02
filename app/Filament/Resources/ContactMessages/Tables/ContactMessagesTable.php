<?php

namespace App\Filament\Resources\ContactMessages\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class ContactMessagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                IconColumn::make('is_read')
                    ->label('Dibaca')
                    ->boolean()
                    ->trueIcon(Heroicon::OutlinedEnvelopeOpen)
                    ->falseIcon(Heroicon::OutlinedEnvelope)
                    ->trueColor('gray')
                    ->falseColor('danger')
                    ->tooltip(fn ($record) => $record->is_read ? 'Pesan telah dibaca' : 'Pesan BARU (Belum dibaca)'),

                TextColumn::make('name')
                    ->label('Nama Pengirim')
                    ->searchable()
                    ->sortable()
                    ->weight(fn ($record) => $record->is_read ? 'normal' : 'bold')
                    ->description(fn ($record) => $record->email ?: null),

                TextColumn::make('phone')
                    ->label('No. WhatsApp')
                    ->searchable()
                    ->copyable()
                    ->fontFamily('mono')
                    ->icon(Heroicon::OutlinedPhone),

                TextColumn::make('subject')
                    ->label('Topik / Keperluan')
                    ->searchable()
                    ->badge()
                    ->colors([
                        'warning' => 'Informasi PPDB 2026/2027',
                        'success' => 'Kurikulum & Kepesantrenan',
                        'info' => 'Kunjungan Lembaga',
                        'gray' => 'Lainnya',
                    ]),

                TextColumn::make('message')
                    ->label('Ringkasan Pesan')
                    ->limit(45)
                    ->tooltip(fn ($record) => $record->message),

                TextColumn::make('is_replied')
                    ->label('Status Balas')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Sudah Dibalas' : 'Belum Dibalas')
                    ->color(fn ($state) => $state ? 'success' : 'warning'),

                TextColumn::make('created_at')
                    ->label('Waktu Masuk')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->since()
                    ->tooltip(fn ($record) => $record->created_at->format('d F Y, H:i:s WIB')),
            ])
            ->filters([
                TernaryFilter::make('is_read')
                    ->label('Status Baca')
                    ->trueLabel('Sudah Dibaca')
                    ->falseLabel('Belum Dibaca (Baru)'),

                TernaryFilter::make('is_replied')
                    ->label('Status Balas')
                    ->trueLabel('Sudah Ditanggapi / Dibalas')
                    ->falseLabel('Belum Dibalas'),

                SelectFilter::make('subject')
                    ->label('Topik')
                    ->options([
                        'Informasi PPDB 2026/2027' => 'Informasi PPDB 2026/2027',
                        'Kurikulum & Kepesantrenan' => 'Kurikulum & Kepesantrenan',
                        'Administrasi & Surat Menyurat' => 'Administrasi & Surat Menyurat',
                        'Kunjungan Lembaga' => 'Kunjungan Lembaga',
                        'Lainnya' => 'Lainnya',
                    ]),
            ])
            ->recordActions([
                Action::make('reply_wa')
                    ->label('Balas WA')
                    ->icon(Heroicon::OutlinedChatBubbleLeftRight)
                    ->color('success')
                    ->url(fn ($record) => $record->wa_reply_url, shouldOpenInNewTab: true),

                Action::make('mark_replied')
                    ->label('Tandai Dibalas')
                    ->icon(Heroicon::OutlinedCheckCircle)
                    ->color('info')
                    ->visible(fn ($record) => ! $record->is_replied)
                    ->schema([
                        Textarea::make('admin_notes')
                            ->label('Catatan Tindak Lanjut (Opsional)')
                            ->placeholder('Tuliskan ringkasan hasil tanggapan, misal: Telah dihubungi via WA.'),
                    ])
                    ->action(function ($record, array $data) {
                        $record->markAsReplied($data['admin_notes'] ?? null);
                        Notification::make()
                            ->title('Pesan Ditandai Telah Dibalas')
                            ->success()
                            ->send();
                    }),

                Action::make('mark_read')
                    ->label('Tandai Dibaca')
                    ->icon(Heroicon::OutlinedCheck)
                    ->color('gray')
                    ->visible(fn ($record) => ! $record->is_read)
                    ->action(function ($record) {
                        $record->markAsRead();
                        Notification::make()
                            ->title('Pesan Ditandai Dibaca')
                            ->success()
                            ->send();
                    }),

                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('mark_all_read')
                        ->label('Tandai Semua Dibaca')
                        ->icon(Heroicon::OutlinedCheck)
                        ->action(function (Collection $records) {
                            $records->each(fn ($record) => $record->markAsRead());
                            Notification::make()
                                ->title('Pesan Terpilih Ditandai Dibaca')
                                ->success()
                                ->send();
                        }),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
