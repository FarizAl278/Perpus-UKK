<?php

namespace App\Filament\Widgets;

use App\Models\Peminjaman;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Support\Carbon;

class LatestPeminjaman extends TableWidget
{
    protected static ?string $heading = 'Peminjaman Terbaru';

    protected static ?int $sort = 5;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Peminjaman::query()->latest()->limit(5)
            )
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama'),

                TextColumn::make('kelas')
                    ->label('Kelas')
                    ->formatStateUsing(fn ($record) => $record->kelas.' • '.$record->jurusan)
                    ->searchable(['kelas', 'jurusan']),

                TextColumn::make('book.judul')
                    ->label('Buku'),

                TextColumn::make('status')
                    ->badge(),

                TextColumn::make('tanggal_kembali')
                    ->label('Tenggat')
                    ->formatStateUsing(function ($state, $record) {
                        $pinjam = Carbon::parse($record->tanggal_peminjaman)->format('d M');
                        $kembali = Carbon::parse($record->tanggal_kembali)->format('d M Y');

                        return $pinjam.' - '.$kembali;
                    })
                    ->sortable(),
            ]);
    }
}
