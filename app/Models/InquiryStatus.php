<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @mixin \Eloquent
 */
class InquiryStatus extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @return HasMany<InquiryResponse>
     */
    public function responses(): HasMany
    {
        return $this->hasMany(InquiryResponse::class);
    }
}
