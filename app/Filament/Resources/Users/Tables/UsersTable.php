<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('email')->searchable(),

                TextColumn::make('kelas'),
                TextColumn::make('jurusan'),

                BadgeColumn::make('role')
                    ->colors([
                        'danger' => 'admin',
                        'success' => 'user',
                    ]),

                TextColumn::make('no_tlp')
                    ->label('No. Telepon'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->filters([
                SelectFilter::make('kelas')
                    ->label('Kelas')
                    ->options([
                        'X' => 'X',
                        'XI' => 'XI',
                        'XII' => 'XII',
                    ]),
                SelectFilter::make('jurusan')
                    ->label('Jurusan')
                    ->options([
                        'RPL' => 'RPL',
                        'TKJ' => 'TKJ',
                        'DKV' => 'DKV',
                        'PSPT' => 'PSPT',
                    ]),

            ])
            ->filtersFormColumns(2);
    }
}
