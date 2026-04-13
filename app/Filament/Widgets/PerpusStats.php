<?php

namespace App\Filament\Widgets;

use App\Models\Book;
use App\Models\Peminjaman;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PerpusStats extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Buku', Book::count())
                ->description('Semua koleksi')
                ->color('primary'),

            Stat::make('Sedang Dipinjam', Peminjaman::where('status', 'dipinjam')->count())
                ->description('Buku aktif dipinjam')
                ->color('warning'),

            Stat::make('Total User', User::count())
                ->description('Pengguna terdaftar')
                ->color('success'),

            Stat::make('Total Peminjaman', Peminjaman::count())
                ->description('Seluruh transaksi')
                ->color('danger'),
        ];
    }
}
