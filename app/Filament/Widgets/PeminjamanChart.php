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
        $pengambilan = Peminjaman::where('status', 'pengambilan')->count();
        $dipinjam    = Peminjaman::where('status', 'dipinjam')->count();
        $kembali     = Peminjaman::where('status', 'kembali')->count();
        $terlambat    = Peminjaman::where('status', 'terlambat')->count();
        $dibatalkan  = Peminjaman::where('status', 'dibatalkan')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah',
                    'data' => [
                        $pengambilan,
                        $dipinjam,
                        $kembali,
                        $terlambat,
                        $dibatalkan,
                    ],

                    // warna utama
                    'backgroundColor' => [
                        '#f59e0b', // amber
                        '#3b82f6', // blue
                        '#10b981', // emerald
                        '#ef4444', // red
                        '#8b5cf6', // violet
                    ],

                    // border biar clean
                    'borderColor' => [
                        '#fbbf24',
                        '#60a5fa',
                        '#34d399',
                        '#f87171',
                        '#a78bfa',
                        '#f472b6',
                    ],

                    'borderWidth' => 2,

                    // jarak antar slice
                    'spacing' => 4,

                    // efek hover meledak keluar
                    'hoverOffset' => 18,

                    // cutout biar donut modern
                    'cutout' => '68%',
                ],
            ],

            'labels' => [
                'Pengambilan',
                'Dipinjam',
                'Kembali',
                'Terlambat',
                'Dibatalkan',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                    'labels' => [
                        'color' => '#9ca3af',
                        'padding' => 18,
                        'usePointStyle' => true,
                        'pointStyle' => 'circle',
                    ],
                ],

                'tooltip' => [
                    'backgroundColor' => '#111827',
                    'titleColor' => '#ffffff',
                    'bodyColor' => '#d1d5db',
                    'padding' => 12,
                    'cornerRadius' => 12,
                ],
            ],

            'animation' => [
                'animateRotate' => true,
                'animateScale' => true,
            ],

            'maintainAspectRatio' => false,
        ];
    }
}