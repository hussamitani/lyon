<?php

namespace App\Helpers;

use App\Models\Attribute;
use App\Models\Product;
use Filament\Forms\Components\Field;

class Mapper
{
    /**
     * @return array<Field>
     */
    public static function mapProductAttributes(Product $product): array
    {
        return $product->family->attributes()->get()->map(function (Attribute $attribute) {
            return $attribute->toFilamentField();
        })->toArray();
    }
}
