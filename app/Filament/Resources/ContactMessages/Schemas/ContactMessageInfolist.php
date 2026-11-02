<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactMessageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pengirim')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nama Pengirim')
                            ->weight('bold'),

                        TextEntry::make('phone')
                            ->label('Nomor WhatsApp / HP')
                            ->copyable(),

                        TextEntry::make('email')
                            ->label('Alamat Email')
                            ->default('-'),

                        TextEntry::make('created_at')
                            ->label('Waktu Dikirim')
                            ->dateTime('d F Y, H:i WIB'),

                        TextEntry::make('subject')
                            ->label('Topik / Keperluan')
                            ->badge()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Isi Pesan / Pertanyaan')
                    ->schema([
                        TextEntry::make('message')
                            ->label('')
                            ->prose()
                            ->columnSpanFull(),
                    ]),

                Section::make('Status Penanganan & Catatan Petugas')
                    ->schema([
                        IconEntry::make('is_read')
                            ->label('Status Dibaca')
                            ->boolean(),

                        TextEntry::make('read_at')
                            ->label('Waktu Dibaca')
                            ->dateTime('d M Y, H:i')
                            ->default('-'),

                        IconEntry::make('is_replied')
                            ->label('Status Dibalas')
                            ->boolean(),

                        TextEntry::make('replied_at')
                            ->label('Waktu Dibalas')
                            ->dateTime('d M Y, H:i')
                            ->default('-'),

                        TextEntry::make('admin_notes')
                            ->label('Catatan Tindak Lanjut')
                            ->default('Belum ada catatan tindak lanjut.')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
