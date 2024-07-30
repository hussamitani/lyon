<?php

namespace App\Mappings\FormFieldMappings;

use App\Models\ProductField;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Toggle;

class ToggleMapping implements FormFieldMapping
{
    public static function mapAsComponent(ProductField $field): Field
    {
        return Toggle::make('fields-'.$field->id.'-field_value')
            ->disabled(false)
            ->label($field->name)
            ->required($field->required);
    }
}
