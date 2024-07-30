<?php

namespace App\Helpers;

use App\Models\Product;
use App\Models\ProductField;
use Filament\Forms\Components\Field;

class Mapper
{
    /**
     * @return array<Field>
     */
    public static function mapProductFields(Product $product): array
    {
        return $product->family->fields()->get()->map(function (ProductField $field) {
            return $field->toFilamentField();
        })->toArray();
    }
}
