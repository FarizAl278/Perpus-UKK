<?php

namespace App\Filament\Resources\Peminjaman\Tables;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PeminjamanTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama Siswa')
                    ->searchable(),

                TextColumn::make('book.judul')
                    ->label('Buku')
                    ->searchable(),

                TextColumn::make('kelas'),

                TextColumn::make('jurusan'),

                TextColumn::make('tanggal_peminjaman')
                    ->date(),

                TextColumn::make('tanggal_kembali')
                    ->date(),

                BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'dipinjam',
                        'success' => 'kembali',
                    ]),
            ])
            ->actions([
                Action::make('kembalikan')
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

                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'dipinjam' => 'Dipinjam',
                        'kembali' => 'Kembali',
                        'terlambat' => 'Terlambat',
                    ]),

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
