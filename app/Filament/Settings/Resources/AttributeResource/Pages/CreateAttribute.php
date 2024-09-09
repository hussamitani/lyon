<?php

namespace App\Filament\Settings\Resources\AttributeResource\Pages;

use App\Filament\Settings\Resources\AttributeResource;
use App\Models\Attribute;
use App\ValueObjects\AttributeSettings;
use Filament\Resources\Pages\CreateRecord;

/**
 * @property Attribute $record
 */
class CreateAttribute extends CreateRecord
{
    protected static string $resource = AttributeResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return parent::mutateFormDataBeforeCreate(AttributeSettings::mutateBeforeSave($data));
    }
}
