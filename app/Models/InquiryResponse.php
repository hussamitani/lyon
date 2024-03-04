<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static \Database\Factories\InquiryResponseFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryResponse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryResponse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryResponse query()
 *
 * @property-read Collection<int, Inquiry> $inquiries
 * @property-read int|null $inquiries_count
 * @property-read InquiryStatus|null $status
 *
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryResponse onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryResponse withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryResponse withoutTrashed()
 *
 * @mixin Eloquent
 */
class InquiryResponse extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @return HasMany<Inquiry>
     */
    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }

    /**
     * @return BelongsTo<InquiryStatus, InquiryResponse>
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(InquiryStatus::class);
    }
}
