<?php

namespace App\Filament\Widgets;

use App\Models\Book;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class StokBuku extends BaseWidget
{
    protected static ?string $heading = 'Stok Buku Menipis';

    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return Book::query()->where('stok', '<=', 3);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('judul'),
            Tables\Columns\TextColumn::make('penulis'),
            Tables\Columns\TextColumn::make('genres.name')
                ->badge()
                ->label('Genre'),
            Tables\Columns\TextColumn::make('tahun_terbit')
                ->date('Y'),
            Tables\Columns\TextColumn::make('stok')
                ->badge()
                ->color('danger'),
        ];
    }
}
