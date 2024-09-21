<?php

namespace App\Mappings\FieldTypeMapping;

use App\Mappings\FieldFormatMapping\DefaultFieldSetup;
use App\Models\Attribute;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Field;

class CheckboxListMapping implements FormFieldMapping
{
    public static function mapAsComponent(Attribute $attribute): Field
    {
        $field = CheckboxList::make('attributes-'.$attribute->id.'-attribute_value')
            ->options($attribute->options)
            ->label($attribute->name);

        return DefaultFieldSetup::map($field, $attribute);
    }
}
