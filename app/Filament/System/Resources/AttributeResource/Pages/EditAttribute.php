<?php

namespace App\Filament\System\Resources\AttributeResource\Pages;

use App\Filament\System\Resources\AttributeResource;
use App\ValueObjects\AttributeSettings;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAttribute extends EditRecord
{
    protected static string $resource = AttributeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        return parent::mutateFormDataBeforeFill(AttributeSettings::mutateBeforeFill($data));
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return parent::mutateFormDataBeforeSave(AttributeSettings::mutateBeforeSave($data));
    }
}
