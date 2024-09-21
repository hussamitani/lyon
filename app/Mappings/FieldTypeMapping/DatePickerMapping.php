<?php

namespace App\Mappings\FieldTypeMapping;

use App\Mappings\FieldFormatMapping\DefaultFieldSetup;
use App\Models\Attribute;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Field;

class DatePickerMapping implements FormFieldMapping
{
    public static function mapAsComponent(Attribute $attribute): Field
    {
        return DefaultFieldSetup::map(
            DatePicker::make('attributes-'.$attribute->id.'-attribute_value')
                ->format('d.m.Y')
                ->label($attribute->name),
            $attribute
        );
    }
}
