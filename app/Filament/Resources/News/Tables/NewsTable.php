<?php

namespace App\Filament\Resources\News\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class NewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('published_at', 'desc')
            ->columns([
                ImageColumn::make('image')
                    ->label('Sampul')
                    ->state(fn ($record) => $record->image_url)
                    ->extraImgAttributes(['class' => 'rounded-md object-cover'])
                    ->width(60)
                    ->height(40),

                TextColumn::make('title')
                    ->label('Judul Berita / Warta')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(40)
                    ->tooltip(fn ($record) => $record->title),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color('primary')
                    ->searchable(),

                IconColumn::make('is_featured')
                    ->label('Unggulan')
                    ->boolean()
                    ->trueIcon('heroicon-s-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray')
                    ->tooltip(fn ($record) => $record->is_featured ? 'Unggulan (Tampil di Beranda & Berita)' : 'Reguler (Hanya di Berita)'),

                IconColumn::make('is_published')
                    ->label('Tayang')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger'),

                TextColumn::make('views_count')
                    ->label('Views')
                    ->numeric()
                    ->sortable()
                    ->alignCenter(),

                TextColumn::make('published_at')
                    ->label('Tgl Terbit')
                    ->dateTime('d M Y')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('is_featured')
                    ->label('Tipe Penayangan')
                    ->options([
                        1 => 'Unggulan (Tampil di Beranda & Berita)',
                        0 => 'Reguler (Hanya di Berita)',
                    ]),

                SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'Pengumuman PPDB' => 'Pengumuman PPDB',
                        'Prestasi Siswa/i' => 'Prestasi Siswa/i',
                        'Kepesantrenan' => 'Kepesantrenan',
                        'Vokasi & TIK' => 'Vokasi & TIK',
                        'Warta Madrasah' => 'Warta Madrasah',
                        'Kesiswaan & Ekskul' => 'Kesiswaan & Ekskul',
                        'Akademik & Ujian' => 'Akademik & Ujian',
                    ]),

                SelectFilter::make('is_published')
                    ->label('Status')
                    ->options([
                        1 => 'Tayang (Published)',
                        0 => 'Draf (Unpublished)',
                    ]),
            ])
            ->recordActions([
                Action::make('toggle_featured')
                    ->label(fn ($record) => $record->is_featured ? 'Batal Unggulan' : 'Set Unggulan')
                    ->icon('heroicon-s-star')
                    ->color(fn ($record) => $record->is_featured ? 'warning' : 'gray')
                    ->tooltip(fn ($record) => $record->is_featured ? 'Hapus dari Beranda' : 'Tampilkan di Beranda')
                    ->action(function ($record) {
                        $record->update(['is_featured' => ! $record->is_featured]);
                    }),

                Action::make('preview')
                    ->label('Lihat Web')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->color('gray')
                    ->url(fn ($record) => route('berita.detail', $record->slug))
                    ->openUrlInNewTab(),

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
