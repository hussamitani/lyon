<?php

namespace App\Mappings\FormFieldMappings;

use App\Models\Attribute;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Select;

class MultiSelectMapping implements FormFieldMapping
{
    public static function mapAsComponent(Attribute $attribute): Field
    {
        return Select::make('attributes-'.$attribute->id.'-attribute_value')
            ->multiple(true)
            ->options($attribute->attribute_options)
            ->label($attribute->name)
            ->required($attribute->required);
    }
}
