<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static \Database\Factories\InquiryTypeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryType query()
 *
 * @property-read Collection<int, Inquiry> $inquiries
 * @property-read int|null $inquiries_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryType withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryType withoutTrashed()
 *
 * @mixin \Eloquent
 */
class InquiryType extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @return HasMany<Inquiry>
     */
    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }
}
