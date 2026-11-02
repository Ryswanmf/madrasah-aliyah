<?php

namespace App\Filament\Resources\Contacts\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Layanan / Divisi Kontak')
                    ->placeholder('Contoh: Sekretariat & Layanan PPDB')
                    ->required()
                    ->columnSpan(1),

                TextInput::make('pic_name')
                    ->label('Nama Petugas / PIC (Opsional)')
                    ->placeholder('Contoh: Ustadz Ahmad, S.Pd.I')
                    ->columnSpan(1),

                TextInput::make('whatsapp')
                    ->label('Nomor WhatsApp (Aktif)')
                    ->helperText('Gunakan format 08... atau 62... untuk link chat otomatis.')
                    ->placeholder('Contoh: 085658973426')
                    ->required()
                    ->columnSpan(1),

                TextInput::make('phone')
                    ->label('Nomor Telepon Kantor / HP')
                    ->placeholder('Contoh: 0856-5897-3426')
                    ->tel()
                    ->required()
                    ->columnSpan(1),

                TextInput::make('email')
                    ->label('Alamat Email Resmi')
                    ->placeholder('Contoh: madarunnajah.sambikarto@gmail.com')
                    ->email()
                    ->required()
                    ->columnSpan(1),

                TextInput::make('office_hours')
                    ->label('Jam Pelayanan Kantor')
                    ->placeholder('Contoh: Senin - Sabtu: 07.30 - 14.00 WIB')
                    ->required()
                    ->columnSpan(1),

                Textarea::make('address')
                    ->label('Alamat Lengkap Kampus / Sekretariat')
                    ->rows(3)
                    ->placeholder('Jl. Raya Bumi Agung, Desa Sambikarto, Kec. Sekampung...')
                    ->columnSpanFull(),

                Textarea::make('default_wa_message')
                    ->label('Template Pesan Otomatis WhatsApp')
                    ->helperText('Pesan pembuka ketika pengunjung mengklik tombol WhatsApp di website.')
                    ->rows(3)
                    ->placeholder("Assalamu'alaikum Panitia PPDB MA Darun Najah Sambikarto, saya ingin berkonsultasi...")
                    ->columnSpanFull(),

                Textarea::make('maps_embed_url')
                    ->label('Google Maps Embed URL (Iframe Src)')
                    ->helperText('Salin atribut src dari kode sematan Google Maps (https://www.google.com/maps/embed?pb=...)')
                    ->rows(2)
                    ->columnSpanFull(),

                TextInput::make('maps_link')
                    ->label('Link Google Maps (Direct Link)')
                    ->placeholder('https://maps.google.com/?q=...')
                    ->columnSpanFull(),

                TextInput::make('facebook_url')
                    ->label('Link Facebook')
                    ->placeholder('https://facebook.com/...')
                    ->url()
                    ->columnSpan(1),

                TextInput::make('instagram_url')
                    ->label('Link Instagram')
                    ->placeholder('https://instagram.com/...')
                    ->url()
                    ->columnSpan(1),

                TextInput::make('youtube_url')
                    ->label('Link YouTube')
                    ->placeholder('https://youtube.com/@...')
                    ->url()
                    ->columnSpan(1),

                TextInput::make('tiktok_url')
                    ->label('Link TikTok')
                    ->placeholder('https://tiktok.com/@...')
                    ->url()
                    ->columnSpan(1),

                Toggle::make('is_primary')
                    ->label('Jadikan Kontak Utama Website (Navbar, Hero, & Floating WA)')
                    ->helperText('Jika diaktifkan, nomor dan data ini yang akan digunakan di seluruh tombol WhatsApp website.')
                    ->default(true)
                    ->columnSpan(1),

                Toggle::make('is_active')
                    ->label('Status Aktif Ditampilkan')
                    ->default(true)
                    ->columnSpan(1),

                Textarea::make('notes')
                    ->label('Catatan Tambahan Internal')
                    ->rows(2)
                    ->columnSpanFull(),
            ]);
    }
}
