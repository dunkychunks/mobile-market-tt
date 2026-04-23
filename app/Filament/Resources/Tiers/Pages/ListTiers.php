<?php

namespace App\Filament\Resources\Tiers\Pages;

use App\Filament\Resources\Tiers\TierResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTiers extends ListRecords
{
    protected static string $resource = TierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
