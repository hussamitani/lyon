<?php

namespace App\Mappings\FormFieldMappings;

use App\Models\Attribute;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Field;

class DateTimePickerMapping implements FormFieldMapping
{
    public static function mapAsComponent(Attribute $attribute): Field
    {
        return DateTimePicker::make('attributes-'.$attribute->id.'-attribute_value')
            ->format('d.m.Y H:i')
            ->label($attribute->name)
            ->required($attribute->required);
    }
}
