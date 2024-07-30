<?php

namespace App\Mappings\FormFieldMappings;

use App\Models\Product;
use App\Models\ProductField;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\TextInput;

class TextInputMapping implements FormFieldMapping
{
    public static function mapAsComponent(ProductField $field): Field
    {
        return TextInput::make('fields-'.$field->id.'-field_value')
            ->default(function (Product $record) use ($field) {
                return $record->valueForField($field)->field_value;
            })
            ->live()
            ->reactive()
            ->label($field->name)
            ->required($field->required);
    }
}
