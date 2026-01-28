<?php

namespace App\Filament\Resources\Shippings\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\CheckboxList;

class ShippingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('days')
                    ->required()
                    ->numeric(),
                TextInput::make('stripe_id'),
                TextInput::make('display_order')
                    ->required()
                    ->numeric()
                    ->default(1),
                CheckboxList::make('groups')
                    ->relationship('groups', 'title'),
            ]);
    }
}
