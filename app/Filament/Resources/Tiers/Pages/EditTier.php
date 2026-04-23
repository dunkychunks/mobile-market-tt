<?php

namespace App\Filament\Resources\Tiers\Pages;

use App\Filament\Resources\Tiers\TierResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTier extends EditRecord
{
    protected static string $resource = TierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
