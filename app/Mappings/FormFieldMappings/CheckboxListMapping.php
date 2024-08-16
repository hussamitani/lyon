<?php

namespace App\Mappings\FormFieldMappings;

use App\Models\Attribute;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Field;

class CheckboxListMapping implements FormFieldMapping
{
    public static function mapAsComponent(Attribute $attribute): Field
    {
        return CheckboxList::make('attributes-'.$attribute->id.'-attribute_value')
            ->options($attribute->attribute_options)
            ->label($attribute->name)
            ->required($attribute->required);
    }
}
