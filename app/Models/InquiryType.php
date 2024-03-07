<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string|null $key
 * @property string $name
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection<int, Inquiry> $inquiries
 * @property-read int|null $inquiries_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryType query()
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryType withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryType withoutTrashed()
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
