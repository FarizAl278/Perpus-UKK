<?php

namespace App\Filament\Resources\Peminjamen\Tables;

use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Actions\BulkAction as ActionsBulkAction;
use Filament\Actions\BulkActionGroup as ActionsBulkActionGroup;
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
                TextColumn::make('book.judul')
                    ->label('Buku')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                TextColumn::make('user.name')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kelas')
                    ->label('Kelas')
                    ->formatStateUsing(fn ($record) => $record->kelas.' • '.$record->jurusan)
                    ->searchable(['kelas', 'jurusan']),
                TextColumn::make('tanggal_kembali')
                    ->label('Tenggat')
                    ->formatStateUsing(function ($state, $record) {
                        $pinjam = Carbon::parse($record->tanggal_peminjaman)->format('d M');
                        $kembali = Carbon::parse($record->tanggal_kembali)->format('d M Y');

                        return $pinjam.' - '.$kembali;
                    })
                    ->sortable(),
                BadgeColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(function ($state, $record) {
                        if (
                            $record->status === 'dipinjam' &&
                            Carbon::parse($record->tanggal_kembali)->isPast()
                        ) {
                            return 'terlambat';
                        }

                        return $state;
                    })
                    ->color(fn ($state, $record) => $record->isLate() ? 'danger' : match ($state) {
                        'pengambilan' => 'warning',
                        'dipinjam' => 'primary',
                        'kembali' => 'success',
                        'terlambat' => 'danger',
                        'dibatalkan' => 'secondary',
                        default => 'secondary',
                    }),
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
                        'pengambilan' => 'Pengambilan',
                        'dipinjam' => 'Dipinjam',
                        'kembali' => 'Dikembalikan',
                        'terlambat' => 'Terlambat',
                        'dibatalkan' => 'Dibatalkan',
                    ]),

            ])

            ->filtersFormColumns(2)
            ->actions([
                Action::make('diambil')
                    ->label('Diambil')
                    ->color('warning')
                    ->icon('heroicon-o-check')
                    ->visible(fn ($record) => $record->status === 'pengambilan')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'dipinjam',
                            'diambil_at' => now(),
                        ]);
                    })
                    ->after(function () {
                        Notification::make()
                            ->title('Buku sudah diambil')
                            ->success()
                            ->send();
                    }),

                // 🔥 2. KEMBALIKAN
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

                ViewAction::make()
                    ->size(Size::Small)
                    ->color('primary')
                    ->button(),

            ])

            ->bulkActions([
                ActionsBulkActionGroup::make([
                    ActionsBulkAction::make('bulk_diambil')
                        ->label('Tandai Diambil')
                        ->icon('heroicon-o-check')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                if ($record->status === 'pengambilan') {
                                    $record->update([
                                        'status' => 'dipinjam',
                                        'diambil_at' => now(),
                                    ]);
                                }
                            }
                        }),

                    ActionsBulkAction::make('bulk_kembalikan')
                        ->label('Kembalikan')
                        ->icon('heroicon-o-arrow-uturn-left')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                if ($record->status === 'dipinjam') {
                                    $record->update([
                                        'status' => 'kembali',
                                        'tanggal_kembali' => now(),
                                    ]);

                                    $record->book->increment('stok');
                                }
                            }
                        }),
                ]),
            ]);
    }
}
