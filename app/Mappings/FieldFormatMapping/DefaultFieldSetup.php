<?php

namespace App\Mappings\FieldFormatMapping;

use App\Models\Attribute;
use Filament\Forms\Components\Field;

class DefaultFieldSetup
{
    public static function map(Field $field, Attribute $attribute): Field
    {
        return $attribute->format->setup(
            $field->live()->reactive()
        );
    }
}
