<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Pengirim & Isi Pesan')
                    ->description('Rincian identitas dan pertanyaan yang dikirimkan melalui form kontak website.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Pengirim')
                            ->required()
                            ->columnSpan(1),

                        TextInput::make('phone')
                            ->label('Nomor WhatsApp / HP')
                            ->tel()
                            ->required()
                            ->columnSpan(1),

                        TextInput::make('email')
                            ->label('Alamat Email')
                            ->email()
                            ->nullable()
                            ->columnSpan(1),

                        TextInput::make('subject')
                            ->label('Topik / Keperluan')
                            ->required()
                            ->columnSpan(1),

                        Textarea::make('message')
                            ->label('Isi Pesan / Pertanyaan')
                            ->rows(5)
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Status & Tindak Lanjut Admin')
                    ->description('Catatan penanganan dan konfirmasi status tanggapan panitia.')
                    ->schema([
                        Toggle::make('is_read')
                            ->label('Telah Dibaca')
                            ->helperText('Otomatis aktif saat rincian pesan dibuka.')
                            ->default(false),

                        Toggle::make('is_replied')
                            ->label('Telah Ditanggapi / Dibalas')
                            ->helperText('Aktifkan jika panitia telah membalas via WA/Email.')
                            ->default(false),

                        Textarea::make('admin_notes')
                            ->label('Catatan Petugas / Tindak Lanjut')
                            ->placeholder('Contoh: Telah ditelepon oleh panitia pada tgl 2 Nov, orang tua / wali murid akan mendaftar online malam ini.')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
