<?php

namespace App\Filament\Resources\Teachers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TeacherForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Lengkap & Gelar')
                    ->placeholder('Contoh: H. Masruri, S.Pd.I, M.Pd. / Ustadz Muhammad Yusuf, Al-Hafidz')
                    ->required()
                    ->columnSpan(1),

                TextInput::make('nip_or_niy')
                    ->label('NIP / NIY (Nomor Induk Yayasan)')
                    ->placeholder('Contoh: 198507152010011002 atau -')
                    ->columnSpan(1),

                TextInput::make('role')
                    ->label('Jabatan / Amanah')
                    ->placeholder('Contoh: Kepala Madrasah / Guru Fiqih & Tafsir / Pembina Tahfidz')
                    ->required()
                    ->columnSpan(1),

                Select::make('category')
                    ->label('Kategori Pendidik')
                    ->options([
                        'pimpinan' => 'Pimpinan & Pengasuh',
                        'asatidz_kitab' => 'Dewan Asatidz Kitab & Pesantren',
                        'guru_mapel' => 'Guru Mata Pelajaran Umum',
                        'staf' => 'Tenaga Kependidikan & Tata Usaha',
                    ])
                    ->default('guru_mapel')
                    ->required()
                    ->columnSpan(1),

                TextInput::make('education')
                    ->label('Riwayat Pendidikan / Almamater Pesantren')
                    ->placeholder('Contoh: S1 PAI UIN Sunan Kalijaga • Ponpes Lirboyo Kediri')
                    ->columnSpanFull(),

                FileUpload::make('photo')
                    ->label('Foto Resmi Pendidik')
                    ->directory('teachers')
                    ->image()
                    ->imageEditor()
                    ->helperText('Disarankan foto formal berlatar polos (rasio 3:4 atau 1:1)')
                    ->columnSpanFull(),

                Textarea::make('bio')
                    ->label('Biografi Singkat / Pengabdian')
                    ->placeholder('Pengalaman mengajar, bidang keahlian, atau amanah keorganisasian...')
                    ->rows(3)
                    ->columnSpanFull(),

                TextInput::make('phone')
                    ->label('Nomor Kontak / WhatsApp (Opsional)')
                    ->placeholder('08xxxxxxxxxx')
                    ->columnSpan(1),

                TextInput::make('order')
                    ->label('Urutan Tampil')
                    ->numeric()
                    ->default(0)
                    ->helperText('Nomor urut terkecil tampil paling awal')
                    ->columnSpan(1),

                Toggle::make('is_featured')
                    ->label('Tampilkan sebagai Pendidik Unggulan di Beranda')
                    ->default(true)
                    ->columnSpan(1),

                Toggle::make('is_active')
                    ->label('Status Aktif Mengajar')
                    ->default(true)
                    ->columnSpan(1),
            ]);
    }
}
