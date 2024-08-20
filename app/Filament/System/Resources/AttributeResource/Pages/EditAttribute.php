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
        /** @var AttributeSettings $attributeSettings */
        $attributeSettings = $data['attribute_settings'];

        $data['attribute_type'] = $attributeSettings->attribute_type;
        $data['input_format'] = $attributeSettings->input_format;
        $data['is_required'] = $attributeSettings->is_required;
        $data['is_distributable'] = $attributeSettings->is_distributable;
        $data['is_territorial'] = $attributeSettings->is_territorial;

        unset($data['attribute_settings']);

        return parent::mutateFormDataBeforeFill($data);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['attribute_settings'] = new AttributeSettings(
            attribute_type: $data['attribute_type'],
            input_format: $data['input_format'],
            is_required: $data['is_required'],
            is_distributable: $data['is_distributable'],
            is_territorial: $data['is_territorial'],
        );

        //unset($data['attribute_type']);
        unset($data['input_format']);
        unset($data['is_required']);
        unset($data['is_distributable']);
        unset($data['is_territorial']);

        return $data;
    }
}
