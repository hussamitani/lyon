<?php

namespace App\Mappings\FieldTypeMapping;

use App\Mappings\FieldFormatMapping\DefaultFieldSetup;
use App\Models\Attribute;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Field;

class DateTimePickerMapping implements FormFieldMapping
{
    public static function mapAsComponent(Attribute $attribute): Field
    {
        return DefaultFieldSetup::map(
            DateTimePicker::make('attributes-'.$attribute->id.'-attribute_value')
                ->format('d.m.Y H:i')
                ->label($attribute->name),
            $attribute
        );
    }
}
