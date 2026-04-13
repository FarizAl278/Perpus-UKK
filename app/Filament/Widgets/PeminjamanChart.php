<?php

namespace App\Filament\Widgets;

use App\Models\Peminjaman;
use Filament\Widgets\ChartWidget;

class PeminjamanChart extends ChartWidget
{
    protected ?string $heading = 'Status Peminjaman';

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 1;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'data' => [
                        Peminjaman::where('status', 'pengambilan')->count(),
                        Peminjaman::where('status', 'dipinjam')->count(),
                        Peminjaman::where('status', 'kembali')->count(),
                        Peminjaman::where('status', 'dibatalkan')->count(),
                    ],
                ],
            ],

            'labels' => [
                'Pengambilan',
                'Dipinjam',
                'Kembali',
                'Dibatalkan',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
