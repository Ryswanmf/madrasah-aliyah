<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Berita / Warta')
                    ->placeholder('Contoh: Siswa/i MA Darun Najah Raih Juara Seni Hadroh')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (string $operation, $state, callable $set) {
                        if ($operation === 'create') {
                            $set('slug', Str::slug($state));
                            $set('meta_title', $state . ' • MA Darun Najah Sambikarto');
                        }
                    })
                    ->columnSpanFull(),

                TextInput::make('slug')
                    ->label('Slug URL (Permanen Link)')
                    ->helperText('Otomatis dibuat dari judul, gunakan huruf kecil dan tanda hubung (-)')
                    ->required()
                    ->unique('news', 'slug', ignoreRecord: true)
                    ->columnSpan(1),

                Select::make('category')
                    ->label('Kategori Warta')
                    ->options([
                        'Pengumuman PPDB' => 'Pengumuman PPDB',
                        'Prestasi Siswa/i' => 'Prestasi Siswa/i',
                        'Kepesantrenan' => 'Kepesantrenan',
                        'Vokasi & TIK' => 'Vokasi & TIK',
                        'Warta Madrasah' => 'Warta Madrasah',
                        'Kesiswaan & Ekskul' => 'Kesiswaan & Ekskul',
                        'Akademik & Ujian' => 'Akademik & Ujian',
                    ])
                    ->default('Warta Madrasah')
                    ->required()
                    ->columnSpan(1),

                TextInput::make('author')
                    ->label('Penulis / Sumber Redaksi')
                    ->default('Humas MA Darun Najah')
                    ->required()
                    ->columnSpan(1),

                DateTimePicker::make('published_at')
                    ->label('Tanggal & Waktu Terbit')
                    ->default(now())
                    ->required()
                    ->columnSpan(1),

                FileUpload::make('image')
                    ->label('Foto Sampul / Gambar Berita')
                    ->directory('news-images')
                    ->image()
                    ->imageEditor()
                    ->helperText('Format JPG, PNG, atau WebP. Disarankan rasio 16:9.')
                    ->columnSpanFull(),

                Textarea::make('excerpt')
                    ->label('Ringkasan Singkat (Lead Paragraph)')
                    ->rows(2)
                    ->placeholder('Ringkasan 1-2 kalimat untuk pratinjau kartu berita...')
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        if (empty($get('meta_description'))) {
                            $set('meta_description', Str::limit(strip_tags($state), 155));
                        }
                    })
                    ->columnSpanFull(),

                Textarea::make('content')
                    ->label('Isi Konten Berita Lengkap')
                    ->required()
                    ->rows(10)
                    ->placeholder('Tuliskan berita lengkap di sini. Pisahkan antar-paragraf dengan enter ganda...')
                    ->columnSpanFull(),

                TextInput::make('meta_title')
                    ->label('SEO Meta Title')
                    ->placeholder('Judul khusus mesin pencari Google (maks 60-70 karakter)')
                    ->helperText('Bila dikosongkan, otomatis menggunakan Judul Berita + Nama Madrasah.')
                    ->columnSpan(1),

                TextInput::make('meta_keywords')
                    ->label('SEO Meta Keywords')
                    ->placeholder('berita ma darun najah, sekampung, ppdb 2026, siswa prestasi')
                    ->helperText('Pisahkan kata kunci dengan tanda koma')
                    ->columnSpan(1),

                Textarea::make('meta_description')
                    ->label('SEO Meta Description')
                    ->rows(2)
                    ->placeholder('Deskripsi ringkas yang muncul pada hasil pencarian Google & pratinjau link WhatsApp...')
                    ->helperText('Panjang ideal 140 - 160 karakter untuk snippet Google.')
                    ->columnSpanFull(),

                Toggle::make('is_published')
                    ->label('Tayangkan ke Publik (Publish)')
                    ->helperText('Status tayang artikel di website')
                    ->default(true)
                    ->columnSpan(1),

                Toggle::make('is_featured')
                    ->label('Berita Unggulan (Tampil di Beranda)')
                    ->helperText('Aktif: Tampil di Beranda & Berita. Nonaktif: Hanya di Berita.')
                    ->default(false)
                    ->columnSpan(1),

                TextInput::make('views_count')
                    ->label('Total Pembaca (Views)')
                    ->numeric()
                    ->default(0)
                    ->disabled()
                    ->dehydrated(false)
                    ->columnSpanFull(),
            ]);
    }
}
