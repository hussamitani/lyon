<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
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
 * @property int $id
 * @property string|null $key
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryType whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryType whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class InquiryType extends Model
{
    use SoftDeletes;

    protected $table = 'inquiries_types';

    /**
     * @return HasMany<Inquiry>
     */
    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }
}
