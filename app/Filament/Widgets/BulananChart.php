<?php

namespace App\Filament\Widgets;

use App\Models\Peminjaman;
use Filament\Widgets\ChartWidget;

class BulananChart extends ChartWidget
{
    protected ?string $heading = 'Peminjaman per Bulan';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 1;

    protected function getData(): array
    {
        $data = [];

        for ($i = 1; $i <= 12; $i++) {
            $data[] = Peminjaman::whereMonth('created_at', $i)->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah',
                    'data' => $data,
                ],
            ],

            'labels' => [
                'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
