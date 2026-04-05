<?php

namespace App\Filament\Resources\Books\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('cover')
                    ->image()
                    ->disk('public')
                    ->directory('covers')
                    ->visibility('public')
                    ->imagePreviewHeight('150'),

                TextInput::make('judul')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => 
                        $set('slug', Str::slug($state))
                    ),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                TextInput::make('sub_judul'),

                Textarea::make('sinopsis')
                    ->rows(4),

                TextInput::make('penulis')
                    ->required(),

                TextInput::make('penerbit')
                    ->required(),

                Select::make('kategori')
                    ->options([
                        'Novel' => 'Novel',
                        'Teknologi' => 'Teknologi',
                        'Sejarah' => 'Sejarah',
                    ])
                    ->searchable()
                    ->required(),

                DatePicker::make('tahun_terbit'),

                TextInput::make('stok')
                    ->numeric()
                    ->default(0)
                    ->required(),
            ]);
    }
}