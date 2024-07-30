<?php

namespace App\Mappings\FormFieldMappings;

use App\Models\ProductField;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Radio;

class RadioMapping implements FormFieldMapping
{
    public static function mapAsComponent(ProductField $field): Field
    {
        return Radio::make('fields-'.$field->id.'-field_value')
            ->options($field->field_options)
            ->label($field->name)
            ->required($field->required);
    }
}
