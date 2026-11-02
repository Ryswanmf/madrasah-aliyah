<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Pemberi Testimoni')
                    ->placeholder('Contoh: Ahmad Fauzi, S.Pd. / Hj. Siti Aminah')
                    ->required()
                    ->columnSpan(1),

                TextInput::make('role')
                    ->label('Profesi / Keterangan')
                    ->placeholder('Contoh: Alumni 2022 • Mahasiswa UIN Raden Intan / Wali Santri Kelas XI')
                    ->required()
                    ->columnSpan(1),

                Select::make('category')
                    ->label('Kategori')
                    ->options([
                        'alumni' => 'Alumni Madrasah',
                        'wali_santri' => 'Wali Santri',
                        'santri' => 'Santri Aktif',
                        'tokoh' => 'Tokoh Masyarakat',
                    ])
                    ->default('alumni')
                    ->required()
                    ->columnSpan(1),

                Select::make('rating')
                    ->label('Bintang Penilaian (Rating)')
                    ->options([
                        5 => '⭐⭐⭐⭐⭐ (5 Bintang - Sempurna)',
                        4 => '⭐⭐⭐⭐ (4 Bintang - Sangat Baik)',
                        3 => '⭐⭐⭐ (3 Bintang - Cukup)',
                    ])
                    ->default(5)
                    ->required()
                    ->columnSpan(1),

                TextInput::make('graduation_year')
                    ->label('Tahun Lulus (Khusus Alumni)')
                    ->placeholder('Contoh: 2023')
                    ->columnSpan(1),

                TextInput::make('order')
                    ->label('Urutan Tampil')
                    ->numeric()
                    ->default(0)
                    ->columnSpan(1),

                FileUpload::make('avatar')
                    ->label('Foto Profil / Avatar')
                    ->directory('testimonials')
                    ->image()
                    ->imageEditor()
                    ->helperText('Disarankan foto formal/semi-formal')
                    ->columnSpanFull(),

                Textarea::make('content')
                    ->label('Isi Kesan & Pesan / Testimoni')
                    ->placeholder('Tuliskan testimoni mengenai pengalaman belajar, hafalan Qur\'an, pembinaan akhlak, atau fasilitas di MA Darun Najah...')
                    ->rows(4)
                    ->required()
                    ->columnSpanFull(),

                Toggle::make('is_featured')
                    ->label('Tampilkan sebagai Unggulan di Beranda')
                    ->default(true)
                    ->columnSpan(1),

                Toggle::make('is_active')
                    ->label('Status Aktif / Diterbitkan')
                    ->default(true)
                    ->columnSpan(1),
            ]);
    }
}
