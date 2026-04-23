<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Group;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

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
                /*
                 * Group Prices section allows the admin to set tier-specific discounted
                 * prices per product. When a shopper belongs to a group that has an
                 * override here, Product::getPrice() returns that price instead of the
                 * base price (via the COALESCE subquery in scopeWithPrices).
                 */
                Section::make('Group Prices (optional)')
                    ->description('Override the base price for specific customer groups.')
                    ->schema([
                        Repeater::make('groupPrices')
                            ->relationship()
                            ->schema([
                                Select::make('group_id')
                                    ->label('Group')
                                    ->options(fn () => Group::pluck('title', 'id'))
                                    ->required(),
                                TextInput::make('price')
                                    ->label('Discounted Price')
                                    ->numeric()
                                    ->prefix('$')
                                    ->required(),
                            ])
                            ->columns(2)
                            ->addActionLabel('Add group price'),
                    ])
                    ->columnSpanFull()
                    ->collapsible(),
            ]);
    }
}
