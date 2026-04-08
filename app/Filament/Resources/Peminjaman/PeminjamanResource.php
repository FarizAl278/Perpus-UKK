<?php

namespace App\Filament\Resources\Peminjaman;

use App\Filament\Resources\Peminjaman\Pages\ListPeminjaman;
use App\Filament\Resources\Peminjaman\Tables\PeminjamanTable;
use App\Models\Peminjaman;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PeminjamanResource extends Resource
{
    protected static ?string $model = Peminjaman::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;
    protected static ?string $navigationLabel = 'Peminjaman';
    protected static ?string $modelLabel = 'Peminjaman';
    protected static ?string $pluralModelLabel = 'Peminjaman';

    public static function table(Table $table): Table
    {
        return PeminjamanTable::configure($table);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPeminjaman::route('/'),
        ];
    }
    
}
