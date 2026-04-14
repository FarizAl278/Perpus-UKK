<?php

namespace App\Filament\Widgets;

use App\Models\Book;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Genres;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PerpusStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Buku', Book::count())
                ->description('Total koleksi buku')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('success')
                ->chart([7, 5, 6, 7, 8, 6, 7]),

            Stat::make('Total Siswa', User::count())
                ->description('Siswa terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('info')
                ->chart([2, 3, 4, 2, 4, 5, 4]),

            Stat::make('Peminjaman Aktif', Peminjaman::where('status', 'dipinjam')->count())
                ->description('Sedang dipinjam')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('warning')
                ->chart([5, 5, 4, 7, 7, 6, 5]),

            Stat::make('Total Kategori', Genres::count())
                ->description('Kategori buku')
                ->descriptionIcon('heroicon-m-tag')
                ->color('primary')
                ->chart([1, 1, 2, 2, 4, 4, 5]),
        ];
    }
}