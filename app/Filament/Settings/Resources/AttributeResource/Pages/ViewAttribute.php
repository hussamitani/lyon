<?php

namespace App\Filament\Settings\Resources\AttributeResource\Pages;

use App\Filament\Settings\Resources\AttributeResource;
use App\ValueObjects\AttributeSettings;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAttribute extends ViewRecord
{
    protected static string $resource = AttributeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        return parent::mutateFormDataBeforeFill(AttributeSettings::mutateBeforeFill($data));
    }
}
