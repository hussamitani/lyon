<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $patient_id
 * @property int $type_id
 * @property string $subject
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @method static \Database\Factories\InquiryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Inquiry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Inquiry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Inquiry query()
 * @method static \Illuminate\Database\Eloquent\Builder|Inquiry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inquiry whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inquiry whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inquiry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inquiry wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inquiry whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inquiry whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inquiry whereUpdatedAt($value)
 *
 * @property-read Patient $patient
 * @property-read Collection<int, InquiryResponse> $responses
 * @property-read int|null $responses_count
 * @property-read InquiryType $type
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Inquiry onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Inquiry withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Inquiry withoutTrashed()
 *
 * @mixin Eloquent
 */
class Inquiry extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @return HasMany<InquiryResponse>
     */
    public function responses(): HasMany
    {
        return $this->hasMany(InquiryResponse::class);
    }

    /**
     * @return BelongsTo<InquiryType, Inquiry>
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(InquiryType::class);
    }

    /**
     * @return BelongsTo<Patient, Inquiry>
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
