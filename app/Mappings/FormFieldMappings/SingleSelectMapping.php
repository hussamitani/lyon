<?php

namespace App\Mappings\FormFieldMappings;

use App\Models\Attribute;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Select;

class SingleSelectMapping implements FormFieldMapping
{
    public static function mapAsComponent(Attribute $attribute): Field
    {
        return DefaultFormField::map(
            Select::make('attributes-'.$attribute->id.'-attribute_value')
                ->multiple(false)
                ->options($attribute->attribute_options)
                ->label($attribute->name),
            $attribute
        );
    }
}
