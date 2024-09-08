<?php

namespace App\Mappings\FormFieldSetup;

use Filament\Forms\Components\Field;
use Filament\Forms\Components\TextInput;
use Filament\Support\RawJs;

class CurrencyFieldSetup
{
    public static function setup(Field $field): Field
    {
        if (! $field instanceof TextInput) {
            return $field;
        }

        return $field
            ->numeric()
            ->minValue(0)
            ->mask('999.999,99')
            ->suffixIcon('heroicon-o-currency-euro')
            ->mask(RawJs::make('$money($input)'))
            ->stripCharacters(',')
            ->rule('regex:/^\$?\d+(\.\d{2})?$/');
    }
}
