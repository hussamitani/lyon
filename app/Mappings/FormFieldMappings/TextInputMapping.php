<?php

namespace App\Mappings\FormFieldMappings;

use App\Models\Attribute;
use App\Models\Product;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\TextInput;

class TextInputMapping implements FormFieldMapping
{
    public static function mapAsComponent(Attribute $attribute): Field
    {
        return DefaultFormField::map(
            TextInput::make('attributes-'.$attribute->id.'-attribute_value')
                    ->default(function (Product $record) use ($attribute) {
                        return $record->valueForAttribute($attribute)->attribute_value;
                    })
                    ->label($attribute->name),
            $attribute);
    }
}
