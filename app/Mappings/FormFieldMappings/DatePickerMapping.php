<?php

namespace App\Mappings\FormFieldMappings;

use App\Models\ProductField;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Field;

class DatePickerMapping implements FormFieldMapping
{
    public static function mapAsComponent(ProductField $field): Field
    {
        return DatePicker::make('fields-'.$field->id.'-field_value')
            ->format('d.m.Y')
            ->label($field->name)
            ->required($field->required);
    }
}
