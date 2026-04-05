<?php

namespace App\Filament\Resources\Books\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BooksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover')
                    ->label('Cover')
                    ->square()
                    ->size(50),

                TextColumn::make('judul')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('penulis')
                    ->searchable(),

                TextColumn::make('kategori')
                    ->badge()
                    ->color('primary'),

                TextColumn::make('penerbit'),

                TextColumn::make('tahun_terbit')
                    ->date(),

                TextColumn::make('stok')
                    ->sortable(),
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ]);
    }
}
