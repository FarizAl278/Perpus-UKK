<?php

namespace App\Filament\Resources\Peminjamen\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PeminjamanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user.name')
                    ->required(),
                TextInput::make('kelas')
                    ->required(),
                TextInput::make('jurusan')
                    ->required(),
                DatePicker::make('tanggal_peminjaman')
                    ->required(),
                DatePicker::make('tanggal_kembali'),
                Select::make('status')
                    ->options(['dipinjam' => 'Dipinjam', 'kembali' => 'Kembali'])
                    ->default('dipinjam')
                    ->required(),
            ]);
    }
}
