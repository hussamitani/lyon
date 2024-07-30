<?php

namespace App\Mappings\FormFieldMappings;

use App\Models\ProductField;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Field;

class CheckboxListMapping implements FormFieldMapping
{
    public static function mapAsComponent(ProductField $field): Field
    {
        return CheckboxList::make('fields-'.$field->id.'-field_value')
            ->options($field->field_options)
            ->label($field->name)
            ->required($field->required);
    }
}
