<?php

namespace App\Mappings\FormFieldMappings;

use App\Models\Attribute;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Radio;

class RadioMapping implements FormFieldMapping
{
    public static function mapAsComponent(Attribute $attribute): Field
    {
        return Radio::make('attributes-'.$attribute->id.'-attribute_value')
            ->options($attribute->options)
            ->label($attribute->name);
    }
}
