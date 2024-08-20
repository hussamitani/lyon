<?php

namespace App\Filament\System\Resources\AttributeResource\Pages;

use App\Filament\System\Resources\AttributeResource;
use App\Models\Attribute;
use Filament\Resources\Pages\CreateRecord;

/**
 * @property Attribute $record
 */
class CreateAttribute extends CreateRecord
{
    protected static string $resource = AttributeResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['attribute_settings'] = [
            'attribute_type' => $data['attribute_type'],
            'input_format' => $data['input_format'],
            'is_required' => $data['is_required'],
            'is_distributable' => $data['is_distributable'],
            'is_territorial' => $data['is_territorial'],
        ];

        //unset($data['attribute_type']);
        unset($data['input_format']);
        unset($data['is_required']);
        unset($data['is_distributable']);
        unset($data['is_territorial']);

        return $data;
    }
}
