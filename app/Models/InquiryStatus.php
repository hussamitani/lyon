<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @method static \Database\Factories\InquiryStatusFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus query()
 *
 * @property-read Collection<int, InquiryResponse> $responses
 * @property-read int|null $responses_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus withoutTrashed()
 *
 * @property int $id
 * @property string|null $key
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus whereUpdatedAt($value)
 *
 * @property string|null $description
 * @property string $status_category
 *
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryStatus whereStatusCategory($value)
 *
 * @mixin \Eloquent
 */
class InquiryStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'inquiries_statuses';

    /**
     * @return HasMany<InquiryResponse>
     */
    public function responses(): HasMany
    {
        return $this->hasMany(InquiryResponse::class);
    }
}
