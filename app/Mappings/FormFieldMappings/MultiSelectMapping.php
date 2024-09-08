<?php

namespace App\Mappings\FormFieldMappings;

use App\Mappings\FormFieldSetup\DefaultFieldSetup;
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
