<?php

namespace App\Mappings\FieldTypeMapping;

use App\Mappings\FieldFormatMapping\DefaultFieldSetup;
use App\Models\Attribute;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Select;

class MultiSelectMapping implements FormFieldMapping
{
    public static function mapAsComponent(Attribute $attribute): Field
    {
        return DefaultFieldSetup::map(
            Select::make('attributes-'.$attribute->id.'-attribute_value')
                ->multiple(true)
                ->options($attribute->options->pluck('value', 'id'))
                ->label($attribute->name),
            $attribute);
    }
}
