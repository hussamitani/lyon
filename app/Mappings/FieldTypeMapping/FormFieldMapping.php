<?php

namespace App\Mappings\FieldTypeMapping;

use App\Models\Attribute;
use Filament\Forms\Components\Field;

interface FormFieldMapping
{
    public static function mapAsComponent(Attribute $attribute): Field;
}
