<?php

namespace App\Mappings\FormFieldMappings;

use App\Models\Attribute;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Textarea;

class TextAreaMapping implements FormFieldMapping
{
    public static function mapAsComponent(Attribute $attribute): Field
    {
        return DefaultFormField::map(
            Textarea::make('attributes-'.$attribute->id.'-attribute_value')
                ->label($attribute->name),
            $attribute
        );
    }
}
