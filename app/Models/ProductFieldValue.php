<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $product_id
 * @property int $field_id
 * @property string $field_value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFieldValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFieldValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFieldValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFieldValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFieldValue whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFieldValue whereFieldValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFieldValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFieldValue whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFieldValue whereUpdatedAt($value)
 *
 * @property-read \App\Models\ProductField $field
 *
 * @mixin \Eloquent
 */
class ProductFieldValue extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'field_value' => 'json',
        ];
    }

    /**
     * @return BelongsTo<Product, ProductFieldValue>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return BelongsTo<ProductField, ProductFieldValue>
     */
    public function field(): BelongsTo
    {
        return $this->belongsTo(ProductField::class);
    }
}
