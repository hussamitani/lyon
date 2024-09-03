<?php

namespace App\Mappings\FormFieldMappings;

use App\Models\Attribute;
use Filament\Forms\Components\Field;

class DefaultFormField
{
    public static function map(Field $field, Attribute $attribute): Field
    {
        return $field->live()->reactive();
    }
}
