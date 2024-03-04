<?php

namespace App\Models;

use App\Concerns\HasAuthor;
use App\Observers\InquiryResponseObserver;
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
 * @property int $id
 * @property int $inquiries_id
 * @property int $status_id
 * @property string $message
 * @property int|null $created_by_id
 * @property int|null $updated_by_id
 * @property int|null $deleted_by_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryResponse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryResponse whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryResponse whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryResponse whereDeletedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryResponse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryResponse whereInquiriesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryResponse whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryResponse whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryResponse whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InquiryResponse whereUpdatedById($value)
 *
 * @property-read \App\Models\User|null $createdBy
 * @property-read \App\Models\User|null $deletedBy
 * @property-read \App\Models\User|null $updatedBy
 *
 * @mixin Eloquent
 */
class InquiryResponse extends Model
{
    use HasAuthor, HasFactory, SoftDeletes;

    protected $table = 'inquiries_responses';

    protected static function booted(): void
    {
        parent::booted();

        self::observe(InquiryResponseObserver::class);
    }

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
