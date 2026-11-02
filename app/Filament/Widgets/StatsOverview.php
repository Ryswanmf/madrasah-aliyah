<?php

namespace App\Filament\Widgets;

use App\Models\Contact;
use App\Models\News;
use App\Models\PpdbRegistration;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalPpdb = PpdbRegistration::count();
        $pendingPpdb = PpdbRegistration::where('status', 'pending')->count();
        $acceptedPpdb = PpdbRegistration::where('status', 'accepted')->count();
        $totalNews = News::where('is_published', true)->count();
        $primaryContact = Contact::where('is_primary', true)->first();

        return [
            Stat::make('Total Pendaftar PPDB', $totalPpdb)
                ->description('Santri Baru TP 2026/2027')
                ->descriptionIcon(Heroicon::OutlinedAcademicCap)
                ->color('primary'),

            Stat::make('Menunggu Verifikasi', $pendingPpdb)
                ->description('Perlu tindak lanjut berkas')
                ->descriptionIcon(Heroicon::OutlinedClock)
                ->color($pendingPpdb > 0 ? 'warning' : 'gray'),

            Stat::make('Santri Diterima', $acceptedPpdb)
                ->description('Lolos seleksi & beasiswa')
                ->descriptionIcon(Heroicon::OutlinedCheckCircle)
                ->color('success'),

            Stat::make('Hotline Aktif', $primaryContact ? ($primaryContact->phone ?: $primaryContact->whatsapp) : 'Belum diatur')
                ->description($primaryContact ? $primaryContact->name : 'Atur di Menu Kontak')
                ->descriptionIcon(Heroicon::OutlinedPhone)
                ->color('success'),
        ];
    }
}
