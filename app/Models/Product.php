<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $family_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Family $family
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductField> $fields
 * @property-read int|null $fields_count
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductFieldValue> $fieldValues
 * @property-read int|null $field_values_count
 *
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @return BelongsTo<Family, Product>
     */
    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class, 'family_id', 'id');
    }

    /**
     * @return HasMany<ProductField>
     */
    public function fields(): HasMany
    {
        return $this->hasMany(
            ProductField::class,
            'family_id',
            'family_id',
        );
    }

    /**
     * @return HasMany<ProductFieldValue>
     */
    public function fieldValues(): HasMany
    {
        return $this->hasMany(ProductFieldValue::class);
    }

    public function valueForField(ProductField $field): ?ProductFieldValue
    {
        return $this->fieldValues->where('id', $field->id)->first() ?? null;
    }
}
