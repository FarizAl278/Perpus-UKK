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
                Select::make('user_id')
                    ->label('Nama Siswa')
                    ->relationship('user', 'name')
                    ->disabled()
                    ->dehydrated(false),
                TextInput::make('kelas')
                    ->nullable(),
                TextInput::make('jurusan')
                    ->nullable(),
                DatePicker::make('tanggal_peminjaman')
                    ->required(),
                DatePicker::make('tanggal_kembali'),
                Select::make('status')
                    ->options(['dipinjam' => 'Dipinjam', 'kembali' => 'Kembali', 'pengambilan' => 'Pengambilan', 'terlambat' => 'Terlambat'])
                    ->default('kembali')
                    ->required(),
            ]);
    }
}
