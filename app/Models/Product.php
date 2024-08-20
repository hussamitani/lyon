<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $family_id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Family $family
 * @property-read Collection<int, Attribute> $attributes
 * @property-read int|null $attributes_count
 *
 * @method static \Database\Factories\ProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereFamilyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 *
 * @property-read Collection<int, ProductAttributeValue> $attributeValues
 * @property-read int|null $attribute_values_count
 * @property string $sku
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSku($value)
 *
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $with = [
        'attributeValues',
    ];

    protected $guarded = [];

    /**
     * @return BelongsTo<Family, Product>
     */
    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class, 'family_id', 'id');
    }

    /**
     * @return BelongsToMany<Attribute>
     */
    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(
            Attribute::class,
            'family_attributes',
            'family_id',
            'attribute_id',
            'family_id',
            'id'
        );
    }

    /**
     * @return HasMany<ProductAttributeValue>
     */
    public function attributeValues(): HasMany
    {
        return $this->hasMany(ProductAttributeValue::class);
    }

    public function valueForAttribute(Attribute $attribute): ?ProductAttributeValue
    {
        return $this->attributeValues->where('id', $attribute->id)->first() ?? null;
    }
}
