<?php

namespace App\Mappings\FormFieldMappings;

use App\Models\ProductField;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Select;

class SingleSelectMapping implements FormFieldMapping
{
    public static function mapAsComponent(ProductField $field): Field
    {
        return Select::make('fields-'.$field->id.'-field_value')
            ->multiple(false)
            ->options($field->field_options)
            ->label($field->name)
            ->required($field->required);
    }
}
