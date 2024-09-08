<?php

namespace App\Mappings\FormFieldSetup;

use App\Models\Attribute;
use Filament\Forms\Components\Field;

class DefaultFieldSetup
{
    public static function map(Field $field, Attribute $attribute): Field
    {
        return $attribute->input_format->setup(
            $field->live()->reactive()
        );
    }
}
