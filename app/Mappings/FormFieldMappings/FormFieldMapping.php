<?php

namespace App\Mappings\FormFieldMappings;

use App\Models\Attribute;
use Filament\Forms\Components\Field;

interface FormFieldMapping
{
    public static function mapAsComponent(Attribute $attribute): Field;
}
