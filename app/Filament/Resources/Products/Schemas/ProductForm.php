<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Textarea::make('short_description')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('full_description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->default(0.0)
                    ->prefix('$'),
                TextInput::make('quantity')
                    ->required()
                    ->numeric()
                    ->default(20),
                FileUpload::make('image_name')
                    ->image()
                    ->disk('images')
                    ->required(),
                TextInput::make('category')
                    ->required(),
                Select::make('classification')
                    ->options([
                        'default' => 'Default',
                        'exclusive' => 'Exclusive',
                        'featured' => 'Featured',
                        'upcoming' => 'Upcoming',
                    ]),
                TextInput::make('status')
                    ->required()
                    ->default('active'),
            ]);
    }
}
