<?php

namespace App\Mappings\FieldTypeMapping;

use App\Mappings\FieldFormatMapping\DefaultFieldSetup;
use App\Models\Attribute;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\RichEditor;

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
