<?php

namespace App\Filament\Resources\Tiers\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use App\Models\Group;

class TierForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('spending_range')
                    ->required()
                    ->numeric()
                    ->prefix('$')
                    ->default(0),
                Select::make('group_id')
                    ->label('Price Group')
                    ->options(Group::pluck('title', 'id'))
                    ->required(),
            ]);
    }
}
