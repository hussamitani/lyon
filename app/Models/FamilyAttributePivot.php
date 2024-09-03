<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property int $family_id
 * @property int $attribute_id
 * @property int $sort
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyAttributePivot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyAttributePivot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyAttributePivot query()
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyAttributePivot whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FamilyAttributePivot whereFamilyId($value)
 *
 * @mixin \Eloquent
 */
class FamilyAttributePivot extends Pivot
{
    protected $table = 'family_attributes';
}
