<?php

namespace App\Filament\Resources\Peminjamen\Tables;

use Filament\Actions\Action as ActionsAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Support\Enums\Size;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PeminjamenTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kelas')
                    ->searchable(),
                TextColumn::make('jurusan')
                    ->searchable(),
                TextColumn::make('tanggal_peminjaman')
                    ->date()
                    ->sortable(),
                TextColumn::make('tanggal_kembali')
                    ->date()
                    ->sortable(),
                BadgeColumn::make('status')
                    ->colors([
                        'danger' => 'dipinjam',
                        'success' => 'kembali',
                        'warning' => 'terlambat',
                    ]),
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
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'dipinjam' => 'Dipinjam',
                        'kembali' => 'Dikembalikan',
                        'terlambat' => 'Terlambat',
                    ]),

            ])
            ->filtersFormColumns(2)
            ->actions([
                ActionsAction::make('kembalikan')
                    ->label('Kembalikan')
                    ->color('success')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->visible(fn ($record) => $record->status === 'dipinjam')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'kembali',
                            'tanggal_kembali' => now(),
                        ]);

                        $record->book->increment('stok');
                    })
                    ->after(function () {
                        Notification::make()
                            ->title('Buku berhasil dikembalikan')
                            ->success()
                            ->send();
                    }),
                ViewAction::make()
                    ->size(Size::Small)
                    ->color('primary')
                    ->button(),

            ]);
    }
}
