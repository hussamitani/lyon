<?php

namespace App\Mappings\FormFieldMappings;

use App\Mappings\FormFieldSetup\DefaultFieldSetup;
use App\Models\Attribute;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;

class TextAreaMapping implements FormFieldMapping
{
    public static function mapAsComponent(Attribute $attribute): Field
    {
        return DefaultFieldSetup::map(
            RichEditor::make('attributes-'.$attribute->id.'-attribute_value')
                ->label($attribute->name)
                ->columnSpan(2),
            $attribute
        );
    }
}
