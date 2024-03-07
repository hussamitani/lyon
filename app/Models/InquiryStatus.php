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
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property string|null $description
 * @property string $status_category
 * @property-read Collection<int, InquiryResponse> $responses
 * @property-read int|null $responses_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus withoutTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus whereStatusCategory($value)
 *
 * @mixin \Eloquent
 */
class InquiryStatus extends Model
{
    use SoftDeletes;

    protected $table = 'inquiries_statuses';

    /**
     * @return HasMany<InquiryResponse>
     */
    public function responses(): HasMany
    {
        return $this->hasMany(InquiryResponse::class);
    }
}
