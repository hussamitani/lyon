<?php

namespace App\Mappings\FieldTypeMapping;

use App\Mappings\FieldFormatMapping\DefaultFieldSetup;
use App\Models\Attribute;
use App\Models\Product;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\TextInput;

class TextInputMapping implements FormFieldMapping
{
    public static function mapAsComponent(Attribute $attribute): Field
    {
        $field = TextInput::make('attributes-'.$attribute->id.'-attribute_value')
            ->label($attribute->name)
            ->default(function (Product $record) use ($attribute) {
                return $record->valueForAttribute($attribute)->attribute_value;
            });

        return DefaultFieldSetup::map($field, $attribute);
    }
}
