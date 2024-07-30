<?php

namespace App\Mappings\FormFieldMappings;

use App\Models\ProductField;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Textarea;

class TextAreaMapping implements FormFieldMapping
{
    public static function mapAsComponent(ProductField $field): Field
    {
        return Textarea::make('fields-'.$field->id.'-field_value')
            ->label($field->name)
            ->required($field->required);
    }
}
