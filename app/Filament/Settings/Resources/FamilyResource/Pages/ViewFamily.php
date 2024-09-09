<?php

namespace App\Filament\Settings\Resources\FamilyResource\Pages;

use App\Filament\Settings\Resources\FamilyResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFamily extends ViewRecord
{
    protected static string $resource = FamilyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
