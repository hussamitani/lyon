<?php

namespace App\Mappings\FormFieldMappings;

use App\Mappings\FormFieldSetup\DefaultFieldSetup;
use App\Models\Attribute;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Toggle;

class ToggleMapping implements FormFieldMapping
{
    public static function mapAsComponent(Attribute $attribute): Field
    {
        return DefaultFieldSetup::map(
            Toggle::make('attributes-'.$attribute->id.'-attribute_value')
                ->disabled(false)
                ->label($attribute->name),
            $attribute
        );
    }
}
