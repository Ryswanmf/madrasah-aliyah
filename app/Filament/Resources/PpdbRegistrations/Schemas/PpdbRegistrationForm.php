<?php

namespace App\Filament\Resources\PpdbRegistrations\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PpdbRegistrationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('registration_number')
                    ->label('Nomor Registrasi')
                    ->required()
                    ->readOnly()
                    ->columnSpan(1),

                Select::make('status')
                    ->label('Status Pendaftaran')
                    ->options([
                        'pending' => 'Menunggu Verifikasi',
                        'verified' => 'Berkas Terverifikasi',
                        'accepted' => 'DITERIMA',
                        'rejected' => 'Tidak Lolos',
                    ])
                    ->default('pending')
                    ->required()
                    ->columnSpan(1),

                TextInput::make('full_name')
                    ->label('Nama Lengkap Santri')
                    ->required()
                    ->columnSpan(2),

                TextInput::make('nisn')
                    ->label('NISN')
                    ->maxLength(20)
                    ->columnSpan(1),

                Select::make('gender')
                    ->label('Jenis Kelamin')
                    ->options([
                        'L' => 'Laki-laki (Santri Putra)',
                        'P' => 'Perempuan (Santri Putri)',
                    ])
                    ->default('L')
                    ->required()
                    ->columnSpan(1),

                TextInput::make('birth_place')
                    ->label('Tempat Lahir')
                    ->required()
                    ->columnSpan(1),

                DatePicker::make('birth_date')
                    ->label('Tanggal Lahir')
                    ->required()
                    ->columnSpan(1),

                TextInput::make('school_origin')
                    ->label('Asal Sekolah (SMP/MTs)')
                    ->required()
                    ->columnSpan(2),

                TextInput::make('parent_name')
                    ->label('Nama Orang Tua / Wali')
                    ->required()
                    ->columnSpan(1),

                TextInput::make('phone_number')
                    ->label('No. WhatsApp Aktif')
                    ->tel()
                    ->required()
                    ->columnSpan(1),

                Textarea::make('address')
                    ->label('Alamat Domisili Lengkap')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),

                Select::make('program_choice')
                    ->label('Pilihan Peminatan')
                    ->options([
                        'Peminatan IPA Terpadu' => 'Peminatan IPA Terpadu (Sains & Kedokteran)',
                        'Peminatan Keagamaan (Agama Islam)' => 'Peminatan Keagamaan (Dirasah Islamiyah & Kitab Kuning)',
                    ])
                    ->required()
                    ->columnSpan(1),

                Toggle::make('dormitory_choice')
                    ->label('Mukim di Pondok Pesantren (Tinggal di Asrama)')
                    ->default(true)
                    ->columnSpan(1),

                Textarea::make('notes')
                    ->label('Catatan Panitia / Verifikasi Berkas')
                    ->placeholder('Catatan kelengkapan dokumen fisik, hasil tes Al-Qur\'an, atau info beasiswa...')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }
}
