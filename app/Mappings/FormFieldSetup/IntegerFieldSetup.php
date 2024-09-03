<?php

namespace App\Mappings\FormFieldSetup;

use Filament\Forms\Components\Field;
use Filament\Forms\Components\TextInput;

class IntegerFieldSetup
{
    public static function setup(Field $field): Field
    {
        if (
            ! $field instanceof TextInput
        ) {
            return $field;
        }

        return $field
            ->numeric()
            ->minValue(10);

    }
}
