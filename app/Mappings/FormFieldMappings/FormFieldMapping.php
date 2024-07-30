<?php

namespace App\Mappings\FormFieldMappings;

use App\Models\ProductField;
use Filament\Forms\Components\Field;

interface FormFieldMapping
{
    public static function mapAsComponent(ProductField $field): Field;
}
