<?php

namespace App\Mappings\FormFieldMappings;

use App\Models\ProductField;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Field;

class DateTimePickerMapping implements FormFieldMapping
{
    public static function mapAsComponent(ProductField $field): Field
    {
        return DateTimePicker::make('fields-'.$field->id.'-field_value')
            ->format('d.m.Y H:i')
            ->label($field->name)
            ->required($field->required);
    }
}
